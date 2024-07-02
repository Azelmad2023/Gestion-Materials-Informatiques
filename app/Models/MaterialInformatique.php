<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialInformatique extends Model
{
    use HasFactory;
    protected $primaryKey = 'Num_Inv';
    public $incrementing = false;
    protected $fillable = ['Num_Inv', 'type', 'marque', 'dateDacquisition', 'EF', 'etat', 'code_Gresa'];
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'code_Gresa', 'code_Gresa');
    }
}
