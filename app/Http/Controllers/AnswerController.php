<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{

    public function index(){
        $answers = Answer::all();
        return view('answers.index', compact('answers'));
    }


    public function create(){
        return view('answers.create');
    }
    // Enregistrer une nouvelle réponse
    public function store(Request $request, $question_id)
    {
        // Valider les données
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
            'content' => 'required'
        ]);

        // Créer la réponse
        Answer::create([
            'user_id' => $request->user_id,
            'question_id' =>$request-> question_id,
            'content' => $request->content
        ]);

        return redirect('/questions/' . $question_id)->route('answer.index')->with('success', 'Réponse ajoutée!');
    }

    public function edit(Answer $answer){
        return view('answers.edit', compact('answer'));
    }

    // Supprimer une réponse
    public function destroy(Answer $answer)
    {        
        // Vérifier si l'utilisateur est le propriétaire
        if ($answer->user_id != auth()->id()) {
            return redirect()->back();
        }

        $answer->delete();
        return redirect()->route('answers.index')->with('success', 'Réponse supprimée!');
    }

}
