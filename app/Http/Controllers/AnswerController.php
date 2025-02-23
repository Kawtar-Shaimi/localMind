<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    // Enregistrer une nouvelle réponse
    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'question_id' => 'required',
            'content' => 'required'
        ]);

        // Créer la réponse
        Answer::create([
            'utilisateur_id' => Auth::id(),
            'question_id' =>$request->question_id,
            'content' => $request->content
        ]);

        return redirect()->route('questions.show',['id' => $request->question_id])->with('success', 'Réponse ajoutée!');
    }

    public function update(Request $request, Answer $answer)
    {
        // Valider les données
        $request->validate([
            'question_id' => 'required',
            'content' => 'required'
        ]);

        // Créer la réponse
        $answer->update([
            'content' => $request->content
        ]);

        return redirect()->route('questions.show',['id' => $request->question_id])->with('success', 'Réponse modifiée!');
    }

    // Supprimer une réponse
    public function destroy(Request $request, Answer $answer)
    {
        $request->validate([
            'question_id' => 'required'
        ]);

        // Vérifier si l'utilisateur est le propriétaire
        if ($answer->user_id != Auth::id()) {
            return redirect()->back();
        }

        $answer->delete();
        return redirect()->route('questions.show',['id' => $request->question_id])->with('success', 'Réponse supprimée!');
    }

}
