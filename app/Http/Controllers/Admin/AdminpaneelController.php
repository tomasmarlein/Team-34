<?php

namespace App\Http\Controllers\Admin;

use App\Evenements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminpaneelController extends Controller
{
    public function index()
    {
        $evenementen = Evenements::where('actief',true)
        ->get();

        $result = compact('evenementen');

        return view('admin.adminpanel', $result);
    }
}
