@extends('layouts.clear')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4 offset-md-4">
			<div class="card bg-warning text-white">
			  <div class="card-body">
			  	<h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Erro 401: Acesso não altenticado.</h5>
    			<p class="card-text">{{ $exception->getMessage() }}</p>
    			<a href="#" class="btn btn-primary" onclick="window.history.go(-1); return false;"><i class="bi bi-arrow-left"></i> Voltar</a>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection