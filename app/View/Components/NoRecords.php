<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NoRecords extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $count, $colspan;
    public function __construct($count, $colspan)
    {
        $this->count = $count;
        $this->colspan = $colspan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.no-records');
    }
}
