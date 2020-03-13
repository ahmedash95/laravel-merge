<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoginComponent extends Component
{
    public function refresh()
    {
        // just to reload the ui and check @auth
    }
    public function render()
    {
        return view('livewire.login-component');
    }
}
