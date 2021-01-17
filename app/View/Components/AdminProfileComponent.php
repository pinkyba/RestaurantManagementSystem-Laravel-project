<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use App\User;

class AdminProfileComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $user;

    public function __construct()
    {
        $this->user = User::where('id',Auth::id())->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin-profile-component');
    }
}
