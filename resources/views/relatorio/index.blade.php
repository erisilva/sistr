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
          <td><a href="{{ route('relatorio.porsituacao') }}">TRs por STATUS</a></td>
          <td>Relatório que quantifica todas TRs do sistema por cada STATUS</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td><a href="#">TRs por Modalidade</a></td>
          <td>Relatório de TRs por Modalidade</td>
        </tr>  
      </tbody>
    </table>     
  </div>    
</div>

<div class="container py-2 text-right">
  <a href="{{ route('trs.index') }}" class="btn btn-primary" role="button"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

@endsection
