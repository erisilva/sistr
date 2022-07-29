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
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Ano</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($trs as $tr)
            <tr>
                <td>{{$tr->numero}}</td>
                <td>{{$tr->ano}}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{route('trs.edit', $tr->id)}}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>
                    <a href="{{route('trs.show', $tr->id)}}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-trash"></i></a>
                  </div>
                </td>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
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
            <div class="form-group">
              <label for="numero">Número</label>
              <input type="text" class="form-control" id="numero" name="numero" value="{{request()->input('numero')}}">
            </div>
            <div class="form-group">
              <label for="ano">Ano</label>
              <input type="text" class="form-control" id="ano" name="ano" value="{{request()->input('ano')}}">
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
        window.open("{{ route('trs.export.csv') }}" + "?numero=" + filtro_numero + "&ano=" + filtro_ano,"_self");
    });

    $('#btnExportarXLS').on('click', function(){
        var filtro_numero = $('input[name="numero"]').val();
        var filtro_ano = $('input[name="ano"]').val();
        window.open("{{ route('trs.export.xls') }}" + "?numero=" + filtro_numero + "&ano=" + filtro_ano,"_self");
    });

    $('#btnExportarPDF').on('click', function(){
        var filtro_numero = $('input[name="numero"]').val();
        var filtro_ano = $('input[name="ano"]').val();
        window.open("{{ route('trs.export.pdf') }}" + "?numero=" + filtro_numero + "&ano=" + filtro_ano,"_self");
    });
}); 
</script>
@endsection