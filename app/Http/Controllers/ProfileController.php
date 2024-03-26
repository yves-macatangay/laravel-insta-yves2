<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        //get data of one user with ID=$id
        $user_a = $this->user->findOrFail($id);

        return view('user.profiles.show')->with('user', $user_a);
    } 

    public function edit(){
        return view('user.profiles.edit');
    }

    public function update(Request $request){

        $request->validate([
            'avatar' => 'max:1048|mimes:jpeg,jpg,png,gif',
            'name' => 'required|max:50',
            'email' => 'required|max:50|email|unique:users,email,'.Auth::user()->id,
            //email - email format
            //when adding new record, unique:<table name>,<column name>
            //when updating, unique:<table>,<column>,<id>
            'introduction' => 'max:100'
        ]);

        //update name, email, introduction
        $user_a = $this->user->findOrFail(Auth::user()->id);
        $user_a->name = $request->name;
        $user_a->email = $request->email;
        $user_a->introduction = $request->introduction;

        //if form has avatar
           // update avatar
        if($request->avatar){
            $user_a->avatar = 'data:image/'.$request->avatar->extension().
                                ';base64,'.base64_encode(file_get_contents($request->avatar));
        }
        
        //save
        $user_a->save();

        //redirect to profile show
        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function followers($id){

        $user_a = $this->user->findOrFail($id);

        return view('user.profiles.followers')->with('user', $user_a);
    }

    public function following($id){

        $user_a = $this->user->findOrFail($id);

        return view('user.profiles.following')->with('user', $user_a);
    }
}
