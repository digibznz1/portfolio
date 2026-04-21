<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    public function __construct(
        public string $value = 'admin_assets/media/avatars/300-2.png',
    ){}

    public function render(): View | Closure | string
    {
        return view('components.input.image');
    }
}
