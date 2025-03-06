<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'ville',
        'prix',
        'equipements',
        'disponible_du',
        'disponible_au',
        'images',
    ];
    
    protected $casts = [
        'disponible_du' => 'date',
        'disponible_au' => 'date',
        'prix' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'annonce_id');
    }

    public function getEquipementsArrayAttribute()
    {
        return explode(',', $this->equipements);
    }
}
