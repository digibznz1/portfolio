<?php

namespace App\View\Components\Dashboard\Organization\Layout\includes\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public function __construct(
        public string $route,
        public string $trans,
        public string $active = 'active',
        public string $permission,
    ){}

    public function render(): View | Closure | string
    {
        return view('components.dashboard.organization.layout.includes.sidebar.menu-item');
    }
}
