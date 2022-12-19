<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedung';
    protected $fillable = [
        'nama_gedung',
        'lokasi',
        'harga',
    ];
    
}
