<?php

namespace App\View\Components;

use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $styles = null;
    public $scripts = null;
    public function __construct($title = 'CV builder tercepat & mudah')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app');
    }
}
