<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if($request->search){ //if search
            $home_posts = $this->post->where('description', 'like', '%'.$request->search.'%')
                                    ->latest()->get();
                                    //SELECT * .... WHERE description LIKE '%searchword%'
        }else
        {
            //get all posts, with latest/newest posts first
            $all_posts = $this->post->latest()->get();

            //filter posts to only logged-in user's posts and followed user's posts
            $home_posts = [];
            foreach($all_posts as $post){
                if($post->user->isFollowed() || $post->user_id == Auth::user()->id){
                    $home_posts []= $post;
                }
            }
        }


        return view('user.home')->with('all_posts', $home_posts)
                                ->with('suggested_users', $this->getSuggestedUsers())
                                ->with('search', $request->search);
    }

    private function getSuggestedUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);

        $count = 0;
        $suggested_users = [];
        foreach($all_users as $user){
            if(!$user->isFollowed() && $count<10){
                $suggested_users []= $user;
                $count++; //add 1 to $count
            }
        }

        return $suggested_users;
    }
}
