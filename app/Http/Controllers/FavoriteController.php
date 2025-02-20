<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::all()->where('user_id', auth()->id());
        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
        ]);
        Favorite::create([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
        ]);

        return redirect('/favorite')->route('favorite.index')->with('success', 'Ajouté aux favoris!');
    }

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
    public function update(Request $request, Favorite $favorite)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
        ]);
        $favorite->update([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
        ]);
        return redirect('/favorite')->route('favorite.index')->with('success', 'Favori mis à jour!');
    }


    public function destroy($question_id)
    {
        Favorite::where('user_id', auth()->id())
                ->where('question_id', $question_id)
                ->delete();

        return redirect()->route('favorite.index')->with('success', 'Retiré des favoris!');
    }
}
