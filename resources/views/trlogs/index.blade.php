@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('trlogs.index') }}">Log das Trs</a></li>
    </ol>
  </nav>
  <div class="btn-group py-1" role="group" aria-label="Opções">
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
            @foreach($trlogs as $trlog)
            <tr>
                <td>{{$trlog->numero}}</td>
                <td>{{$trlog->ano}}</td>
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>
  <p class="text-center">Página {{ $trlogs->currentPage() }} de {{ $trlogs->lastPage() }}. Total de registros: {{ $trlogs->total() }}.</p>
  <div class="container-fluid">
      {{ $trlogs->links() }}
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
          <form method="GET" action="{{ route('trlogs.index') }}">
            <div class="form-group">
              <label for="numero">Número</label>
              <input type="text" class="form-control" id="numero" name="numero" value="{{request()->input('numero')}}">
            </div>
            <div class="form-group">
              <label for="ano">Ano</label>
              <input type="text" class="form-control" id="ano" name="ano" value="{{request()->input('ano')}}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
            <a href="{{ route('trlogs.index') }}" class="btn btn-primary btn-sm" role="button">Limpar</a>
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
        window.open("{{ route('trlogs.index') }}" + "?perpage=" + perpage,"_self");
    });
}); 
</script>
@endsection