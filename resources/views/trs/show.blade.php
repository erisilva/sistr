@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
      <li class="breadcrumb-item active" aria-current="page">Exibir Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  <form>

    <div class="form-row">
      <div class="form-group col-md-3">
          <div class="p-3 bg-primary text-white text-right h2">Nº {{ $tr->numero }}/{{ $tr->ano }}</div>
      </div>
      <div class="form-group col-md-3">
        <label for="situacao">STATUS</label>
        <input type="text" class="form-control" name="situacao" value="{{ $tr->situacao->descricao }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="origem">Solicitante</label>
        <input type="text" class="form-control" name="origem" value="{{ $tr->origem->descricao }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="tipo">Tipo</label>
        <input type="text" class="form-control" name="tipo" value="{{ $tr->tipo->descricao }}" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="descricao">Objeto</label>
      <textarea class="form-control" name="descricao" id="descricao" rows="3" readonly>{{ $tr->descricao }}</textarea>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="quantidadeItens">Qtde. Itens </label>
        <input type="text" class="form-control" name="quantidadeItens" value="{{ $tr->quantidadeItens }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="entregueSupAdm">Entrada na S.A.</label>
        <input type="text" class="form-control" name="entregueSupAdm" value="{{ isset($tr->entregueSupAdm) ?  $tr->entregueSupAdm->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="entregueComprasContrato">Entrada DCC</label>
        <input type="text" class="form-control" name="entregueComprasContrato" value="{{ isset($tr->entregueComprasContrato) ?  $tr->entregueComprasContrato->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>


    <div class="form-row">

      <div class="form-group col-md-2">
        <label for="responsavel">Responsável cotação</label>
        <input type="text" class="form-control" name="responsavel" value="{{ $tr->responsavel->nome }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="inicioCotacao">Início cotação </label>
        <input type="text" class="form-control" name="inicioCotacao" value="{{ isset($tr->inicioCotacao) ?  $tr->inicioCotacao->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="terminoCotacao">Término cotação </label>
        <input type="text" class="form-control" name="terminoCotacao" value="{{ isset($tr->terminoCotacao) ?  $tr->terminoCotacao->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="requisicaoCompras">Requisição Compras Nº</label>
        <input type="text" class="form-control" name="requisicaoCompras" value="{{ $tr->requisicaoCompras }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="valor">Valor R$ </label>
        <input type="text" class="form-control" name="valor" value="{{ $tr->valor }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="envioSuplanPro">Envio SUPLAN  </label>
        <input type="text" class="form-control" name="envioSuplanPro" value="{{ isset($tr->envioSuplanPro) ?  $tr->envioSuplanPro->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="retornoSuplanPro">Retorno SUPLAN</label>
        <input type="text" class="form-control" name="retornoSuplanPro" value="{{ isset($tr->retornoSuplanPro) ?  $tr->retornoSuplanPro->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="protocoloSisprot">SISPROT Nº </label>
        <input type="text" class="form-control" name="protocoloSisprot" value="{{ $tr->protocoloSisprot }}" readonly>
      </div>

      <div class="form-group col-md-3">
        <label for="envioCCOAF">Envio CCOAF</label>
        <input type="text" class="form-control" name="envioCCOAF" value="{{ isset($tr->envioCCOAF) ?  $tr->envioCCOAF->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="retornoCCOAF">Retorno CCOAF</label>
        <input type="text" class="form-control" name="retornoCCOAF" value="{{ isset($tr->retornoCCOAF) ?  $tr->retornoCCOAF->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="deliberacao">Deliberação CCOAF</label>
        <input type="text" class="form-control" name="deliberacao" value="{{ $tr->deliberacao->descricao }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="numeroPAC">PAC Nº</label>
        <input type="text" class="form-control" name="numeroPAC" value="{{ $tr->numeroPAC }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="modalidade">Modalidade</label>
        <input type="text" class="form-control" name="modalidade" value="{{ $tr->modalidade->descricao }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="numeroModalidade">Nº Modalidade </label>
        <input type="text" class="form-control" name="numeroModalidade" value="{{ $tr->numeroModalidade }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="autuacao">Autuação PAC</label>
        <input type="text" class="form-control" name="autuacao" value="{{ isset($tr->autuacao) ?  $tr->autuacao->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutas">Início minuta (contrato/aditivo)</label>
        <input type="text" class="form-control" name="inicioMinutas" value="{{ isset($tr->autinicioMinutasuacao) ?  $tr->inicioMinutas->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="terminoMinutas">Término minuta (contrato/aditivo)</label>
        <input type="text" class="form-control" name="terminoMinutas" value="{{ isset($tr->terminoMinutas) ?  $tr->terminoMinutas->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="inicioMinutasARP">Início minuta ARP</label>
        <input type="text" class="form-control" name="inicioMinutasARP" value="{{ isset($tr->autinicioMinutasuacao) ?  $tr->inicioMinutasARP->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="terminoMinutasARP">Término minuta ARP</label>
        <input type="text" class="form-control" name="terminoMinutasARP" value="{{ isset($tr->terminoMinutasARP) ?  $tr->terminoMinutasARP->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="pregoeiro">Pregoeiro (a)</label>
        <input type="text" class="form-control" name="pregoeiro" value="{{ $tr->pregoeiro->nome }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutasEdital">Início minuta Edital</label>
        <input type="text" class="form-control" name="inicioMinutasEdital" value="{{ isset($tr->inicioMinutasEdital) ?  $tr->inicioMinutasEdital->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="terminoMinutasEdital">Término minuta Edital</label>
        <input type="text" class="form-control" name="terminoMinutasEdital" value="{{ isset($tr->terminoMinutasEdital) ?  $tr->terminoMinutasEdital->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="envioPgm">Envio PGM </label>
        <input type="text" class="form-control" name="envioPgm" value="{{ isset($tr->envioPgm) ?  $tr->envioPgm->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="retornoPgm">Retorno PGM</label>
        <input type="text" class="form-control" name="retornoPgm" value="{{ isset($tr->retornoPgm) ?  $tr->retornoPgm->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioSaneamentoPendencias">Início Saneamento Pendênias </label>
        <input type="text" class="form-control" name="inicioSaneamentoPendencias" value="{{ isset($tr->inicioSaneamentoPendencias) ?  $tr->inicioSaneamentoPendencias->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="terminoSaneamentoPendencias">Término Saneamento Pendências </label>
        <input type="text" class="form-control" name="terminoSaneamentoPendencias" value="{{ isset($tr->terminoSaneamentoPendencias) ?  $tr->terminoSaneamentoPendencias->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="numeroEdital">Nº EDITAL </label>
        <input type="text" class="form-control" name="numeroEdital" value="{{ $tr->numeroEdital }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="dataPregao">Data PREGÃO </label>
        <input type="text" class="form-control" name="dataPregao" value="{{ isset($tr->dataPregao) ?  $tr->dataPregao->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="impugnacao">Impugnação / Suspensão </label>
        <input type="text" class="form-control" name="impugnacao" value="{{ isset($tr->impugnacao) ?  $tr->impugnacao->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioAnaliseTecnica">Início Análise Técnica </label>
        <input type="text" class="form-control" name="inicioAnaliseTecnica" value="{{ isset($tr->inicioAnaliseTecnica) ?  $tr->inicioAnaliseTecnica->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="terminoAnaliseTecnica">Término Análise Técnica  </label>
        <input type="text" class="form-control" name="terminoAnaliseTecnica" value="{{ isset($tr->terminoAnaliseTecnica) ?  $tr->terminoAnaliseTecnica->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="dataHomologacao">Homologação </label>
        <input type="text" class="form-control" name="dataHomologacao" value="{{ isset($tr->dataHomologacao) ?  $tr->dataHomologacao->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="dataRatificacao">Ratificação </label>
        <input type="text" class="form-control" name="dataRatificacao" value="{{ isset($tr->dataRatificacao) ?  $tr->dataRatificacao->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="dataReratificacao">Reratificação </label>
        <input type="text" class="form-control" name="dataReratificacao" value="{{ isset($tr->dataReratificacao) ?  $tr->dataReratificacao->format('d/m/Y') : '-' }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="formalizacaoContratoArp">Formalização (contrato/aditivo/ARP) </label>
        <input type="text" class="form-control" name="formalizacaoContratoArp" value="{{ isset($tr->formalizacaoContratoArp) ?  $tr->formalizacaoContratoArp->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="dataContratoArp">Data (contrato/aditivo/ARP)  </label>
        <input type="text" class="form-control" name="dataContratoArp" value="{{ isset($tr->dataContratoArp) ?  $tr->dataContratoArp->format('d/m/Y') : '-' }}" readonly>
      </div>
      <div class="form-group col-md-4">
        <label for="sei">Nº SEI </label>
        <input type="text" class="form-control" name="sei" value="{{ $tr->sei }}" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="publicacao">PUBLICAÇÃO DOC</label>
      <textarea class="form-control" name="publicacao" id="publicacao" rows="3" readonly>{{ $tr->publicacao }}</textarea>
    </div>

    <div class="form-group">
      <label for="observacao">Observações</label>
      <textarea class="form-control" name="observacao" id="observacao" rows="3" readonly>{{ $tr->observacao }}</textarea>
    </div>


    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="datacadastro">Data de Cadastro</label>
        <input type="text" class="form-control" name="datacadastro" value="{{ $tr->created_at->format('d/m/Y') }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="horacadastro">Hora de Cadastro </label>
        <input type="text" class="form-control" name="horacadastro" value="{{ $tr->created_at->format('H:i') }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="username">Funcionário Responsável</label>
        <input type="text" class="form-control" name="username" value="{{ $tr->user->name }}" readonly>
      </div>
    </div>


  </form>
</div>
<div class="container py-3">
  <a href="{{ route('trs.index') }}" class="btn btn-primary" role="button"><i class="bi bi-arrow-left"></i> Voltar</i></a>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalLixeira"><i class="bi bi-trash"></i> Enviar para Lixeira</button>
</div>
<div class="modal fade" id="modalLixeira" tabindex="-1" role="dialog" aria-labelledby="JanelaProfissional" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><i class="bi bi-question-square"></i> Excluir TR?s</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <p><strong>Atenção!</strong> Confirma exclusão desse TR?</p>
          <h2>Confirma?</h2>
        </div>
        <form method="post" action="{{route('trs.destroy', $tr->id)}}">
          @csrf
          @method('DELETE')
          <div class="form-group">
            <label for="motivo">Motivo</label>
            <input type="text" class="form-control" name="motivo" id="motivo" value="">
          </div>
          <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Enviar para Lixeira</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection
