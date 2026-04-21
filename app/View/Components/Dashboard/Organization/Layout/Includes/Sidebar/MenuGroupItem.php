<?php

namespace App\View\Components\Dashboard\Organization\Layout\includes\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuGroupItem extends Component
{
    public function __construct(
        public string $show,
        public string $trans,
    ){}

    public function render(): View | Closure | string
    {
        return view('components.dashboard.organization.layout.includes.sidebar.menu-group-item');
    }
}
