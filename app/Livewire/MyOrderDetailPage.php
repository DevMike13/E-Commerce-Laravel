<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Details')]
class MyOrderDetailPage extends Component
{
    public $lang;
    public $order_id;

    #[On('update-lang')]
    public function changeLang(){
        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    public function mount($order){

        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);

        $this->order_id = $order;

    }
    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        $address = Address::where('order_id', $this->order_id)->first();
        $order = Order::where('id', $this->order_id)->first();

        return view('livewire.my-order-detail-page',[
            'order_items' => $order_items,
            'order' => $order,
            'address' => $address,
        ]);
    }
}
