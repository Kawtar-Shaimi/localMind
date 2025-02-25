<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    // Enregistrer une nouvelle réponse
    public function store(Request $request, Question $question)
    {
        // Valider les données
        $request->validate([
            'content' => 'required'
        ]);

        // Créer la réponse
        Answer::create([
            'utilisateur_id' => Auth::id(),
            'question_id' => $question->id,
            'content' => $request->content
        ]);

        return redirect()->route('questions.show',$question)->with('success', 'Réponse ajoutée!');
    }

    public function update(Request $request, Answer $answer)
    {
        // Valider les données
        $request->validate([
            'content' => 'required'
        ]);

        // Créer la réponse
        $answer->update([
            'content' => $request->content
        ]);

        return redirect()->route('questions.show',['question' => $answer->question_id])->with('success', 'Réponse modifiée!');
    }

    // Supprimer une réponse
    public function destroy(Question $question)
    {

        $answer = Answer::where('question_id', $question->id)->first();

        // Vérifier si l'utilisateur est le propriétaire
        if ($answer->utilisateur_id != Auth::id()) {
            return redirect()->back();
        }

        $answer->delete();
        return redirect()->route('questions.show',$question)->with('success', 'Réponse supprimée!');
    }

}
