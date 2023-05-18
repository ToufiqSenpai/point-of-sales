<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $type, public string $errors)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-list');
    }
}
