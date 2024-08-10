<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use WireUi\Traits\Actions;

#[Title('Home Page - Yeah Fresh')]
class HomePage extends Component
{
    use Actions;

    public $categories;

    #[Url]
    public $selectedCategory;

    #[Url]
    public $activeFilter;

    public $activeSubCategory;
    public $activeSubCategoryName;
    public $filteredProducts;
    public $productQuery;
    
    public $category;

    #[Url]
    public $subcategory;

    public $lang;

    #[Url]
    public $slug;

    #[Url]
    public $subCatId;

    #[Url]
    public $mainCatName;

    #[Url]
    public $mainCatId;

    public $productDetails;
    public $quantity = 1;

    // CART MANEMENT
    public $is_cart_active;
    public $total_count;
    public $cart_items = [];
    public $grand_total;

    // CHECKOUT
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method;
    public $is_checkout_active;

    public function mount(Request $request)
    {
        
        $this->categories = Category::with(['sub_categories' => function ($query) {
            $query->where('is_active', 1);
        }])->get();

        if($this->activeFilter){
            self::setActiveTab($this->activeFilter);
        }

        $this->category = $request->query('category');
        $this->subcategory = $request->query('subcategory');
        
        if($this->category || $this->subcategory){
            $this->selectedCategory = Category::with(['sub_categories' => function ($query){
                $query->where('is_active', 1);
            }])->find($this->category);
    
            $this->filteredProducts = SubCategory::with(['products' => function ($query){
                $query->where('is_active', 1);
            }])->find($this->subcategory);
    
            $this->activeFilter = null;
            $this->activeSubCategoryName = SubCategory::find($this->subcategory);
            $this->activeSubCategory = $this->subcategory;
        }

        $this->total_count = count(CartManagement::getCartItemsFromCookie());
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->productDetails = Product::where('slug', $this->slug)->where('is_active', 1)->first();

        if(count($this->cart_items) == 0 && request()->is('checkout')){
            return redirect('/');
        }

        $this->lang = FacadesSession::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    public function generateToken(Request $request)
    {
        $accountSid = 'XXXXX';
        $authToken = 'XXXX';
        $apiKeySid = 'XXXX';
        $apiKeySecret = 'XXXXX';
        $twimlAppSid = 'XXXX';

        $identity = 'DRRMO'; // Unique identifier for the user

        // Create an Access Token
        $token = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, $identity);

        // Grant access to Voice
        $voiceGrant = new VoiceGrant();
        $voiceGrant->setOutgoingApplicationSid($twimlAppSid);
        $voiceGrant->setIncomingAllow(true); 
        $token->addGrant($voiceGrant);

        return response()->json(['token' => $token->toJWT()]);
    }

     // This method handles Twilio Voice Responses
     public function twilioResponse()
     {
         $response = new VoiceResponse();
         $response->dial()->client('DRRMO'); // 'dr-rmo' is a placeholder for the client ID you want to call

        return response($response, 200)
            ->header('Content-Type', 'text/xml');
     }
 
     // This method handles status callbacks
     public function statusCallback()
     {
         return response("<Response/>", 200)
             ->header('Content-Type', 'text/xml');
     }

     public function makeCall(Request $request)
    {
        $accountSid = 'XXXXXX';
        $authToken = 'XXXXX';
        $twilioNumber = +639306558025;
        $toNumber = +639306558025; // The number to call

        $client = new Client($accountSid, $authToken);

        $call = $client->calls->create(
            $toNumber,
            $twilioNumber,
            [
                'url' => route('twilio.voice-response')
            ]
        );

        return response()->json(['message' => 'Call initiated', 'callSid' => $call->sid]);
    }
    
