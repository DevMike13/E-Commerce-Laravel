<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;

    public $lang;

    public function mount(){
        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    #[On('update-lang')]
    public function changeLang(){
        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    public function register(){
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        auth()->login($user);

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
