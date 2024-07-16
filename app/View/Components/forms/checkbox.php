<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class checkbox extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $question,
        public string $id,
        public array $options = [], // Update constructor to accept options array
        public string $placeholder = '', // Default value provided here
        public string $value = '', // Default value provided here
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.checkbox');
    }
}
