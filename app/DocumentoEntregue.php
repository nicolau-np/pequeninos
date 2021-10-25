<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoEntregue extends Model
{
    protected $table = "documento_entregues";

    protected $fillable = [
        'id_historico',
        'documento',
        'estado',
    ];

    public function historico(){
        return $this->belongsTo(HistoricEstudante::class, 'id_historico', 'id');
    }
}