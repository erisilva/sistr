@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('responsavels.index') }}">Lista de Responsáveis do TR</a></li>
    </ol>
  </nav>
  @if(Session::has('deleted_responsavel'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('deleted_responsavel') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if(Session::has('create_responsavel'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('create_responsavel') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="btn-group py-1" role="group" aria-label="Opções">
    @can('situacao-create', Auth::user())
    <a href="{{ route('responsavels.create') }}" class="btn btn-secondary btn-sm" role="button"><i class="fas fa-plus-square"></i> Novo Registro</a>
    @endcan
    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalFilter"><i class="fas fa-filter"></i> Filtrar</button>
    @can('situacao-export', Auth::user())
    <div class="btn-group" role="group">
      <button id="btnGroupDropOptions" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Opções
      </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDropOptions">
        <a class="dropdown-item" href="#" id="btnExportarXLS"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Exportar Planilha Excel</a>
        <a class="dropdown-item" href="#" id="btnExportarCSV"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Exportar Planilha CSV</a>
        <a class="dropdown-item" href="#" id="btnExportarPDF"><i class="bi bi-file-pdf-fill"></i> Exportar PDF</a>
      </div>
    </div>
    @endcan
  </div>
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($responsavels as $responsavel)
            <tr>
                <td>{{$responsavel->nome}}</td>
                <td>
                  <div class="btn-group" role="group">
                    @can('responsavel-edit', Auth::user())
                    <a href="{{route('responsavels.edit', $responsavel->id)}}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>
                    @endcan
                    @can('responsavel-show', Auth::user())
                    <a href="{{route('responsavels.show', $responsavel->id)}}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-trash"></i></a>
                    @endcan
                  </div>
                </td>
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>
  <p class="text-center">Página {{ $responsavels->currentPage() }} de {{ $responsavels->lastPage() }}. Total de registros: {{ $responsavels->total() }}.</p>
  <div class="container-fluid">
      {{ $responsavels->links() }}
  </div>
  <!-- Janela de filtragem da consulta -->
  <div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="JanelaFiltro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-filter"></i> Filtro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Filtragem dos dados -->
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Fechar</button>
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
        
        window.open("{{ route('responsavels.index') }}" + "?perpage=" + perpage,"_self");
    });

    $('#btnExportarXLS').on('click', function(){
        window.open("{{ route('responsavels.export.xls') }}","_self");
    });

    $('#btnExportarCSV').on('click', function(){
        window.open("{{ route('responsavels.export.csv') }}","_self");
    });

    $('#btnExportarPDF').on('click', function(){
        window.open("{{ route('responsavels.export.pdf') }}","_self");
    });
}); 
</script>
@endsection