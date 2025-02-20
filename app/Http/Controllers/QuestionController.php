<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    // Afficher la liste des questions
    public function index()
    {
        $questions = Question::all()->orderBy('created_at', 'desc')->get();
        return view('questions.index', compact('questions'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('questions.create');
    }

    // Afficher une question
    public function show(Question $question)
    {
        // $question = Question::find($question);
        return view('questions.show', compact('questions'));
    }

    // Enregistrer une nouvelle question
    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'location_name' => 'required'
        ]);

        // Créer la question
        Question::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => $request->location_name
        ]);
        return redirect('/questions')->route('questions.index')->with('success', 'Question créée avec succès!');
    }

    // Afficher le formulaire de modification
    public function edit(Question $question)
    {        
        // Vérifier si l'utilisateur est le propriétaire
        if ($question->user_id != auth()->id()) {
            return view('questions.index',compact('questions'));
        }
    }

    // Mettre à jour une question
    public function update(Request $request, Question $question)
    {
        // Valider les données
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'location_name' => 'required'
        ]);

        // Mettre à jour la question
        $question->update([
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => $request->location_name
        ]);
        return redirect('/questions')->route('questions.index')->with('success', 'Question mise à jour!');
    }

    // Supprimer une question
    public function destroy(Question $question)
    {        
        // Vérifier si l'utilisateur est le propriétaire
        if ($question->user_id != auth()->id()) {
            return redirect('/questions');
        }
        $question->delete();
        return redirect('/questions')->route('questions.index')->with('success', 'Question supprimée!');
    }
}
