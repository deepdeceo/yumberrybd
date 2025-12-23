<?php

namespace App\Livewire\Partner\Web;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.main.layouts')]
#[Title('আজই অনলাইনে আপনার রেস্তোরাঁ খুলুন')]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.partner.web.landing-page');
    }
}
