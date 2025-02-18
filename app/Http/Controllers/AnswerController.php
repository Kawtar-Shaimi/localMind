<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    // Enregistrer une nouvelle réponse
    public function store(Request $request, $question_id)
    {
        // Valider les données
        $request->validate([
            'content' => 'required'
        ]);

        // Créer la réponse
        $answer = new Answer();
        $answer->user_id = auth()->id();
        $answer->question_id = $question_id;
        $answer->content = $request->content;
        $answer->save();

        return redirect('/questions/' . $question_id)->with('success', 'Réponse ajoutée!');
    }

    // Supprimer une réponse
    public function destroy($id)
    {
        $answer = Answer::find($id);
        
        // Vérifier si l'utilisateur est le propriétaire
        if ($answer->user_id != auth()->id()) {
            return redirect()->back();
        }

        $answer->delete();
        return redirect()->back()->with('success', 'Réponse supprimée!');
    }
}
