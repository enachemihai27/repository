<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class BoardController
 *
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function boards()
    {
        /** @var User $user */
        $user = Auth::user();

        $boards = Board::with(['user', 'boardUsers']);

        if ($user->role === User::ROLE_USER) {
            $boards = $boards->where(function ($query) use ($user) {
                //Suntem in tabele de boards in continuare
                $query->where('user_id', $user->id)
                    ->orWhereHas('boardUsers', function ($query) use ($user) {
                        //Suntem in tabela de board_users
                        $query->where('user_id', $user->id);
                    });
            });
        }

        $boards = $boards->paginate(10);

        return view(
            'boards.index',
            [
                'boards' => $boards
            ]
        );
    }

    


    public function updateBoard(Request $request, $id) : JsonResponse
    {
        
        $user = Auth::user();
        if ($user->role === User::ROLE_ADMIN) {
            
            
                $board = Board::find($id);
                
                $error = '';
                $success = '';
                
                if ($board) {
                    $name = $request->get('name');
                    $board->name = $name;
                    $board->save();
                    $board->refresh();
                    $success = 'Board saved';
                    } 
                    else{
                        $error="Board not found!";
                    }
                   
        }               
         else {
             $error="You are not admin or you not create this board";
        }   
        
    
        return response()->json(['error' => $error, 'success' => $success, 'board' => $board]);
        
    }



    public function deleteBoard($id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->role === User::ROLE_ADMIN) {
            $board = Board::find($id);

            $error = '';
            $success = '';

            if ($board) {
                $board->delete();

                $success = 'Board deleted';
            } else {
                $error = 'Board not found!';
            }
        } else{
            $error="You are not admin!";
        }    

        return response()->json(['error' => $error, 'success' => $success]);
    }





    /**
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function board($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $boards = Board::query();

        if ($user->role === User::ROLE_USER) {
            $boards = $boards->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereHas('boardUsers', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
            });
        }

        $board = clone $boards;
        $board = $board->where('id', $id)->first();

        $boards = $boards->select('id', 'name')->get();

        if (!$board) {
            return redirect()->route('boards.all');
        }

        return view(
            'boards.view',
            [
                'board' => $board,
                'boards' => $boards
            ]
        );
    }

    public function tasks()
    {
        $tasks = DB::table('tasks')->paginate(10);
        return view(
            'boards.view',
            [
                'tasks' => $tasks
            ]
        );
    }

    public function updateTask(Request $request, $id) : JsonResponse
    {    
                $task = Task::find($id);
                
                $error = '';
                $success = '';
                
                if ($task) {
                    $name = $request->get('name');
                    $description=$request->get('description');
                   // $assignment=$request->get('assignment');
                  //  $status=$request->get('status');
                    $task->name = $name;
                    $task->description= $description;
                  //  $task->assignment= $assignment;
                   // $task->status=$status;
                    $task->save();
                    $task->refresh();
                    $success = 'Task saved';
                    } 
                else{
                        $error="Task not found!";
                    }
    
        return response()->json(['error' => $error, 'success' => $success, 'board' => $task]);
        
    }
    

    public function deleteTask($id): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->role === User::ROLE_ADMIN) {
            $task = Task::find($id);

            $error = '';
            $success = '';

            if ($task) {
                $task->delete();

                $success = 'Task deleted';
            } else {
                $error = 'Task not found!';
            }
        } else{
            $error="You are not admin!";
        }    

        return response()->json(['error' => $error, 'success' => $success]);
    }

}
