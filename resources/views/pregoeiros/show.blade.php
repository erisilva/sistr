@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('pregoeiros.index') }}">Lista de Pregoeiros do TR</a></li>
      <li class="breadcrumb-item active" aria-current="page">Exibir Registro</li>
    </ol>
  </nav>
</div>
<div class="container">

  <div class="card">
    <div class="card-header">
      Pregoeiro do TR
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Nome: {{$pregoeiro->nome}}</li>
      </ul>
    </div>
    @can('pregoeiro-delete', Auth::user())
    <div class="card-footer text-muted">
      <form method="post" action="{{route('pregoeiros.destroy', $pregoeiro->id)}}"  onsubmit="return confirm('Confirmar exclusão de registro?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Excluir</button>
      </form>
    </div>
    @endcan
  </div>  
</div>
<div class="container py-2 text-right">
  <a href="{{ route('pregoeiros.index') }}" class="btn btn-primary" role="button"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

@endsection
