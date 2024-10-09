<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notification extends Component
{
    public $message;
    public $color;

    public function __construct($message = null, $color = 'teal')
    {
        $this->message = $message;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.notification');
    }
}
