<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        //get all users, ordered by name
        $all_users = $this->user->orderBy('name')
                                ->withTrashed()->paginate(10);
        //paginate(n) - display with n rows per page
        //withTrashed - include (in the list) soft-deleted records

        return view('admin.users.index')->with('all_users', $all_users);
    }

    public function deactivate($id){
        $this->user->destroy($id); 

        return redirect()->back();
    }

    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        //onlyTrashed() - look only in soft-deleted records
        //restore - activates records 

        return redirect()->back();
    }
}