    #[On('update-lang')]
    public function changeLang(){
        $this->lang = FacadesSession::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    // PRODUCT DETAILS
    public function getProductDetails($slug, $subCatId){
        $this->slug = $slug;
        $this->subCatId = $subCatId;
        $sub = SubCategory::find($this->subCatId);
        if($sub){
            $this->mainCatName = Category::find($sub->category_id);
            $this->mainCatId = Category::find($sub->category_id);
        }
        
        return redirect('/details?slug=' . $this->slug . '&subCatId=' . $this->subCatId . '&mainCatName=' . urlencode($this->mainCatName->name) . '&mainCatId=' . $this->mainCatId->id);
        
    }

    // FILTERING
    public function getCategories($categoryId, $subCategoryId){
        $this->selectedCategory = Category::with(['sub_categories' => function ($query){
            $query->where('is_active', 1);
        }])->find($categoryId);

        $this->filteredProducts = SubCategory::with(['products' => function ($query){
            $query->where('is_active', 1);
        }])->find($subCategoryId);

        $this->activeFilter = null;
        $this->activeSubCategoryName = SubCategory::find($subCategoryId);
        $this->activeSubCategory = $subCategoryId;

        return redirect('/products?category=' . $categoryId . '&subcategory=' . $subCategoryId);
       
    }

    public function getProductsBasedOnSubCategory($subCategoryId){
        $this->filteredProducts = SubCategory::with(['products' => function ($query){
            $query->where('is_active', 1);
        }])->find($subCategoryId);
        $this->activeSubCategoryName = SubCategory::find($subCategoryId);
        $this->activeSubCategory = $subCategoryId;
        $this->subcategory = $subCategoryId;
    }

    public function setActiveTab($tab){
       $this->activeFilter = $tab;
       if(!empty($this->activeFilter)){
            if($this->activeFilter === 'is_selected'){
                $this->filteredProducts = Product::where('is_active', 1)->where('is_selected', 1)->get();
            } else if($this->activeFilter === 'is_promotion') {
                $this->filteredProducts = Product::where('is_active', 1)->where('is_promotion', 1)->get();
            } else if($this->activeFilter === 'is_preorder') {
                $this->filteredProducts = Product::where('is_active', 1)->where('is_preorder', 1)->get();
            }
        }
    }
    // FILTERING END

    // CART MANAEGEMENT
    public function addToCart($product_id){
        $this->total_count = CartManagement::addItemToCart($product_id);

        $this->notification()->success(
            $title = 'Added to Cart',
            $description = 'Product successfully added to cart.'
        );
    }
    public function removeItem($product_id){
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        
        $this->notification()->success(
            $title = 'Removed to Cart',
            $description = 'Product successfully removed to cart.'
        );
        $this->is_cart_active = true;
        $this->total_count = count($this->cart_items);
        
    }

    public function addToCartWithQuantity($product_id){
        $this->total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        
        $this->notification()->success(
            $title = 'Added to Cart',
            $description = 'Product successfully added to cart.'
        );
    }

    public function increaseQty($product_id){
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->is_cart_active = true;
    }

    public function decreaseQty($product_id){
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->is_cart_active = true;
    }

    public function increaseQtyBtn(){
        $this->quantity++;
    }

    public function decreaseQtyBtn(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }

    // CART MANAEGEMENT END

    // CHECKOUT
    public function checkout(){
        $this->is_checkout_active = true;
        
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach($cart_items as $item){
            $line_items[] = [
                'price_data' => [
                    'currency' => 'PHP',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name']
                    ]
                ],
                'quantity' => $item['quantity']
            ];
        }

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'PHP';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by '. auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        $redirect_url = '';

        if($this->payment_method == 'stripe'){
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success'). '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'). '?session_id={CHECKOUT_SESSION_ID}',
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success');
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);
        CartManagement::clearCartItemsToCookie();

        Mail::to(request()->user())->send(new OrderPlaced($order));
        return redirect($redirect_url);
    }
    // CHECKOUT END

    public function render()
    {
       
        $selectedProducts = Product::where('is_selected', 1)->where('is_active', 1)->get();
        $promorionsProducts = Product::where('is_promotion', 1)->where('is_active', 1)->get();
        $preOrderProducts = Product::where('is_preorder', 1)->where('is_active', 1)->get();
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        
        return view('livewire.home-page',[
            'selectedProducts' => $selectedProducts,
            'promorionsProducts' => $promorionsProducts,
            'preOrderProducts' => $preOrderProducts,
            'products' => $this->filteredProducts,
            'details' => Product::where('slug', $this->slug)->where('is_active', 1)->first(),
            'sub_category_name' => SubCategory::find($this->subCatId),
            'main_category_name' => $this->mainCatName,
            'main_category_id' => $this->mainCatId,
            'recommended_products' => SubCategory::with(['products' => function ($query){ 
                $query->where('is_active', 1);
            }])->find($this->subCatId),
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
