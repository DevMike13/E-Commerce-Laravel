<?php

namespace App\Livewire\Partials;

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;

class Navbar extends Component
{
    #[Url]
    public $selectedLanguage;

    public function mount()
    {
        // $this->selectedLanguage = $this->selectedLanguage;
        $this->selectedLanguage = session('selected_language', config('app.locale'));
        app()->setLocale($this->selectedLanguage);
    }

    public function changeLanguage($language)
    {
        app()->setLocale($language);
        Session::put('locale', $language);
        $this->selectedLanguage = $language;
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(LoginPage::class);
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(RegisterPage::class);
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(ForgotPasswordPage::class);
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(ResetPasswordPage::class);
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(MyOrdersPage::class);
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(MyOrderDetailPage::class);
        $this->dispatch('update-lang', lang: $this->selectedLanguage)->to(HomePage::class);
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
