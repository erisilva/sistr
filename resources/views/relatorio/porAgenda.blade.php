@extends('layouts.app')

@section('css-header')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
      <li class="breadcrumb-item"><a href="{{ route('relatorio.index') }}">Mais relatórios</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('relatorio.porModalidade') }}">TRs Cadastradas por Status e Período</a></li>
    </ol>
  </nav>
</div>
<div class="container py-2">
    <form method="GET" action="{{ route('relatorio.porsituacao') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="dataInicial">Data Inicial <strong  class="text-danger">(*)</strong></label>
                <input type="text" class="form-control" name="dataInicial" id="dataInicial" value="{{ request()->input('dataInicial') ? request()->input('dataInicial') : now()->subDay(30)->format('d/m/Y') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="dataFinal">Data Final <strong  class="text-danger">(*)</strong></label>
                <input type="text" class="form-control" name="dataFinal" id="dataFinal" value="{{ request()->input('dataFinal') ?  request()->input('dataFinal') : now()->format('d/m/Y') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Pesquisar</button>

    </form>    
</div>        
</div>
<div class="container">
   
    <table class="table table-striped">
      <thead>
        <tr>
            <th scope="col">Status</th>
            <th scope="col">Quantidade</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
    
    <p class="text-center py-2"> Total de TRs: {{ $counterTr }} </p> 
</div>

<div class="container bg-warning text-dark">
    <p class="text-center"><strong><i class="bi bi-bar-chart-line"></i> Gráfico</strong></p>
</div>

<div class="container">
    <div class="chart-container" style="height:70vh; width:100%">
        <canvas id="porSituacaoChart"></canvas>
    </div>
</div>

<div class="container bg-warning text-dark">
    <p class="text-center"><strong><i class="bi bi-file-arrow-down"></i> Exportar</strong></p>
</div>

<div class="container py-2 text-center">
    <a href="{{ route('relatorio.porsituacao.xls', ['dataInicial' => request()->input('dataInicial'), 'dataFinal' => request()->input('dataFinal')]) }}" class="btn btn-secondary" role="button"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Planilha Excel</a>
    <a href="{{ route('relatorio.porsituacao.csv', ['dataInicial' => request()->input('dataInicial'), 'dataFinal' => request()->input('dataFinal')]) }}" class="btn btn-secondary" role="button"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Planilha CSV</a>
    <a href="#" class="btn btn-secondary" role="button"><i class="bi bi-file-pdf-fill"></i> Arquivo PDF</a>
</div>

<div class="container py-2 text-right">
  <a href="{{ route('relatorio.index') }}" class="btn btn-primary" role="button"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

@endsection

@section('script-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
<script>

</script>
@endsection