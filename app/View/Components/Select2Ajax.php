<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select2Ajax extends Component
{
    public $url;
    public $name;
    public $label;
    public $value;
    public $initials;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $url, $value = "", $initials = [])
    {
        $this->label = $label;
        $this->name = $name;
        $this->url = trim($url, '/');
        $this->value = $value;
        $this->initials = $initials;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select2-ajax');
    }
}
