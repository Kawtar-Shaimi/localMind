<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::all()->where('user_id', auth()->id());
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
        ]);
        Utilisateur::create([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
        ]);

        return redirect('/utilisateur')->route('utilisateur.index')->with('success', 'Ajouté aux utilisateurs !');
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
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
        ]);
        $utilisateur->update([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
        ]);
        return redirect('/utilisateur')->route('utilisateur.index')->with('success', 'Utilisateur mis à jour!');
    }

    public function destroy(Utilisateur $utilisateur){
        $utilisateur->delete();
        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur supprimé!');
    }
}
