<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}
	
	public function listProd($id) 
	{
		return view('listprod',['id'=>$id]);
	}
	
	public function detailProd($id,$numb)
	{
		return view('detailprod',['idProd'=>$id,'numb'=>$numb]);
	}
	
	public function picking($id)
	{
		return view('picking',['id'=>$id]);    
	}
	
	public function Recap($id)
	{
		return view('recap',['id'=>$id]);    
	}

}
