<?php

namespace App\Http\Controllers;
use App\User;
use App\Admin;
use App\Talent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
    	$talents=Talent::where('admin_status',1)->get()->take(3);
    	return view('home',compact(['talents']));
    }

    public function about(){
    	return view('about');
    }

    public function contact(){
    	return view('contact');
    }

    public function make_user(){

        $user=new User();
        $user->name='Mostafa Mohamed';
        $user->tid='201903';
        $user->address='Hetin, Saudi Arabia';
        $user->email='mostafamohmed59@gmail.com';
        $user->phone='01026220967';
        $user->age='8';
        $user->gender='1';
        $user->country='KSA';
        $user->summary='I’m a 8 years old , in 3rd primary school and my hobbies is playing clever games, reading more novels and swimming sport wih my friends in the club .';
        $user->password=Hash::make(111111);
        $user->img='user.png';
        $user->save();
   
    }

    public function make_admin(){

        $user=new Admin();
        $user->name='Hassan Mohamed';
        $user->address='Cairo, Egypt';
        $user->email='mostafamohmed59@gmail.com';
        $user->biography='I’m a driver in PXL, CA with a passion for transportation.';
        $user->password=Hash::make(111111);
        $user->img='user.png';
        $user->save();
   
    }
}
