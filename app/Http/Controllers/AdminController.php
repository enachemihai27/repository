<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    public function users()
    {
        $users = DB::table('users')->paginate(10);
        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }

    public function updateUser(Request $request)
    {
        
        $user=User::find($request->id);
        $user->role = $request->option('editRole');
        $user->save();
        return response()->json($user);
    }




    public function removeUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['succes' =>'Record has benn deleted']);      
    }
}    