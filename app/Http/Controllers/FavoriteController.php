<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['question' => function($query){
            $query->withCount('answers');
        } , 'utilisateur'])
        ->where('utilisateur_id', Auth::id())->get();
        return view('favorites.index', compact('favorites'));
    }

    public function store(Question $question)
    {
        Favorite::create([
            'utilisateur_id' => Auth::id(),
            'question_id' => $question->id,
        ]);

        return redirect()->back()->with('success', 'Ajouté aux favoris!');
    }


    public function destroy(Question $question)
    {
        Favorite::where('question_id', $question->id)->delete();
        return redirect()->back()->with('success', 'Retiré des favoris!');
    }
}
