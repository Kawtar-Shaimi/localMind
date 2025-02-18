<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())
        ->get();
        
        return view('favorites.index', ['favorites' => $favorites]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($question_id)
    {
        $favorite = new Favorite();
        $favorite->user_id = auth()->id();
        $favorite->question_id = $question_id;
        $favorite->save();

        return redirect()->back()->with('success', 'Ajouté aux favoris!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($question_id)
    {
        Favorite::where('user_id', auth()->id())
                ->where('question_id', $question_id)
                ->delete();

        return redirect()->back()->with('success', 'Retiré des favoris!');
    }
}
