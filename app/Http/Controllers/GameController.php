<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameCollection;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return new GameCollection($games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|max:100',
            'genre_id' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $game = Game::create([
            'name' => $request->name,
            'price' => $request->price,
            'genre_id' => $request->genre_id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json(['Game is created successfully.', new GameResource($game)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($game_id)
    {
        $game = Game::find($game_id);
        if (is_null($game))
            return response()->json('Igrica nije pronadjena', 404);
        return response()->json($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|max:100',
            'genre_id' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());


        $game->name = $request->name;
        $game->price = $request->price;
        $game->genre_id = $request->genre_id;

        $game->save();

        return response()->json(['Game is updated successfully.', new GameResource($game)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return response()->json('Game is deleted successfully.');
    }
}
