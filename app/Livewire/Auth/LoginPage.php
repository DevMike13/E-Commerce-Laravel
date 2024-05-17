<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use WireUi\Traits\Actions;

#[Title('Login')]
class LoginPage extends Component
{
    use Actions;
    
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

    public function login(){
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        if(!auth()->attempt(['email' => $this->email, 'password' => $this->password])){
            // session()->flash('error', 'Invalid credentials');
            $this->notification()->error(
                $title = 'Error!',
                $description = 'Invalid credentials'
            );
            return;
        }

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
