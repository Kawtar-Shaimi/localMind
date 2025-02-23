<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Utilisateur;
use App\Models\Answer;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'title',
        'content',
        'location_name'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
