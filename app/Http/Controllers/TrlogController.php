<?php

namespace App\Http\Controllers;

use App\Models\Trlog;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

class TrlogController extends Controller
{

    public function __construct() 
    {
        $this->middleware(['middleware' => 'auth']);
        $this->middleware(['middleware' => 'hasaccess']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('trlog-index')) {
            abort(403, 'Acesso negado.');
        }

        $trlogs = new Trlog;

        // filtros
        if (request()->has('numero')){
            $trlogs = $trlogs->where('numero', 'like', '%' . request('numero') . '%');
        }

        if (request()->has('ano')){
            $trlogs = $trlogs->where('ano', 'like', '%' . request('ano') . '%');
        }

        // ordena
        $trlogs = $trlogs->orderBy('numero', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $trlogs = $trlogs->paginate(session('perPage', '5'))->appends([          
            'numero' => request('numero'),
            'ano' => request('ano'),           
            ]);

        return view('trlogs.index', compact('trlogs', 'perpages'));
    }
}
