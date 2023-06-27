@extends('layouts.clear')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="p-3 mb-2 text-center"><img src="{{ asset('img/logo_pmc.png') }}" class="img-thumbnail" alt="PMC-Logo"></div>  
            <div class="p-3 mb-2 bg-primary text-center"><h1 class="text-white">Total de TRs</h1></div>    
            <div class="p-3 mb-2 bg-primary text-center"><h1 class="text-white">{{ $counterTr }}</h1></div>
        </div>
        <div class="col-sm-6">
            <div class="chart-container" style="height:70vh; width:100%">
                <canvas id="porSituacaoChart"></canvas>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="chart-container" style="height:40vh; width:100%">
                <canvas id="porModalidadeChart"></canvas>
            </div>
        </div>
    </div>    
</div>

<div class="container">
    <div class="chart-container" style="height:40vh; width:100%">
        <canvas id="criadosEditadosPorDia"></canvas>
    </div>    
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

    var porModalidade = {{ Illuminate\Support\Js::from($porModalidade) }};
    var labels = porModalidade.map(function(e) {
        return e.descricao;
    });
    var data = porModalidade.map(function(e) {
        return e.total;
    });

    const ctxModalidade = document.getElementById('porModalidadeChart');

    new Chart(ctxModalidade, {
        type: 'pie',
        data: {
        labels: labels,
        datasets: [{
            data: data,
            borderWidth: 1
            }],
        options: {
            responsive: true,            
            scales: {
                x: {
                    grid: {
                        offset: true
                    }
                }
                },
            }    
        }
    });

    
        function refreshPage() {
        setTimeout(function() {
            window.location.reload(true);
        }, 30000);
        }

        refreshPage();
</script>
@endsection