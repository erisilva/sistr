@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="{{ route('trs.index') }}">Lista de TRs</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('relatorio.index') }}">Mais relatórios</a></li>
    </ol>
  </nav>
</div>
<div class="container-fluid">
  <div class="table-responsive-md">
    <table class="table table-striped">
      <thead>
        <tr>
            <th scope="col"><strong>#</strong></th>
            <th scope="col">Nome do Relatório</th>
            <th scope="col">Descrição</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><a href="{{ route('relatorio.porsituacao') }}">TRs Cadastradas por Status e Período</a></td>
          <td>Este relatório apresenta a quantidade de TRs agrupadas por status. O período de análise se baseia na data de criação do relatório, exibindo, por padrão, os dados relativos ao último mês. O filtro é aplicado com base na data de cadastro dos registros. Os dados podem ser exportados em formatos de planilhas e arquivos PDF.</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td><a href="{{ route('relatorio.pormodalidade') }}">TRs Cadastradas por Modalidades e Período</a></td>
          <td>Este relatório apresenta a quantidade de TRs agrupadas pelas modalidades. O período de análise se baseia na data de criação do relatório, exibindo, por padrão, os dados relativos ao último mês. O filtro é aplicado com base na data de cadastro dos registros. Os dados podem ser exportados em formatos de planilhas e arquivos PDF</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td><a href="{{ route('relatorio.porusuario') }}">TRs Cadastradas/Alteradas por Usuários e Período</a></td>
          <td>Este relatório apresenta o quantitativo de alterações e cadastros de registros feitos pelos usuários do sistema. O período de análise utiliza os dados de Log das TRs, exibindo, por padrão, os dados relativos ao último mês.</td>
        </tr>          
      </tbody>
    </table>     
  </div>    
</div>

<div class="container py-2 text-right">
  <a href="{{ route('trs.index') }}" class="btn btn-primary" role="button"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

@endsection
