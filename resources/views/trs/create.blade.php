@extends('layouts.app')

@section('css-header')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
      <li class="breadcrumb-item active" aria-current="page">Novo Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  <form method="POST" action="{{ route('trs.store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="situacao_id">STATUS <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="situacao_id" name="situacao_id">
            <option value="" selected="true">Clique para escolher...</option> 
            @foreach($situacaos as $situacao)
            <option value="{{$situacao->id}}" {{ old("situacao_id") == $situacao->id ? "selected":"" }}>{{$situacao->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('situacao_id'))
        <div class="text-danger">
        {{ $errors->first('situacao_id') }}
        </div>
        @endif 
      </div>
      <div class="form-group col-md-4">
        <label for="origem_id">Solicitante <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="origem_id" name="origem_id">
            <option value="" selected="true">Clique para escolher...</option> 
            @foreach($origems as $origem)
            <option value="{{$origem->id}}" {{ old("origem_id") == $origem->id ? "selected":"" }}>{{$origem->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('origem_id'))
        <div class="text-danger">
        {{ $errors->first('origem_id') }}
        </div>
        @endif 
      </div>
      <div class="form-group col-md-4">
        <label for="tipo_id">Tipo <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="tipo_id" name="tipo_id">
            <option value="" selected="true">Clique ...</option> 
            @foreach($tipos as $tipo)
            <option value="{{$tipo->id}}" {{ old("tipo_id") == $tipo->id ? "selected":"" }}>{{$tipo->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('tipo_id'))
        <div class="text-danger">
        {{ $errors->first('tipo_id') }}
        </div>
        @endif
      </div>
    </div>

    <div class="form-group">
      <label for="descricao">Objeto <strong  class="text-danger">(*)</strong></label>
      <textarea class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" id="descricao" rows="2">{{ old('descricao') ?? '' }}</textarea>
        @if ($errors->has('descricao'))
        <div class="text-danger">
        {{ $errors->first('descricao') }}
        </div>
        @endif
    </div>


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="quantidadeItens">Qtde. Itens </label>
        <input type="text" class="form-control" name="quantidadeItens" id="quantidadeItens" value="{{ old('quantidadeItens') ?? '' }}">
      </div>
      <div class="form-group col-md-4">
        <label for="entregueSupAdm">Entrada na S.A. </label>
        <input type="text" class="form-control" name="entregueSupAdm" id="entregueSupAdm" value="{{ old('entregueSupAdm') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="entregueComprasContrato">Entrada DCC </label>
        <input type="text" class="form-control" name="entregueComprasContrato" id="entregueComprasContrato" value="{{ old('entregueComprasContrato') ?? '' }}" autocomplete="off">
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="responsavel_id">Responsável cotação <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="responsavel_id" name="responsavel_id">
            <option value="" selected="true">Clique para escolher...</option> 
            @foreach($responsavels as $responsavel)
            <option value="{{$responsavel->id}}" {{ old("responsavel_id") == $responsavel->id ? "selected":"" }}>{{$responsavel->nome}}</option>
            @endforeach
        </select>
        @if ($errors->has('responsavel_id'))
        <div class="text-danger">
        {{ $errors->first('responsavel_id') }}
        </div>
        @endif       
      </div>
      <div class="form-group col-md-4">
        <label for="inicioCotacao">Início cotação </label>
        <input type="text" class="form-control" name="inicioCotacao" id="inicioCotacao" value="{{ old('inicioCotacao') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="terminoCotacao">Término cotação </label>
        <input type="text" class="form-control" name="terminoCotacao" id="terminoCotacao" value="{{ old('terminoCotacao') ?? '' }}" autocomplete="off">
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="requisicaoCompras">Requisição Compras Nº </label>  
        <input type="text" class="form-control" name="requisicaoCompras" id="requisicaoCompras" value="{{ old('requisicaoCompras') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="valor">Valor R$ </label>  
        <input type="text" class="form-control" name="valor" id="valor" value="{{ old('valor') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="envioSuplanPro">Envio SUPLAN </label>
        <input type="text" class="form-control" name="envioSuplanPro" id="envioSuplanPro" value="{{ old('envioSuplanPro') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-3">
        <label for="retornoSuplanPro">Retorno SUPLAN </label>
        <input type="text" class="form-control" name="retornoSuplanPro" id="retornoSuplanPro" value="{{ old('retornoSuplanPro') ?? '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="protocoloSisprot">SISPROT Nº </label>
        <input type="text" class="form-control" name="protocoloSisprot" id="protocoloSisprot" value="{{ old('protocoloSisprot') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="envioCCOAF">Envio CCOAF </label>  
        <input type="text" class="form-control" name="envioCCOAF" id="envioCCOAF" value="{{ old('envioCCOAF') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-3">
        <label for="retornoCCOAF">Retorno CCOAF </label>  
        <input type="text" class="form-control" name="retornoCCOAF" id="retornoCCOAF" value="{{ old('retornoCCOAF') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-3">
        <label for="deliberacao_id">Deliberação CCOAF <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="deliberacao_id" name="deliberacao_id">
            <option value="" selected="true">Clique para escolher...</option>
            @foreach($deliberacaos as $deliberacao)
            <option value="{{$deliberacao->id}}" {{ old("deliberacao_id") == $deliberacao->id ? "selected":"" }}>{{$deliberacao->descricao}}</option>
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
        <label for="numeroPAC">PAC Nº </label>  
        <input type="text" class="form-control" name="numeroPAC" id="numeroPAC" value="{{ old('numeroPAC') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="modalidade_id">Modalidade <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="modalidade_id" name="modalidade_id">
            <option value="" selected="true">Clique para escolher...</option>
            @foreach($modalidades as $modalidade)
            <option value="{{$modalidade->id}}" {{ old("modalidade_id") == $modalidade->id ? "selected":"" }}>{{$modalidade->descricao}}</option>
            @endforeach
        </select>
        @if ($errors->has('modalidade_id'))
        <div class="text-danger">
        {{ $errors->first('modalidade_id') }}
        </div>
        @endif
      </div>
      <div class="form-group col-md-3">
        <label for="numeroModalidade">Nº Modalidade </label>  
        <input type="text" class="form-control" name="numeroModalidade" id="numeroModalidade" value="{{ old('numeroModalidade') ?? '' }}">
      </div>
      <div class="form-group col-md-4">
        <label for="autuacao">Autuação PAC </label>  
        <input type="text" class="form-control" name="autuacao" id="autuacao" value="{{ old('autuacao') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutas">Início minuta (contrato/aditivo) </label>  
        <input type="text" class="form-control" name="inicioMinutas" id="inicioMinutas" value="{{ old('inicioMinutas') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="terminoMinutas">Término minuta (contrato/aditivo) </label>  
        <input type="text" class="form-control" name="terminoMinutas" id="terminoMinutas" value="{{ old('terminoMinutas') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="inicioMinutasARP">Início minuta ARP </label>  
        <input type="text" class="form-control" name="inicioMinutasARP" id="inicioMinutasARP" value="{{ old('inicioMinutasARP') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="terminoMinutasARP">Término minuta ARP </label>  
        <input type="text" class="form-control" name="terminoMinutasARP" id="terminoMinutasARP" value="{{ old('terminoMinutasARP') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="pregoeiro_id">Pregoeiro (a) <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="pregoeiro_id" name="pregoeiro_id">
            <option value="" selected="true">Clique para escolher...</option> 
            @foreach($pregoeiros as $pregoeiro)
            <option value="{{$pregoeiro->id}}" {{ old("pregoeiro_id") == $pregoeiro->id ? "selected":"" }}>{{$pregoeiro->nome}}</option>
            @endforeach
        </select>
        @if ($errors->has('pregoeiro_id'))
        <div class="text-danger">
        {{ $errors->first('pregoeiro_id') }}
        </div>
        @endif
      </div>  
    </div>      

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutasEdital">Início minuta Edital </label>  
        <input type="text" class="form-control" name="inicioMinutasEdital" id="inicioMinutasEdital" value="{{ old('inicioMinutasEdital') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="terminoMinutasEdital">Término minuta Edital </label>  
        <input type="text" class="form-control" name="terminoMinutasEdital" id="terminoMinutasEdital" value="{{ old('terminoMinutasEdital') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="envioPgm">Envio PGM </label>  
        <input type="text" class="form-control" name="envioPgm" id="envioPgm" value="{{ old('envioPgm') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="retornoPgm">Retorno PGM </label>  
        <input type="text" class="form-control" name="retornoPgm" id="retornoPgm" value="{{ old('retornoPgm') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioSaneamentoPendencias">Início Saneamento Pendênias </label>  
        <input type="text" class="form-control" name="inicioSaneamentoPendencias" id="inicioSaneamentoPendencias" value="{{ old('inicioSaneamentoPendencias') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="terminoSaneamentoPendencias">Término Saneamento Pendências </label>  
        <input type="text" class="form-control" name="terminoSaneamentoPendencias" id="terminoSaneamentoPendencias" value="{{ old('terminoSaneamentoPendencias') ?? '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="numeroEdital">Nº EDITAL </label>  
        <input type="text" class="form-control" name="numeroEdital" id="numeroEdital" value="{{ old('numeroEdital') ?? '' }}">
      </div>
      <div class="form-group col-md-4">
        <label for="dataPregao">Data PREGÃO </label>  
        <input type="text" class="form-control" name="dataPregao" id="dataPregao" value="{{ old('dataPregao') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="impugnacao">Impugnação / Suspensão </label>  
        <input type="text" class="form-control" name="impugnacao" id="impugnacao" value="{{ old('impugnacao') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioAnaliseTecnica">Início Análise Técnica </label>  
        <input type="text" class="form-control" name="inicioAnaliseTecnica" id="inicioAnaliseTecnica" value="{{ old('inicioAnaliseTecnica') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="terminoAnaliseTecnica">Término Análise Técnica </label>  
        <input type="text" class="form-control" name="terminoAnaliseTecnica" id="terminoAnaliseTecnica" value="{{ old('terminoAnaliseTecnica') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="dataHomologacao">Homologação </label>  
        <input type="text" class="form-control" name="dataHomologacao" id="dataHomologacao" value="{{ old('dataHomologacao') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="dataRatificacao">Ratificação </label>  
        <input type="text" class="form-control" name="dataRatificacao" id="dataRatificacao" value="{{ old('dataRatificacao') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="dataReratificacao">Reratificação </label>  
        <input type="text" class="form-control" name="dataReratificacao" id="dataReratificacao" value="{{ old('dataReratificacao') ?? '' }}" autocomplete="off">
      </div>      
    </div>  

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="formalizacaoContratoArp">Formalização (contrato/aditivo/ARP) </label>  
        <input type="text" class="form-control" name="formalizacaoContratoArp" id="formalizacaoContratoArp" value="{{ old('formalizacaoContratoArp') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="dataContratoArp">Data (contrato/aditivo/ARP) </label>  
        <input type="text" class="form-control" name="dataContratoArp" id="dataContratoArp" value="{{ old('dataContratoArp') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-group">
      <label for="publicacao">PUBLICAÇÃO DOC </label>
      <textarea class="form-control" name="publicacao" id="publicacao" rows="3">{{ old('publicacao') ?? '' }}</textarea>
    </div>

    <div class="form-group">
      <label for="observacao">Observações </label>
      <textarea class="form-control" name="observacao" id="observacao" rows="3">{{ old('observacao') ?? '' }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Incluir TR</button>
  </form>
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

      $('#entregueSupAdm, #entregueComprasContrato, #inicioCotacao, #terminoCotacao, #envioSuplanPro, #retornoSuplanPro, #assinaturasGabinete, #envioCCOAF, #retornoCCOAF, #autuacao, #inicioMinutas, #teminoMinutas, #inicioMinutasEdital, #terminoMinutasEdital, #envioPgm, #retornoPgm, #inicioSaneamentoPendencias, #terminoSaneamentoPendencias, #dataPregao, #impugnacao, #inicioAnaliseTecnica, #terminoAnaliseTecnica, #dataHomologacao, #dataRatificacao, #formalizacaoContratoArp, #dataContratoArp, #solicitacaoEmpenho, #dataReratificacao, #inicioMinutasARP, #terminoMinutasARP').datepicker({
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
