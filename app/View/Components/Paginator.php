<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Paginator extends Component
{
    public $records;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($records)
    {
        $this->records = $records;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.paginator');
    }
}
