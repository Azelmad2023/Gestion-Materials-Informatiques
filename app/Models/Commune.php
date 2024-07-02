<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    protected $primaryKey = 'code_Commune';
    public $incrementing = false;
    protected $fillable = ['code_Commune', 'nomcommune_AR', 'nomcommune_FR', 'code_Milieu'];
    public function etablissements()
    {
        return $this->hasMany(Etablissement::class, 'code_Commune', 'code_Commune');
    }
}
