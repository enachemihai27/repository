<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    // /**
    //  * @return Application|Factory|View
    //  */
    
    // public function index()
    // {
    //     $boards= Board::all();
    //     $tasks= Task::all();
        
    //     return view(
    //         'dashboard.index',
    //         [
    //             'boards' => $boards,
    //             'tasks' =>$tasks
    //         ]
    //     );
    // }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
       

        $users = User::all();
        $boards= Board::all();
        $tasks= Task::all();
 
        
        return view(
            'dashboard.index',
            [
                'users' => $users,
                'boards' => $boards,
                'tasks' => $tasks
                
                
                
                
            ]
        );
    }
}
