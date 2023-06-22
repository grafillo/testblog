<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $autor_id = Auth::user()->id;

        $posts = Post::where('autor_id',$autor_id)->get();

        //return view('index',['posts'=>Auth::user()->posts]);

        return view('index',['posts'=>$posts]);
    }


    public function create()
    {
        return view('addpost');
    }


    public function store(PostRequest $req)
    {
        if (isset($req->vision)){
            $vision = 1;
        }else{$vision = 0;}

        $post= new Post();
        $post->title = $req-> input('title');
        $post->text = $req-> input('message');
        $post->autor = Auth::user()->name;
        $post->autor_id = Auth::user()->id;
        $post->vision = $vision;
        $post->save();


        return redirect()->route('addpost')->with('success',"Ваша статья успешно добавлена!");

    }


    public function show($id)
    {
        $post = Post::where('id',$id)->with('getAvatar')->first();

        if(!$post){
            abort(404);
        };

        if($post->vision==0) {
            $this->authorize("view", $post);
        };

        return view('onepost',['post'=>$post]);
    }

    public function editPost($id)
    {
        $post = Post::where('id',$id)->first();

        $this->authorize("update",$post);

        return view('editpost',['post'=>$post]);
    }

    public function updatePost($id,PostRequest $req)
    {
        $post = Post::find($id);
        $this->authorize("update",$post);

        if (isset($req->vision)){
            $vision = 1;
        }else{$vision = 0;}

        $post->title = $req-> input('title');
        $post->text = $req-> input('message');
        $post->vision = $vision;
        $post->save();

        return redirect()->route("editpost", $id)->with('success',"Запись успешно изменена!");


    }

    public function update(Request $req, $id)
    {
         $post = Post::where('id',$id)->first();
         $this->authorize("update",$post);

        if (isset($req->vision)){
            $vision = 1;
        }else{$vision = 0;}

         $post->vision = $vision;
         $post->update();

       return back();
    }

    public function delete($id)
    {
        $post = Post::where('id',$id)->first();
        $this->authorize("update",$post);
        $post->delete();

        return back();
    }
}
