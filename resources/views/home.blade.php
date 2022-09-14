@extends('layouts.app')

@section('content')
<div class="container-fluid p-3 mb-2 bg-secondary text-light text-center text-uppercase">
    <h4><i class="bi bi-plus-circle-dotted"></i> TRs mais recentes</h4>
</div>

<div class="container-fluid py-3">
  @if ( !$criadas->isEmpty() )
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Status</th>
                    <th scope="col">TR nº/Ano</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Descrição</th>               
                    <th scope="col">Tipo</th>
                    <th scope="col">Requisição</th>
                    <th scope="col">SISPROT</th>
                    <th scope="col">Modalidade</th>
                    <th scope="col">Nº Modalidade</th>
                    <th scope="col">Nº EDITAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($criadas as $tr)
                    <tr>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="{{route('trs.edit', $tr->id)}}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>
                            <a href="{{route('trs.show', $tr->id)}}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-eye"></i></a>
                          </div>
                        </td>
                        <td>{{$tr->situacao->descricao}}</td>
                        <td class="text-nowrap"><strong>TR nº{{$tr->numero}}/{{$tr->ano}}</strong></td>
                        <td>{{$tr->origem->descricao}}</td>
                        @if (strlen($tr->descricao) > 50 )
                          <td>{{substr($tr->descricao, 0, 47) . "..."}}</td>
                        @else
                          <td>{{$tr->descricao}}</td>
                        @endif          
                        <td>{{$tr->situacao->descricao}}</td>
                        <td>{{$tr->requisicaoCompras}}</td>
                        <td>{{$tr->protocoloSisprot}}</td>
                        <td>{{$tr->modalidade->descricao}}</td>
                        <td>{{$tr->numeroModalidade}}</td>
                        <td>{{$tr->numeroEdital}}</td>
                    </tr>    
                @endforeach 
            </tbody>
        </table>
    </div>
  @else
    <p class="p-3 text-center">Nenhum TR encontrado</p>
  @endif
</div>  

<div class="container py-2 text-center"> 
    <a href="{{ route('trs.index') }}" class="btn btn-primary btn-lg" role="button"><i class="bi bi-eye"></i> Ver mais Trs</a>
</div>

<div class="container-fluid p-3 mb-2 bg-secondary text-light text-center text-uppercase">
    <h4><i class="bi bi-plus-circle-dotted"></i> TRs modificadas</h4>
</div>

<div class="container-fluid py-3">
  @if ( !$criadas->isEmpty() )
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Status</th>
                    <th scope="col">TR nº/Ano</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Descrição</th>               
                    <th scope="col">Tipo</th>
                    <th scope="col">Requisição</th>
                    <th scope="col">SISPROT</th>
                    <th scope="col">Modalidade</th>
                    <th scope="col">Nº Modalidade</th>
                    <th scope="col">Nº EDITAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alteradas as $tr)
                    <tr>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="{{route('trs.edit', $tr->id)}}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>
                            <a href="{{route('trs.show', $tr->id)}}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-eye"></i></a>
                          </div>
                        </td>
                        <td>{{$tr->situacao->descricao}}</td>
                        <td class="text-nowrap"><strong>TR nº{{$tr->numero}}/{{$tr->ano}}</strong></td>
                        <td>{{$tr->origem->descricao}}</td>
                        @if (strlen($tr->descricao) > 50 )
                          <td>{{substr($tr->descricao, 0, 47) . "..."}}</td>
                        @else
                          <td>{{$tr->descricao}}</td>
                        @endif          
                        <td>{{$tr->situacao->descricao}}</td>
                        <td>{{$tr->requisicaoCompras}}</td>
                        <td>{{$tr->protocoloSisprot}}</td>
                        <td>{{$tr->modalidade->descricao}}</td>
                        <td>{{$tr->numeroModalidade}}</td>
                        <td>{{$tr->numeroEdital}}</td>
                    </tr>    
                @endforeach 
            </tbody>
        </table>
    </div>
  @else
    <p class="p-3 text-center">Nenhum TR encontrado</p>
  @endif
</div>  

<div class="container py-2 text-center"> 
    <a href="{{ route('trs.index') }}" class="btn btn-primary btn-lg" role="button"><i class="bi bi-eye"></i> Ver mais Trs</a>
</div>

@endsection
