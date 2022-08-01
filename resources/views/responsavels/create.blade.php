@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('responsavels.index') }}">Lista de Responsáveis do TR</a></li>
      <li class="breadcrumb-item active" aria-current="page">Novo Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  <form method="POST" action="{{ route('responsavels.store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nome">Nome</label>
        <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') ?? '' }}">
        @if ($errors->has('nome'))
        <div class="invalid-feedback">
        {{ $errors->first('nome') }}
        </div>
        @endif
      </div>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-square"></i> Incluir Responsável do TR</button>
  </form>
  <div class="float-right">
    <a href="{{ route('responsavels.index') }}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-arrow-left"></i> Voltar</i></a>
  </div>
</div>
@endsection
