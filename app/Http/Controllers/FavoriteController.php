<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['question', 'user'])->where('utilisateur_id', Auth::id())->get();
        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
        ]);

        Favorite::create([
            'utilisateur_id' => Auth::id(),
            'question_id' => $request->question_id,
        ]);

        return redirect()->back()->with('success', 'Ajouté aux favoris!');
    }


    public function destroy(Favorite $favorite)
    {
        $favorite->delete();
        return redirect()->back()->with('success', 'Retiré des favoris!');
    }
}
