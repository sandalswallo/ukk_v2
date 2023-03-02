<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\User;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index(){

        $outlet = Outlet::all();
        $paket = Paket::all();
        $user = User::all();
        $member = Member::all();

        return view('dashboard.index', compact('outlet', 'paket', 'user', 'member'));
    }
}
