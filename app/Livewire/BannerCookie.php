<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class BannerCookie extends Component
{
    public $showBanner = true;
    public $getCookie = false;

    public function mount()
    {
        $this->getCookie = (bool) request()->cookie('cookie_consent');
        if($this->getCookie)
        {
            $this->showBanner = false;
        }
        //dd($this->getCookie);
    }

    public function acceptCookie()
    {
        //setcookie('cookie_consent', 'holaaaa', time() + (86400 * 30), "/");
        $value = true;
        $minutes = 7200;
        //$minutes = 1;
        Cookie::queue('cookie_consent', $value, $minutes);
        $this->getCookie = (bool) request()->cookie('cookie_consent');
        $this->closeBanner();
    }

    public function closeBanner()
    {
        $this->showBanner = false;
    }

    public function render()
    {
        return view('livewire.banner-cookie');
    }
}
