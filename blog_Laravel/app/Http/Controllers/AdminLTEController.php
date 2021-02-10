<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\AdminLte\Student;
use DataTables;
use App\User;


class AdminLTEController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Simple datatables.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin-lte.admin-main-page');
    }
	
	
	
	
}
