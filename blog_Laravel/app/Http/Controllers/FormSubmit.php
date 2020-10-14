<?php
//Form Example. Very minor exmaple. 
//For real major one, look /app/Http/Controllers/WpBlog.php => function create() + function store(Request $request) || function edit($id)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreForm;
use Validator;

class FormSubmit extends Controller
{
    
	
	 /**
     * Show the application form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request /*StoreForm*/  $request)
    {
		/*
		$validator = Validator::make($request->all(), [
           'text' => 'required|unique:posts|max:255',
           //'body' => 'required',
        ]);

        if ($validator->fails()) {
           return redirect('/formSubmit')
                  ->withErrors($validator)
                  ->withInput();
        } */
		
		
		
		
	
	
	
		// Если форма 1 была отправлена и есть поле text:
			if ($request->has('text')) {
				
				$this->validate($request, [
                   'text' => 'required|max:5',
                   //'body' => 'required',
                ]);
		
				var_dump($request->input('text'));
			}
			
			// Если форма 2 была отправлена и есть поле name:
			if ($request->has('name')) {
				
				$this->validate($request, [
                   'name' => 'required|max:5',
                   //'body' => 'required',
                ]);
		
				echo $request->input('name');
			}
			
        return view('formSumit.form');
    }
	
	
}
