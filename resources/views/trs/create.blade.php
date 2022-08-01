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
      <div class="form-group col-md-6">
        <label for="situacao_id">STATUS <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="situacao_id" name="situacao_id">
            <option value="" selected="true">Clique para escolher...</option> 
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
      <div class="form-group col-md-6">
        <label for="origem_id">Origem <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="origem_id" name="origem_id">
            <option value="" selected="true">Clique para escolher...</option> 
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
      <textarea class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" id="descricao" rows="2">{{ old('descricao') ?? '' }}</textarea>
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
            <option value="" selected="true">Clique para escolher...</option> 
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
        <input type="text" class="form-control" name="entregueSupAdm" id="entregueSupAdm" value="{{ old('entregueSupAdm') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="entregueComprasContrato">Entregue COMPRAS / CONTRATOS <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="entregueComprasContrato" id="entregueComprasContrato" value="{{ old('entregueComprasContrato') ?? '' }}" autocomplete="off">
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="responsavel_id">Responsável cotação <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="responsavel_id" name="responsavel_id">
            <option value="" selected="true">Clique para escolher...</option> 
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
        <input type="text" class="form-control" name="inicioCotacao" id="inicioCotacao" value="{{ old('inicioCotacao') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="terminoCotacao">Término cotação <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="terminoCotacao" id="terminoCotacao" value="{{ old('terminoCotacao') ?? '' }}" autocomplete="off">
      </div>
    </div>


    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="requisicaoCompras">Requisição Compras <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="requisicaoCompras" id="requisicaoCompras" value="{{ old('requisicaoCompras') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="valor">Valor R$ <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="valor" id="valor" value="{{ old('valor') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="envioSuplanPro">Envio SUPLAN_PRO <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="envioSuplanPro" id="envioSuplanPro" value="{{ old('envioSuplanPro') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-3">
        <label for="retornoSuplanPro">Retorno SUPLAN_PRO <strong  class="text-warning">(opcional)</strong></label>
        <input type="text" class="form-control" name="retornoSuplanPro" id="retornoSuplanPro" value="{{ old('retornoSuplanPro') ?? '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="assinaturasGabinete">Assinaturas GABINETE <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="assinaturasGabinete" id="assinaturasGabinete" value="{{ old('assinaturasGabinete') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="protocoloSisprot">Protocolo SISPROT <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="protocoloSisprot" id="protocoloSisprot" value="{{ old('protocoloSisprot') ?? '' }}">
      </div>
    </div>  


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="envioCCOAF">Envio CCOAF <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="envioCCOAF" id="envioCCOAF" value="{{ old('envioCCOAF') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="retornoCCOAF">Retorno CCOAF <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="retornoCCOAF" id="retornoCCOAF" value="{{ old('retornoCCOAF') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="deliberacao_id">Deliberação CCOAF <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="deliberacao_id" name="deliberacao_id">
            <option value="1" selected="true">Não Definindo</option> 
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
        <input type="text" class="form-control" name="numeroPAC" id="numeroPAC" value="{{ old('numeroPAC') ?? '' }}">
      </div>
      <div class="form-group col-md-3">
        <label for="modalidade_id">MODALIDADE <strong  class="text-danger">(*)</strong></label>
        <select class="form-control" id="modalidade_id" name="modalidade_id">
            <option value="1" selected="true">Não Definindo</option> 
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
        <input type="text" class="form-control" name="numeroModalidade" id="numeroModalidade" value="{{ old('numeroModalidade') ?? '' }}">
      </div>
      <div class="form-group col-md-4">
        <label for="autuacao">Autuação / Ordenador Despesa <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="autuacao" id="autuacao" value="{{ old('autuacao') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutas">Início MINUTAS (contrato/ARP) <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="inicioMinutas" id="inicioMinutas" value="{{ old('inicioMinutas') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="teminoMinutas">Término MINUTAS (contrato/ARP) <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="teminoMinutas" id="teminoMinutas" value="{{ old('teminoMinutas') ?? '' }}" autocomplete="off">
      </div>
    </div> 

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inicioMinutasEdital">Início minuta EDITAL <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="inicioMinutasEdital" id="inicioMinutasEdital" value="{{ old('inicioMinutasEdital') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="terminoMinutasEdital">Término minuta EDITAL <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="terminoMinutasEdital" id="terminoMinutasEdital" value="{{ old('terminoMinutasEdital') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="envioPgm">Envio PGM <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="envioPgm" id="envioPgm" value="{{ old('envioPgm') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="retornoPgm">Retorno PGM <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="retornoPgm" id="retornoPgm" value="{{ old('retornoPgm') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="pendenciasPgm">Pendências PGM <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="pendenciasPgm" id="pendenciasPgm" value="{{ old('pendenciasPgm') ?? '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="numeroEdital">Nº EDITAL <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="numeroEdital" id="numeroEdital" value="{{ old('numeroEdital') ?? '' }}">
      </div>
      <div class="form-group col-md-6">
        <label for="dataPregao">Data PREGÃO <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataPregao" id="dataPregao" value="{{ old('dataPregao') ?? '' }}" autocomplete="off">
      </div>
    </div>

    <div class="form-group">
      <label for="observacaoLicitacao">Observação da Licitação <strong  class="text-warning">(opcional)</strong></label>
      <textarea class="form-control" name="observacaoLicitacao" id="observacaoLicitacao" rows="2">{{ old('observacaoLicitacao') ?? '' }}</textarea>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="dataHomologacao">Data Homologação <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataHomologacao" id="dataHomologacao" value="{{ old('dataHomologacao') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label for="dataRatificacao">Data Ratificação <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataRatificacao" id="dataRatificacao" value="{{ old('dataRatificacao') ?? '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="formalizacaoContratoArp">Formalização Contrato/ARP <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="formalizacaoContratoArp" id="formalizacaoContratoArp" value="{{ old('formalizacaoContratoArp') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="dataContratoArp">Data Contrato/ARP <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="dataContratoArp" id="dataContratoArp" value="{{ old('dataContratoArp') ?? '' }}" autocomplete="off">
      </div>
      <div class="form-group col-md-4">
        <label for="solicitacaoEmpenho">Solicitação Empenho <strong  class="text-warning">(opcional)</strong></label>  
        <input type="text" class="form-control" name="solicitacaoEmpenho" id="solicitacaoEmpenho" value="{{ old('solicitacaoEmpenho') ?? '' }}" autocomplete="off">
      </div>
    </div>  

    <div class="form-group">
      <label for="observacao">Observações <strong  class="text-warning">(opcional)</strong></label>
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
