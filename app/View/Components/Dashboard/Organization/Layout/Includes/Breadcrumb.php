<?php

namespace App\View\Components\Dashboard\Admin\Layout\includes;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public function __construct(
        public array $breadcrumb = [],
    ){}

    public function render(): View | Closure | string
    {
        return view('components.dashboard.admin.layout.includes.breadcrumb');
    }
}
