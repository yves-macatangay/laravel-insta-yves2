<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category){
        $this->post = $post;
        $this->category = $category;
    }

    public function create(){
        $all_categories = $this->category->all();

        return view('user.posts.create')
        ->with('all_categories', $all_categories);
    }

    public function store(Request $request){

        $request->validate([
            'categories' => 'required|array|between:1,3',
            //between (used in combination with array) - min and max no. of items in array
            'description' => 'required|max:1000',
            'image' => 'required|max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $this->post->user_id = Auth::user()->id;
        $this->post->image = 'data:image/'.$request->image->extension().
                            ';base64,'.base64_encode(file_get_contents($request->image));
        $this->post->description = $request->description;
        $this->post->save();

        $category_posts = [];
        foreach($request->categories as $category_id){
            $category_posts []= ['category_id' => $category_id];
        }
        // $category_posts = [
        //     [
        //         'category_id' => 1
        //     ],
        //     [
        //         'category_id' => 2
        //     ]
        // ]

        //$this->post->id
        $this->post->categoryPosts()->createMany($category_posts);

        return redirect()->route('index');

    }

    public function show($id){
        $post_a = $this->post->findOrFail($id);

        return view('user.posts.show')->with('post', $post_a);
    }

    public function edit($id){
        $post_a = $this->post->findOrFail($id);
        $all_categories = $this->category->all();

        $selected_categories = [];
        foreach($post_a->categoryPosts as $category_post){
            $selected_categories []= $category_post->category_id; //insert category_id into array $selected_categories
        }

        return view('user.posts.edit')->with('post', $post_a)
                                    ->with('all_categories', $all_categories)
                                    ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id){
        $request->validate([
            'categories' => 'required|array|between:1,3',
            //between (used in combination with array) - min and max no. of items in array
            'description' => 'required|max:1000',
            'image' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        //find the record to update
        $post_a = $this->post->findOrFail($id);

        //update the column data
        $post_a->description = $request->description;
        if($request->image){ //if the form has an image submitted
            $post_a->image = 'data:image/'.$request->image->extension().
                            ';base64,'.base64_encode(file_get_contents($request->image));
        }
        $post_a->save();

        $post_a->categoryPosts()->delete();

        $category_posts = []; //create an empty array
        foreach($request->categories as $category_id){ //loop through checked categories from the form
             //insert checked category id into the empty array
             $category_posts []= ['category_id' => $category_id];
        }

        $post_a->categoryPosts()->createMany($category_posts);

        return redirect()->route('post.show', $id);

    }

    public function destroy($id){
       // $this->post->destroy($id);
        $post_a = $this->post->findOrFail($id);
        $post_a->forceDelete(); //-- forces a permanent delete

        return redirect()->route('index');
    }
}
