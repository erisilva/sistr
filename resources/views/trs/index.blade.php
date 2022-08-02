@extends('layouts.app')


@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
    </ol>
  </nav>
  @if(Session::has('deleted_tr'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('deleted_tr') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(Session::has('create_tr'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('create_tr') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="btn-group py-1" role="group" aria-label="Opções">
    <a href="{{ route('trs.create') }}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-plus-circle"></i> Novo Registro</a>
    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalFilter"><i class="bi bi-funnel"></i> Filtrar</button>
    <div class="btn-group" role="group">
      <button id="btnGroupDropOptions" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="bi bi-gear"></i> Opções
      </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDropOptions">
        <a class="dropdown-item" href="#" id="btnExportarXLS"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Exportar Planilha Excel</a>
        <a class="dropdown-item" href="#" id="btnExportarCSV"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Exportar Planilha CSV</a>
        <a class="dropdown-item" href="#" id="btnExportarPDF"><i class="bi bi-file-pdf-fill"></i> Exportar PDF</a>
      </div>
    </div>
  </div>
  <div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">TR nº/Ano</th>
                <th scope="col">Descrição</th>
                <th scope="col">Status</th>
                <th scope="col">Origem</th>
                <th scope="col">Tipo</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($trs as $tr)
            <tr>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{route('trs.edit', $tr->id)}}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>
                    <a href="{{route('trs.show', $tr->id)}}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-eye"></i></a>
                  </div>
                </td>
                <td class="text-nowrap"><strong>TR nº{{$tr->numero}}/{{$tr->ano}}</strong></td>
                <td>{{$tr->descricao}}</td>
                <td>{{$tr->situacao->descricao}}</td>
                <td>{{$tr->origem->descricao}}</td>
                <td>{{$tr->tipo->descricao}}</td>
                
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>
  <p class="text-center">Página {{ $trs->currentPage() }} de {{ $trs->lastPage() }}. Total de registros: {{ $trs->total() }}.</p>
  <div class="container-fluid">
      {{ $trs->links() }}
  </div>
  <!-- Janela de filtragem da consulta -->
  <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="JanelaFiltro" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle"><i class="bi bi-funnel"></i> Filtro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Filtragem dos dados -->
          <form method="GET" action="{{ route('trs.index') }}">

            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="numero">TR nº</label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{request()->input('numero')}}">
              </div>
              <div class="form-group col-md-2">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" id="ano" name="ano" value="{{request()->input('ano')}}">
              </div>
              <div class="form-group col-md-4">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="{{request()->input('descricao')}}">
              </div>
              <div class="form-group col-md-4">
                <label for="situacao_id">STATUS</label>
                <select class="form-control" name="situacao_id" id="situacao_id">
                  <option value="">Mostrar todos</option>    
                  @foreach($situacaos as $situacao)
                  <option value="{{$situacao->id}}" {{ ($situacao->id == request()->input('situacao_id')) ? ' selected' : '' }} >{{ $situacao->descricao }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="origem_id">Origem</label>
                <select class="form-control" name="origem_id" id="origem_id">
                  <option value="">Mostrar todos</option>    
                  @foreach($origems as $origem)
                  <option value="{{$origem->id}}" {{ ($origem->id == request()->input('origem_id')) ? ' selected' : '' }} >{{ $origem->descricao }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="tipo_id">Tipo</label>
                <select class="form-control" name="tipo_id" id="tipo_id">
                  <option value="">Mostrar todos</option>    
                  @foreach($tipos as $tipo)
                  <option value="{{$tipo->id}}" {{ ($tipo->id == request()->input('tipo_id')) ? ' selected' : '' }} >{{ $tipo->descricao }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="requisicaoCompras">Requisição Compras</label>
                <input type="text" class="form-control" id="requisicaoCompras" name="requisicaoCompras" value="{{request()->input('requisicaoCompras')}}">
              </div>
              <div class="form-group col-md-3">
                <label for="protocoloSisprot">Protocolo SISPROT</label>
                <input type="text" class="form-control" id="protocoloSisprot" name="protocoloSisprot" value="{{request()->input('protocoloSisprot')}}">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="modalidade_id">Modalidade</label>
                <select class="form-control" name="modalidade_id" id="modalidade_id">
                  <option value="">Mostrar todos</option>    
                  @foreach($modalidades as $modalidade)
                  <option value="{{$modalidade->id}}" {{ ($modalidade->id == request()->input('modalidade_id')) ? ' selected' : '' }} >{{ $modalidade->descricao }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="numeroModalidade">Nº Modalidade</label>
                <input type="text" class="form-control" id="numeroModalidade" name="numeroModalidade" value="{{request()->input('numeroModalidade')}}">
              </div>
              <div class="form-group col-md-4">
                <label for="numeroEdital">Nº EDITAL</label>
                <input type="text" class="form-control" id="numeroEdital" name="numeroEdital" value="{{request()->input('numeroEdital')}}">
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
            <a href="{{ route('trs.index') }}" class="btn btn-primary btn-sm" role="button">Limpar</a>
          </form>
          <br>
          <!-- Seleção de número de resultados por página -->
          <div class="form-group">
            <select class="form-control" name="perpage" id="perpage">
              @foreach($perpages as $perpage)
              <option value="{{$perpage->valor}}"  {{($perpage->valor == session('perPage')) ? 'selected' : ''}}>{{$perpage->nome}}</option>
              @endforeach
            </select>
          </div>
        </div>     
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-square"></i> Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script-footer')
<script>
$(document).ready(function(){
    $('#perpage').on('change', function() {
        perpage = $(this).find(":selected").val(); 
        
        window.open("{{ route('trs.index') }}" + "?perpage=" + perpage,"_self");
    });

    $('#btnExportarCSV').on('click', function(){
        var filtro_numero = $('input[name="numero"]').val();
        var filtro_ano = $('input[name="ano"]').val();
        var filtro_descricao = $('input[name="descricao"]').val();      
        var filtro_situacao_id = $('select[name="situacao_id"]').val();
        if (typeof filtro_situacao_id === "undefined") {
            filtro_situacao_id = "";
        }
        var filtro_origem_id = $('select[name="origem_id"]').val();
        if (typeof filtro_origem_id === "undefined") {
            filtro_origem_id = "";
        }
        var filtro_tipo_id = $('select[name="tipo_id"]').val();
        if (typeof filtro_tipo_id === "undefined") {
            filtro_tipo_id = "";
        }
        var filtro_requisicaoCompras = $('input[name="requisicaoCompras"]').val();
        var filtro_protocoloSisprot = $('input[name="protocoloSisprot"]').val();
        var filtro_modalidade_id = $('select[name="modalidade_id"]').val();
        if (typeof filtro_modalidade_id === "undefined") {
            filtro_modalidade_id = "";
        }
        var filtro_numeroModalidade = $('input[name="numeroModalidade"]').val();
        var filtro_numeroEdital = $('input[name="numeroEdital"]').val();
        window.open("{{ route('trs.export.csv') }}" + "?numero=" + filtro_numero + "&ano=" + filtro_ano + "&descricao=" + filtro_descricao + "&situacao_id=" + filtro_situacao_id + "&origem_id=" + filtro_origem_id + "&tipo_id=" + filtro_tipo_id + "&requisicaoCompras=" + filtro_requisicaoCompras + "&protocoloSisprot=" + filtro_protocoloSisprot + "&modalidade_id=" + filtro_modalidade_id + "&numeroModalidade=" + filtro_numeroModalidade + "&numeroEdital=" + filtro_numeroEdital,"_self");
    });

    $('#btnExportarXLS').on('click', function(){
        var filtro_numero = $('input[name="numero"]').val();
        var filtro_ano = $('input[name="ano"]').val();
        var filtro_descricao = $('input[name="descricao"]').val();      
        var filtro_situacao_id = $('select[name="situacao_id"]').val();
        if (typeof filtro_situacao_id === "undefined") {
            filtro_situacao_id = "";
        }
        var filtro_origem_id = $('select[name="origem_id"]').val();
        if (typeof filtro_origem_id === "undefined") {
            filtro_origem_id = "";
        }
        var filtro_tipo_id = $('select[name="tipo_id"]').val();
        if (typeof filtro_tipo_id === "undefined") {
            filtro_tipo_id = "";
        }
        var filtro_requisicaoCompras = $('input[name="requisicaoCompras"]').val();
        var filtro_protocoloSisprot = $('input[name="protocoloSisprot"]').val();
        var filtro_modalidade_id = $('select[name="modalidade_id"]').val();
        if (typeof filtro_modalidade_id === "undefined") {
            filtro_modalidade_id = "";
        }
        var filtro_numeroModalidade = $('input[name="numeroModalidade"]').val();
        var filtro_numeroEdital = $('input[name="numeroEdital"]').val();
        window.open("{{ route('trs.export.xls') }}" + "?numero=" + "?numero=" + filtro_numero + "&ano=" + filtro_ano + "&descricao=" + filtro_descricao + "&situacao_id=" + filtro_situacao_id + "&origem_id=" + filtro_origem_id + "&tipo_id=" + filtro_tipo_id + "&requisicaoCompras=" + filtro_requisicaoCompras + "&protocoloSisprot=" + filtro_protocoloSisprot + "&modalidade_id=" + filtro_modalidade_id + "&numeroModalidade=" + filtro_numeroModalidade + "&numeroEdital=" + filtro_numeroEdital,"_self");
    });

    $('#btnExportarPDF').on('click', function(){
        var filtro_numero = $('input[name="numero"]').val();
        var filtro_ano = $('input[name="ano"]').val();
        var filtro_descricao = $('input[name="descricao"]').val();      
        var filtro_situacao_id = $('select[name="situacao_id"]').val();
        if (typeof filtro_situacao_id === "undefined") {
            filtro_situacao_id = "";
        }
        var filtro_origem_id = $('select[name="origem_id"]').val();
        if (typeof filtro_origem_id === "undefined") {
            filtro_origem_id = "";
        }
        var filtro_tipo_id = $('select[name="tipo_id"]').val();
        if (typeof filtro_tipo_id === "undefined") {
            filtro_tipo_id = "";
        }
        var filtro_requisicaoCompras = $('input[name="requisicaoCompras"]').val();
        var filtro_protocoloSisprot = $('input[name="protocoloSisprot"]').val();
        var filtro_modalidade_id = $('select[name="modalidade_id"]').val();
        if (typeof filtro_modalidade_id === "undefined") {
            filtro_modalidade_id = "";
        }
        var filtro_numeroModalidade = $('input[name="numeroModalidade"]').val();
        var filtro_numeroEdital = $('input[name="numeroEdital"]').val();
        window.open("{{ route('trs.export.pdf') }}" + "?numero=" + filtro_numero + "&ano=" + filtro_ano + "&descricao=" + filtro_descricao + "&situacao_id=" + filtro_situacao_id + "&origem_id=" + filtro_origem_id + "&tipo_id=" + filtro_tipo_id + "&requisicaoCompras=" + filtro_requisicaoCompras + "&protocoloSisprot=" + filtro_protocoloSisprot + "&modalidade_id=" + filtro_modalidade_id + "&numeroModalidade=" + filtro_numeroModalidade + "&numeroEdital=" + filtro_numeroEdital,"_self");
    });
}); 
</script>
@endsection