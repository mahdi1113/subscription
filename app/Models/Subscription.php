<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'descriptions', 'price'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function abilities()
    {
        return $this->hasMany(Abilitie::class);
    }
}
