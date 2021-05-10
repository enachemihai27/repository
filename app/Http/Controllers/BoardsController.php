<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

/**
 * Class BoardsController
 *
 * @package App\Http\Controllers
 */
class BoardsController extends Controller
{

    public function boards()
    {
        $boards = DB::table('boards')->paginate(10);
        return view(
            'boards.boards',
            [
                'boards' => $boards
            ]
        );
    }



    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('boards/boards');
    }
}
