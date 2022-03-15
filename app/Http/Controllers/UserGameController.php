<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class UserGameController extends Controller
{
    public function index($user_id)
    {
        $games = Game::get()->where('user_id', $user_id);
        if (is_null($games))
            return response()->json('Greska!', 404);
        return response()->json($games);
    }
}
