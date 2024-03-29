<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'situacao_id', 'numero', 'ano', 'origem_id', 'descricao', 'quantidadeItens', 'tipo_id', 'entregueSupAdm', 'entregueComprasContrato', 'responsavel_id', 'inicioCotacao', 'terminoCotacao', 'requisicaoCompras', 'valor', 'envioSuplanPro', 'retornoSuplanPro', 'protocoloSisprot', 'envioCCOAF', 'retornoCCOAF', 'deliberacao_id', 'numeroPAC', 'modalidade_id', 'numeroModalidade', 'autuacao', 'inicioMinutas', 'terminoMinutas', 'inicioMinutasARP', 'terminoMinutasARP', 'pregoeiro_id', 'inicioMinutasEdital', 'terminoMinutasEdital', 'envioPgm', 'retornoPgm', 'inicioSaneamentoPendencias', 'terminoSaneamentoPendencias', 'numeroEdital', 'dataPregao', 'impugnacao', 'inicioAnaliseTecnica', 'terminoAnaliseTecnica', 'dataHomologacao', 'dataRatificacao', 'dataReratificacao', 'formalizacaoContratoArp', 'dataContratoArp',  'publicacao', 'observacao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class);
    }

    public function origem()
    {
        return $this->belongsTo(Origem::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class);
    }

    public function deliberacao()
    {
        return $this->belongsTo(Deliberacao::class);
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class);
    }

    public function pregoeiro()
    {
        return $this->belongsTo(Pregoeiro::class);
    }

    public function trlogs()
    {
        return $this->hasMany(Trlog::class);
    }


    protected $dates = ['deleted_at', 'entregueSupAdm', 'entregueComprasContrato', 'inicioCotacao', 'terminoCotacao', 'envioSuplanPro', 'retornoSuplanPro', 'envioCCOAF', 'retornoCCOAF', 'autuacao', 'inicioMinutas', 'terminoMinutas', 'inicioMinutasEdital', 'terminoMinutasEdital', 'envioPgm', 'retornoPgm', 'pendenciasPgm', 'dataPregao', 'dataHomologacao', 'dataRatificacao', 'formalizacaoContratoArp', 'dataContratoArp', 'inicioSaneamentoPendencias', 'terminoSaneamentoPendencias', 'impugnacao', 'inicioAnaliseTecnica', 'terminoAnaliseTecnica', 'dataReratificacao', 'terminoMinutasARP', 'inicioMinutasARP' ];
}
