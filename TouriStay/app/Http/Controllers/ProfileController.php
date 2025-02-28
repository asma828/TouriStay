<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.userprofile', compact('user'));
    }

   /**
    * Met à jour les informations personnelles du propriétaire
    */
   public function updateProfile(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
       ]);

       $user = Auth::user();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->save();

       return redirect()->route('profile.userprofile')
           ->with('success', 'Vos informations personnelles ont été mises à jour avec succès.');
   }

   /**
    * Met à jour la photo de profil du propriétaire
    */
   public function updateProfilePhoto(Request $request)
   {
       $request->validate([
           'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);

       $user = Auth::user();

       // Supprimer l'ancienne photo si elle existe
       if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
           Storage::disk('public')->delete($user->avatar);
       }

       // Stocker la nouvelle photo
       $path = $request->file('photo')->store('profile-photos', 'public');
       $user->avatar = $path;
       $user->save();

       return redirect()->route('profile.userprofile')
           ->with('success', 'Votre photo de profil a été mise à jour avec succès.');
   }
}
