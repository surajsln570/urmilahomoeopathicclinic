<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string $title = '',
        public string $maxWidth = 'max-w-lg'
    ) {}

    public function render()
    {
        return view('components.modal');
    }
}
