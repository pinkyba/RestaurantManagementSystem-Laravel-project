<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use App\Staff;

class VendorProfileComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $staff;

    public function __construct()
    {
        $this->staff = Staff::where('user_id',Auth::id())->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.vendor-profile-component');
    }
}
