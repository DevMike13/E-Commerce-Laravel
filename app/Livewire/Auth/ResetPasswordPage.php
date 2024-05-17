<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

#[Title('Reset Password')]
class ResetPasswordPage extends Component
{
    public $token;
    public $lang;

    #[Url]
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($token){
        $this->token = $token;
        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    #[On('update-lang')]
    public function changeLang(){
        $this->lang = Session::get('locale', app()->getLocale());
        app()->setLocale($this->lang);
    }

    public function resetPass(){
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token
            ],
            function(User $user, String $password){
                $password = $this->password;
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET?redirect('/login'):session()->flash('error' , 'Something went wrong.');
    }
    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
