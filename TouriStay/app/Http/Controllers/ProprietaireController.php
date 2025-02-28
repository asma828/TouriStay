<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Annonce;



class ProprietaireController extends Controller
{
    public function dashboard()
{
    $userId = Auth::id(); // Récupère l'ID du propriétaire

    // Récupérer les annonces
    $annonces = Annonce::where('user_id', $userId)
                       ->orderBy('created_at', 'desc')
                       ->paginate(10); 

    return view('proprietaire.dashboard', compact('annonces'));
}

  /**
     * Affiche le formulaire de création d'annonce
     */
    public function create()
    {
        return view('annonces.create');
    }

    /**
     * Enregistre une nouvelle annonce dans la base de données
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ville' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'equipements' => 'nullable|array',
            'disponible_du' => 'required|date',
            'disponible_au' => 'required|date|after:disponible_du',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public');
        }

        // Conversion des équipements en chaîne JSON
        $equipements = $request->has('equipements') ? json_encode($request->equipements) : json_encode([]);

        // Création de l'annonce
        $annonce = Annonce::create([
            'user_id' => Auth::id(),
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'ville' => $validated['ville'],
            'prix' => $validated['prix'],
            'equipements' => $equipements,
            'disponible_du' => $validated['disponible_du'],
            'disponible_au' => $validated['disponible_au'],
            'images' => isset($imagePath) ? $imagePath : '',
        ]);

        return redirect()->route('proprietaire.dashboard')
            ->with('success', 'Votre annonce a été publiée avec succès!');
    }

    /**
     * Affiche une annonce spécifique
     */
    public function show(Annonce $annonce)
    {
        // Vérification que l'utilisateur est le propriétaire de l'annonce
        if ($annonce->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à cette annonce.');
        }

        return view('annonces.show', compact('annonce'));
    }

    /**
     * Affiche le formulaire d'édition d'une annonce
     */
    public function edit(Annonce $annonce)
    {
        // Vérification que l'utilisateur est le propriétaire de l'annonce
        if ($annonce->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette annonce.');
        }

        return view('annonces.edit', compact('annonce'));
    }

    /**
     * Met à jour l'annonce dans la base de données
     */
    public function update(Request $request, Annonce $annonce)
    {
        // Vérification que l'utilisateur est le propriétaire de l'annonce
        if ($annonce->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette annonce.');
        }

        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'ville' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'equipements' => 'nullable|array',
            'disponible_du' => 'required|date',
            'disponible_au' => 'required|date|after:disponible_du',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($annonce->images) {
                Storage::disk('public')->delete($annonce->images);
            }
            
            $imagePath = $request->file('image')->store('annonces', 'public');
            $annonce->images = $imagePath;
        }

        // Conversion des équipements en chaîne JSON
        $equipements = $request->has('equipements') ? json_encode($request->equipements) : json_encode([]);

        // Mise à jour de l'annonce
        $annonce->titre = $validated['titre'];
        $annonce->description = $validated['description'];
        $annonce->ville = $validated['ville'];
        $annonce->prix = $validated['prix'];
        $annonce->equipements = $equipements;
        $annonce->disponible_du = $validated['disponible_du'];
        $annonce->disponible_au = $validated['disponible_au'];
        $annonce->save();

        return redirect()->route('proprietaire.dashboard')
            ->with('success', 'Votre annonce a été mise à jour avec succès!');
    }

    /**
     * Supprime l'annonce de la base de données
     */
    public function destroy(Annonce $annonce)
    {
        // Vérification que l'utilisateur est le propriétaire de l'annonce
        if ($annonce->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cette annonce.');
        }

        // Supprimer l'image associée
        if ($annonce->images) {
            Storage::disk('public')->delete($annonce->images);
        }

        $annonce->delete();

        return redirect()->route('proprietaire.dashboard')
            ->with('success', 'L\'annonce a été supprimée avec succès!');
    }


}


