<?php

namespace App\View\Components\Dashboard\Organization\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Add extends Component
{
    public function __construct(
        public string $permission,
        public string $baseRoute = 'dashboard.admin.',
        public array $prams = [],
    ){}

    public function render(): View | Closure | string
    {
        return view('components.dashboard.organization.button.add');
    }
}
