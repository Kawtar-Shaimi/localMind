<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Afficher la liste des questions
    public function index()
    {
        $questions = Question::with('utilisateur')->withCount('answers')->orderBy('created_at', 'desc')->get();
        return view('index', compact('questions'));
    }

    public function userQuestion()
    {
        $questions = Question::where('utilisateur_id', Auth::id())
        ->with('utilisateur')->withCount('answers')->orderBy('created_at', 'desc')->get();
        return view('index', compact('questions'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('questions.create');
    }

    // Afficher une question
    public function show(Question $question)
    {
        $question = $question->with(['answers','utilisateur'])->withCount('answers')->first();
        return view('questions.show', compact('question'));
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
            'utilisateur_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => $request->location_name
        ]);
        return redirect()->route('home')->with('success', 'Question créée avec succès!');
    }

    // Afficher le formulaire de modification
    public function edit(Question $question)
    {
        // Vérifier si l'utilisateur est le propriétaire
        if ($question->utilisateur_id === Auth::id()) {
            return view('questions.edit',compact('question'));
        }

        return back();
    }

    // Mettre à jour une question
    public function update(Request $request, Question $question)
    {
        // Valider les données
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'location_name' => 'required'
        ]);

        // Mettre à jour la question
        $question->update([
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => $request->location_name
        ]);
        return redirect()->route('home')->with('success', 'Question mise à jour!');
    }

    // Supprimer une question
    public function destroy(Question $question)
    {
        if ($question->utilisateur_id === Auth::id()) {
            $question->delete();
            return redirect()->route('home')->with('success', 'Question supprimée!');
        }

        return back();
    }
}
