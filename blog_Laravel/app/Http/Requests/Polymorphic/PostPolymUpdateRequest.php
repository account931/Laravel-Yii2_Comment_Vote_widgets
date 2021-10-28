<?php

namespace App\Http\Requests\Polymorphic;

use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Http\Request as BaseRequest;

//use Illuminate\Contracts\Validation\Validator;
//use Illuminate\Support\Facades\Validator;

use Illuminate\Contracts\Validation\Validator; //true


class PostPolymUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
		return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
			'product-name'     => ['required', 'string',   'min:3'], 
			'product-desr'     => [ 'required',  'string', 'min:8'],
            //'u_email'          => [ 'required', 'email' ] ,
        ];
    }
	
	
	
	/**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        // use trans instead on Lang 
        return [
		   'product-name.required'   => 'Kindly ask you to specify the title',
		   'product-name.min'        => 'Post title can"t be less than 3 chars',
           //'username.required' => Lang::get('userpasschange.usernamerequired'),
	       //'u_name.required'     => 'We need u to specify your name',
	       //'u_email.email'       => 'Give us real email',
	       //'u_phone.regex'       => 'Phone must be in format +380....',
		];
	}
	
	
	
	 
    /**
     * Return validation errors 
     *
     * @param Validator $validator
     */
	/*
    public function withValidator(Validator $validator)
    {
	    if ($validator->fails()) {
			return redirect()->back()->withInput()->with('flashMessageFailX', 'Validation Failed!!!' )->withErrors($validator);
            //return redirect('/checkOut2')->withInput()->with('flashMessageFailX', 'Validation Failed!!!' )->withErrors($validator);
        }
	}
	*/
	
	//If u want if Validation fails, the Controller still execute code
	/**
     * To override Return validation errors. In this case it will return and exucute code in Controller, even if Request Validation fails
     * @param Validator $validator
     * 
     */
	
	protected function failedValidation(Validator $validator)
	{
		$this->validator = $validator;
    }
	

	
}
