<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    // Afficher la liste des questions
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();
        return view('questions.index', ['questions' => $questions]);
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('questions.create');
    }

    // Enregistrer une nouvelle question
    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'location_name' => 'required'
        ]);

        // Créer la question
        $question = new Question();
        $question->user_id = auth()->id();
        $question->title = $request->title;
        $question->content = $request->content;
        $question->latitude = $request->latitude;
        $question->longitude = $request->longitude;
        $question->location_name = $request->location_name;
        $question->save();

        return redirect('/questions')->with('success', 'Question créée avec succès!');
    }

    // Afficher une question
    public function show($id)
    {
        $question = Question::find($id);
        return view('questions.show', ['question' => $question]);
    }

    // Afficher le formulaire de modification
    public function edit($id)
    {
        $question = Question::find($id);
        
        // Vérifier si l'utilisateur est le propriétaire
        if ($question->user_id != auth()->id()) {
            return redirect('/questions');
        }

        return view('questions.edit', ['question' => $question]);
    }

    // Mettre à jour une question
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        
        // Vérifier si l'utilisateur est le propriétaire
        if ($question->user_id != auth()->id()) {
            return redirect('/questions');
        }

        // Valider les données
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'location_name' => 'required'
        ]);

        // Mettre à jour la question
        $question->title = $request->title;
        $question->content = $request->content;
        $question->location_name = $request->location_name;
        $question->save();

        return redirect('/questions')->with('success', 'Question mise à jour!');
    }

    // Supprimer une question
    public function destroy($id)
    {
        $question = Question::find($id);
        
        // Vérifier si l'utilisateur est le propriétaire
        if ($question->user_id != auth()->id()) {
            return redirect('/questions');
        }

        $question->delete();
        return redirect('/questions')->with('success', 'Question supprimée!');
    }
}
