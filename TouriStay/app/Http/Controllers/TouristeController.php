<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TouristeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:touriste');
    }

    public function dashboard(Request $request)
    {
        
        $perPage = $request->perPage ?? 10;
        
        // Get all available annonces 
        $annonces = Annonce::whereDate('disponible_au', '>=', Carbon::now())
                           ->orderBy('created_at', 'desc')
                           ->paginate($perPage);
        
        // Get user's favorites
        $favorites = Favorite::where('user_id', Auth::id())
                          ->pluck('annonce_id');
    
        // Popular cities 
        $popularCities = [
            ['name' => 'Casablanca', 'country' => 'Maroc', 'image' => 'casablanca.jpg'],
            ['name' => 'Madrid', 'country' => 'Espagne', 'image' => 'madrid.jpg'],
            ['name' => 'Lisbonne', 'country' => 'Portugal', 'image' => 'lisbonne.jpg'],
        ];
        
        
        return view('touriste.dashboard', compact('annonces', 'favorites', 'popularCities'));
    }
    
    public function search(Request $request)
    {
        $query = Annonce::query();
        
        // search by ville et dates
        if ($request->filled('city')) {
            $query->where('ville', 'like', '%' . $request->city . '%');
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('disponible_du', '<=', $request->date_from)
                  ->whereDate('disponible_au', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('disponible_au', '>=', $request->date_to);
        }
        

        $perPage = $request->perPage ?? 10;
        
        $annonces = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        // Get user's favorites
        $favorites = Favorite::where('user_id', Auth::id())
                          ->pluck('annonce_id');
        
        // Popular cities 
        $popularCities = [
            ['name' => 'Casablanca', 'country' => 'Maroc', 'image' => 'casablanca.jpg'],
            ['name' => 'Madrid', 'country' => 'Espagne', 'image' => 'madrid.jpg'],
            ['name' => 'Lisbonne', 'country' => 'Portugal', 'image' => 'lisbonne.jpg'],
        ];
        
        return view('touriste.dashboard', compact('annonces', 'favorites', 'popularCities'));
    }
    
    public function showAnnonce($id)
    {
        $annonce = Annonce::findOrFail($id);
        $isFavorite = Favorite::where('user_id', Auth::id())
                            ->where('annonce_id', $id)
                            ->exists();
        
        return view('annonces.show', compact('annonce', 'isFavorite'));
    }
    
    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'is_favorite' => 'required|boolean'
        ]);
        
        if ($request->is_favorite) {
            // Remove from favorites
            Favorite::where('user_id', Auth::id())
                  ->where('annonce_id', $request->annonce_id)
                  ->delete();
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => Auth::id(),
                'annonce_id' => $request->annonce_id
            ]);
        }
        
        return response()->json(['success' => true]);
    }
    
    public function favorites()
    {
        $favorisIds = Favorite::where('user_id', Auth::id())->pluck('annonce_id');
        $annonces = Annonce::whereIn('id', $favorisIds)->paginate(10);
        $favorites = $favorisIds; //  displayed favorites annonces
        
        return view('touriste.favorites', compact('annonces', 'favorites'));
    }
    
}