<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecordsCount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $total;
    public function __construct($total)
    {
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.records-count');
    }
}
