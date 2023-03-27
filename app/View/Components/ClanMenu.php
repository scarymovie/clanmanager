<?php

namespace App\View\Components;

use App\Models\Clan;
use App\Models\Member;
use Illuminate\View\Component;

class ClanMenu extends Component
{

    public Clan $clan;
    public Member $member;

    public function __construct($clan, $member)
    {
        $this->clan = $clan;
        $this->member = $member;
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
