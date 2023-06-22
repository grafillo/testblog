<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function changeAvatar(AvatarRequest $req, $id){

        if(isset($req->image)) {

                $user = User::where('id',$id)->first();
                $this->authorize("update",$user);

                if($user->avatar){
                  $old_avatar = 'public/'. $user->avatar;
                  Storage::delete($old_avatar);
                }

            $avatar = $req->file('image')->store('uploads','public');
            $user->avatar = $avatar;
            $user->update();

        }

        return back();
    }

}
