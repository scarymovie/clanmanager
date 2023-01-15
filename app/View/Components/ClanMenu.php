<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ClanMenu extends Component
{

    public $clan;

    public function __construct($clan)
    {
        $this->clan = $clan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.clan-menu');
    }
}
