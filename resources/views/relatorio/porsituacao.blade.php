@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
      <li class="breadcrumb-item"><a href="{{ route('relatorio.index') }}">Mais relatórios</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('relatorio.porsituacao') }}">TRs por Status</a></li>
    </ol>
  </nav>
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
        @foreach ($porSituacao as $situacao)
        <tr>
          <td>{{ $situacao->descricao }}</td>
          <td>{{ $situacao->total}}</td>
        </tr>
        @endforeach
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
    <a href="#" class="btn btn-secondary" role="button"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Planilha Excel</a>
    <a href="#" class="btn btn-secondary" role="button"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Planilha CSV</a>
    <a href="#" class="btn btn-secondary" role="button"><i class="bi bi-file-pdf-fill"></i> Arquivo PDF</a>
</div>

<div class="container py-2 text-right">
  <a href="{{ route('relatorio.index') }}" class="btn btn-primary" role="button"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

@endsection

@section('script-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var porSituacao = {{ Illuminate\Support\Js::from($porSituacao) }};
    var labels = porSituacao.map(function(e) {
        return e.descricao;
    });
    var data = porSituacao.map(function(e) {
        return e.total;
    });

    const ctxSituacao = document.getElementById('porSituacaoChart');

    new Chart(ctxSituacao, {
        type: 'bar',
        data: {
        labels: labels,
        datasets: [{
            label: 'Total de TRs/STATUS',
            data: data,
            borderWidth: 1,
            borderRadius: 10
        }]
        },
        options: {
            responsive: true,            
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    grid: {
                        offset: true
                    }
                }
            },
            indexAxis: 'y'
        }
    });
</script>
@endsection