<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'situacao_id', 'numero', 'ano', 'origem_id', 'descricao', 'tipo_id', 'entregueSupAdm', 'entregueComprasContrato', 'responsavel_id', 'inicioCotacao', 'terminoCotacao', 'requisicaoCompras', 'valor', 'envioSuplanPro', 'retornoSuplanPro', 'assinaturasGabinete', 'protocoloSisprot', 'envioCCOAF', 'retornoCCOAF', 'deliberacao_id', 'numeroPAC', 'modalidade_id', 'numeroModalidade', 'autuacao', 'inicioMinutas', 'teminoMinutas', 'inicioMinutasEdital', 'terminoMinutasEdital', 'envioPgm', 'retornoPgm', 'pendenciasPgm', 'numeroEdital', 'dataPregao', 'observacaoLicitacao', 'dataHomologacao', 'dataRatificacao', 'formalizacaoContratoArp', 'dataContratoArp', 'solicitacaoEmpenho', 'observacao',
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
        return $this->belongsTo(Origem::class);
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
}