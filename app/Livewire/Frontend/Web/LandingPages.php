<?php

namespace App\Livewire\Frontend\Web;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]
class LandingPages extends Component
{
    public function render()
    {
        return view('livewire.frontend.web.landing-pages');
    }
}
