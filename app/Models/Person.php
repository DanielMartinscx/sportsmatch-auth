<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Person extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "person";

    protected $fillable = [
      'name',
      'email',
      'position',
      'password',
      'cep'
    ];
}
