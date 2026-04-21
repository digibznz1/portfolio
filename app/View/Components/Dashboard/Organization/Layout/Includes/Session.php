<?php

namespace App\View\Components\Dashboard\Organization\Layout\includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Session extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.dashboard.organization.layout.includes.session');
    }
}
