<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Utilisateur;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'question_id',
        'content'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
