<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RbacController extends Controller
{
    /**
     * Show .....
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rbac.rbacView'/*, compact('lang', 'listOfLanguages')*/); 		
	}
}
