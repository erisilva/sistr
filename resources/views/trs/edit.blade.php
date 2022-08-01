@extends('layouts.app')

@section('css-header')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
      <li class="breadcrumb-item active" aria-current="page">Alterar Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  @if(Session::has('edited_tr'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('edited_tr') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <form method="POST" action="{{ route('trs.update', $tr->id) }}">
    @csrf
    @method('PUT')





    <div class="form-row">
      <div class="form-group col-md-4">
          <div class="p-3 bg-primary text-white text-right h2">Nº {{ $tr->numero }}/{{ $tr->ano }}</div>    
      </div>
      <div class="form-group col-md-4">
        <label for="situacao_id">STATUS <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="situacao_id" name="situacao_id">
            <option value="{{$tr->situacao_id}}" selected="true">&rarr; {{ $tr->situacao->descricao }}</option> 
            @foreach($situacaos as $situacao)
            <option value="{{$situacao->id}}">{{$situacao->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('situacao_id'))
        <div class="text-danger">
        {{ $errors->first('situacao_id') }}
        </div>
        @endif 
      </div>
      <div class="form-group col-md-4">
        <label for="origem_id">Origem <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="origem_id" name="origem_id">
            <option value="" selected="true">Clique para escolher...</option>
            <option value="{{$tr->origem_id}}" selected="true">&rarr; {{ $tr->origem->descricao }}</option>  
            @foreach($origems as $origem)
            <option value="{{$origem->id}}">{{$origem->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('origem_id'))
        <div class="text-danger">
        {{ $errors->first('origem_id') }}
        </div>
        @endif 
      </div>
    </div>

    <div class="form-group">
      <label for="descricao">Descrição básica do Objeto <strong  class="text-danger">(*)</strong></label>
      <textarea class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" id="descricao" rows="2">{{ $tr->descricao }}</textarea>
        @if ($errors->has('descricao'))
        <div class="text-danger">
        {{ $errors->first('descricao') }}
        </div>
        @endif
    </div>


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="tipo_id">Tipo <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="tipo_id" name="tipo_id">
            <option value="{{$tr->tipo_id}}" selected="true">&rarr; {{ $tr->tipo->descricao }}</option>   
            @foreach($tipos as $tipo)
            <option value="{{$tipo->id}}">{{$tipo->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('tipo_id'))
        <div class="text-danger">
        {{ $errors->first('tipo_id') }}
        </div>
        @endif
      </div>
      <div class="form-group col-md-4">
        <label for="entregueSupAdm">Entregue SUP.ADM. <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="entregueSupAdm" id="entregueSupAdm" value="{{ isset($tr->entregueSupAdm) ?  $tr->entregueSupAdm->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="entregueComprasContrato">Entregue COMPRAS / CONTRATOS <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="entregueComprasContrato" id="entregueComprasContrato" value="{{ isset($tr->entregueComprasContrato) ?  $tr->entregueComprasContrato->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="responsavel_id">Responsável cotação <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="responsavel_id" name="responsavel_id">
            <option value="" selected="true">Clique para escolher...</option>
            <option value="{{$tr->responsavel_id}}" selected="true">&rarr; {{ $tr->responsavel->nome }}</option>  
            @foreach($responsavels as $responsavel)
            <option value="{{$responsavel->id}}">{{$responsavel->nome}}</option>
            @endforeach
        </select>
        @if ($errors->has('responsavel_id'))
        <div class="text-danger">
        {{ $errors->first('responsavel_id') }}
        </div>
        @endif       
      </div>
      <div class="form-group col-md-4">
        <label for="inicioCotacao">Início cotação <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="inicioCotacao" id="inicioCotacao" value="{{ isset($tr->inicioCotacao) ?  $tr->inicioCotacao->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="terminoCotacao">Término cotação <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="terminoCotacao" id="terminoCotacao" value="{{ isset($tr->terminoCotacao) ?  $tr->terminoCotacao->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="requisicaoCompras">Requisição Compras <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="requisicaoCompras" id="requisicaoCompras" value="{{ $tr->requisicaoCompras }}">
      </div>
      <div class="form-group col-md-3">
        <label for="valor">Valor R$ <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="valor" id="valor" value="{{ $tr->valor }}">
      </div>
      <div class="form-group col-md-3">
        <label for="envioSuplanPro">Envio SUPLAN_PRO <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="envioSuplanPro" id="envioSuplanPro" value="{{ isset($tr->envioSuplanPro) ?  $tr->envioSuplanPro->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-3">
        <label for="retornoSuplanPro">Retorno SUPLAN_PRO <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="retornoSuplanPro" id="retornoSuplanPro" value="{{ isset($tr->retornoSuplanPro) ?  $tr->retornoSuplanPro->format('d/m/Y') : ''}}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="assinaturasGabinete">Assinaturas GABINETE <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="assinaturasGabinete" id="assinaturasGabinete" value="{{ isset($tr->assinaturasGabinete) ?  $tr->assinaturasGabinete->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="protocoloSisprot">Protocolo SISPROT <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="protocoloSisprot" id="protocoloSisprot" value="{{ $tr->protocoloSisprot }}">
      </div>
    </div>  


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="envioCCOAF">Envio CCOAF <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="envioCCOAF" id="envioCCOAF" value="{{ isset($tr->envioCCOAF) ?  $tr->envioCCOAF->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="retornoCCOAF">Retorno CCOAF <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="retornoCCOAF" id="retornoCCOAF" value="{{ isset($tr->retornoCCOAF) ?  $tr->retornoCCOAF->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="deliberacao_id">Deliberação CCOAF <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="deliberacao_id" name="deliberacao_id">
            <option value="{{$tr->deliberacao_id}}" selected="true">&rarr; {{ $tr->deliberacao->descricao }}</option> 
            @foreach($deliberacaos as $deliberacao)
            <option value="{{$deliberacao->id}}">{{$deliberacao->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('deliberacao_id'))
        <div class="text-danger">
        {{ $errors->first('deliberacao_id') }}
        </div>
        @endif 
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="numeroPAC">PAC Nº <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="numeroPAC" id="numeroPAC" value="{{ $tr->numeroPAC  }}">
      </div>
      <div class="form-group col-md-3">
        <label for="modalidade_id">MODALIDADE <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="modalidade_id" name="modalidade_id">
            <option value="{{$tr->modalidade_id}}" selected="true">&rarr; {{ $tr->modalidade->descricao }}</option> 
            @foreach($modalidades as $modalidade)
            <option value="{{$modalidade->id}}">{{$modalidade->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('modalidade_id'))
        <div class="text-danger">
        {{ $errors->first('modalidade_id') }}
        </div>
        @endif
      </div>
      <div class="form-group col-md-3">
        <label for="numeroModalidade">Nº modalidade <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="numeroModalidade" id="numeroModalidade" value="{{ $tr->numeroModalidade }}">
      </div>
      <div class="form-group col-md-4">
        <label for="autuacao">Autuação / Ordenador Despesa <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="autuacao" id="autuacao" value="{{ isset($tr->autuacao) ?  $tr->autuacao->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutas">Início MINUTAS (contrato/ARP) <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="inicioMinutas" id="inicioMinutas" value="{{ isset($tr->autinicioMinutasuacao) ?  $tr->inicioMinutas->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="teminoMinutas">Término MINUTAS (contrato/ARP) <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="teminoMinutas" id="teminoMinutas" value="{{ isset($tr->teminoMinutas) ?  $tr->teminoMinutas->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div> 

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutasEdital">Início minuta EDITAL <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="inicioMinutasEdital" id="inicioMinutasEdital" value="{{ isset($tr->inicioMinutasEdital) ?  $tr->inicioMinutasEdital->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="terminoMinutasEdital">Término minuta EDITAL <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="terminoMinutasEdital" id="terminoMinutasEdital" value="{{ isset($tr->terminoMinutasEdital) ?  $tr->terminoMinutasEdital->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="envioPgm">Envio PGM <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="envioPgm" id="envioPgm" value="{{ isset($tr->envioPgm) ?  $tr->envioPgm->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="retornoPgm">Retorno PGM <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="retornoPgm" id="retornoPgm" value="{{ isset($tr->retornoPgm) ?  $tr->retornoPgm->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="pendenciasPgm">Pendências PGM <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="pendenciasPgm" id="pendenciasPgm" value="{{ isset($tr->pendenciasPgm) ?  $tr->pendenciasPgm->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="numeroEdital">Nº EDITAL <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="numeroEdital" id="numeroEdital" value="{{ $tr->numeroEdital }}">
      </div>
      <div class="form-group col-md-6">
        <label for="dataPregao">Data PREGÃO <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataPregao" id="dataPregao" value="{{ isset($tr->dataPregao) ?  $tr->dataPregao->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-group">
      <label for="observacaoLicitacao">Observação da Licitação <strong  class="text-warning">(opcional)</strong></label>
      <textarea class="form-control" name="observacaoLicitacao" id="observacaoLicitacao" rows="2">{{ $tr->observacaoLicitacao }}</textarea>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="dataHomologacao">Data Homologação <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataHomologacao" id="dataHomologacao" value="{{ isset($tr->dataHomologacao) ?  $tr->dataHomologacao->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="dataRatificacao">Data Ratificação <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataRatificacao" id="dataRatificacao" value="{{ isset($tr->dataRatificacao) ?  $tr->dataRatificacao->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="formalizacaoContratoArp">Formalização Contrato/ARP <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="formalizacaoContratoArp" id="formalizacaoContratoArp" value="{{ isset($tr->formalizacaoContratoArp) ?  $tr->formalizacaoContratoArp->format('d/m/Y') : ''  }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="dataContratoArp">Data Contrato/ARP <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataContratoArp" id="dataContratoArp" value="{{ isset($tr->dataContratoArp) ?  $tr->dataContratoArp->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="solicitacaoEmpenho">Solicitação Empenho <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="solicitacaoEmpenho" id="solicitacaoEmpenho" value="{{ isset($tr->solicitacaoEmpenho) ?  $tr->solicitacaoEmpenho->format('d/m/Y') : '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-group">
      <label for="observacao">Observações <strong  class="text-warning">(opcional)</strong></label>
      <textarea class="form-control" name="observacao" id="observacao" rows="3">{{ $tr->observacao }}</textarea>
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

    <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Alterar Dados do TR</button>
  </form>
</div>
<div class="container">
  <div class="float-right">
    <a href="{{ route('trs.index') }}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-arrow-left-square"></i> Voltar</i></a>
  </div>
</div>
@endsection

@section('script-footer')
<script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
<script>
  $(document).ready(function(){

      $('#entregueSupAdm, #entregueComprasContrato, #inicioCotacao, #terminoCotacao, #envioSuplanPro, #retornoSuplanPro, #assinaturasGabinete, #envioCCOAF, #retornoCCOAF, #autuacao, #inicioMinutas, #teminoMinutas, #inicioMinutasEdital, #terminoMinutasEdital, #envioPgm, #retornoPgm, #pendenciasPgm, #dataPregao, #dataHomologacao, #dataRatificacao, #formalizacaoContratoArp, #dataContratoArp, #solicitacaoEmpenho').datepicker({
          format: "dd/mm/yyyy",
          todayBtn: "linked",
          clearBtn: true,
          language: "pt-BR",
          autoclose: true,
          todayHighlight: true
      });

      $('#valor').inputmask('decimal', {
            radixPoint:",",
            groupSeparator: ".",
            autoGroup: true,
            digits: 2,
            digitsOptional: false,
            placeholder: '0',
            rightAlign: false,
            onBeforeMask: function (value, opts) {
              return value;
            }
      });

  });
</script>

@endsection
