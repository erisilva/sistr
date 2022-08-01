@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('responsavels.index') }}">Lista de Responsáveis do TR</a></li>
      <li class="breadcrumb-item active" aria-current="page">Alterar Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  @if(Session::has('edited_responsavel'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('edited_responsavel') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <form method="POST" action="{{ route('responsavels.update', $responsavel->id) }}">
    @csrf
    @method('PUT')
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nome">Descrição</label>
        <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') ?? $responsavel->nome }}">
        @if ($errors->has('nome'))
        <div class="invalid-feedback">
        {{ $errors->first('nome') }}
        </div>
        @endif
      </div>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Alterar Dados do Responsável do TR</button>
  </form>
</div>
<div class="container">
  <div class="float-right">
    <a href="{{ route('responsavels.index') }}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-arrow-left"></i> Voltar</i></a>
  </div>
</div>
@endsection
