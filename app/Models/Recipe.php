<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'recipe_name',
        'description',
        'image_path',
        'recipe_duration',
        'portions',
        'food_category',
        'keywords'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $visible = [
        'id',
        'recipe_name',
        'description',
        'image_path',
        'recipe_duration',
        'portions',
        'food_category',
        'keywords',
        'created_at',
        'updated_at',
    ];
}
