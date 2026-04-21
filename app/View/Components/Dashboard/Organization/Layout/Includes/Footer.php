<?php

namespace App\View\Components\Dashboard\Organization\Layout\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.dashboard.organization.layout.includes.footer');
    }
}
