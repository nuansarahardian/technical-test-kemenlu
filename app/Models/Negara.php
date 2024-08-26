<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    protected $table = 'negara';
    protected $primaryKey = 'id_negara';
    protected $fillable = [
        'nama_negara',
        'kode_negara',
        'id_kawasan',
        'id_direktorat',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];
    

    public function direktorat(){
    return $this->belongsTo(Direktorat::class, 'id_direktorat');
}
public function kawasan()
    {
        return $this->belongsTo(Kawasan::class, 'id_kawasan');
    }
   
}
