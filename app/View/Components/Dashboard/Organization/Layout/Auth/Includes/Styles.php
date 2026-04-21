<?php

namespace App\View\Components\Dashboard\Organization\Layout\Auth\Includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Styles extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.dashboard.organization.layout.auth.includes.styles');
    }
}
