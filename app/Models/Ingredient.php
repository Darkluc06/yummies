<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'ingredient_name',
        'image_path',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $visible = [
        'id',
        'ingredient_name',
        'image_path',
        'created_at',
        'updated_at',
    ];
}
