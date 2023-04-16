<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function render()
    {
        return view('components.sidebar');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        // $user = auth()->user();
        // $data['user'] = [
        //     'name' => $user->name,
        //     'email' => $user->email,
        //     'role' => $user->roles()->first()->name
        // ];

        // return $data;
        return 1;
    }

    public function activeNav()
    {
        // $activeNav = Route::currentRouteName();
        // $activeNav = explode('.', $activeNav);
        // $activeNav = $activeNav[0];
        // return $activeNav;
        return 1;
    }
}
