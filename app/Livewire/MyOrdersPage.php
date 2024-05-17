<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    public $lang;
    public $orders = [];

    #[On('update-lang')]
    public function changeLang(){
        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    public function mount(){

        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);

        if(auth()->check()){
            $user_id = auth()->user()->id;
            $this->orders = Order::where('user_id',  $user_id)->get();
        }
    }
    public function render()
    {
        return view('livewire.my-orders-page', [
            'orders' => $this->orders,
        ]);
    }
}
