<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$title='Welcome to Laravel!';
    	return view('pages.index')->with('title',$title);
    }
    public function about(){
    	$title='About Me';
    	return view('pages.about')->with('title',$title);
    }
    public function services(){
    	$data = array(
    		'title'=>'My Services',
    		'services'=> ['Web Design','Graphic Design','Mobile Development']
    	);
    	return view('pages.services')->with($data);
    }
     public function welcome(){
        return view('welcome');
    }
}
