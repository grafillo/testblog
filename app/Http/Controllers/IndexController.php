<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
           public function index(){

               if(Auth::check()){

                   $posts = Post::with('getAvatar')->orderBy('id', 'desc')->get();

               }else {

                   $posts = Post::where('vision', 1)->with('getAvatar')->orderBy('id', 'desc')->get();

               }

               return view('index',['posts'=>$posts]);
           }


}
