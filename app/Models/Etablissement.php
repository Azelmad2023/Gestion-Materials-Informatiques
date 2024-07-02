<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etablissement extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'etablissement';

    protected $primaryKey = 'code_Gresa';

    public $incrementing = false;

    protected $fillable = [
        'code_Gresa',
        'nomEtabllissemnt_AR',
        'nomEtabllissemnt_FR',
        'email',
        'cycle',
        'password',
        'code_Commune',
        'token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'code_Commune', 'code_Commune');
    }

    public function materialInformatiques()
    {
        return $this->hasMany(MaterialInformatique::class, 'code_Gresa', 'code_Gresa');
    }
}
