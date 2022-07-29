<?php

namespace App\Http\Controllers;

use App\Models\Tr;

use App\Models\Situacao;
use App\Models\Origem;
use App\Models\Tipo;
use App\Models\Responsavel;
use App\Models\Deliberacao;

use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\TrsExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class TrController extends Controller
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
        if (Gate::denies('tr-index')) {
            abort(403, 'Acesso negado.');
        }

        $trs = new Tr;

        // filtros
        if (request()->has('numero')){
            $trs = $trs->where('numero', '=', request('numero'));
        }

        if (request()->has('ano')){
            $trs = $trs->where('ano', '=', request('ano'));
        }

        // ordena
        $trs = $trs->orderBy('numero', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $trs = $trs->paginate(session('perPage', '5'))->appends([          
            'numero' => request('numero'),
            'ano' => request('ano'),           
            ]);

        return view('trs.index', compact('trs', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('tr-create')) {
            abort(403, 'Acesso negado.');
        }

        $situacaos = Situacao::orderBy('descricao', 'asc')->get();
        $origems = Origem::orderBy('descricao', 'asc')->get();
        $tipos = Tipo::orderBy('descricao', 'asc')->get();
        $responsavels = Responsavel::orderBy('nome', 'asc')->get();
        $deliberacaos = Deliberacao::orderBy('descricao', 'asc')->get();

        return view('trs.create', compact('situacaos', 'origems', 'tipos', 'responsavels','deliberacaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'description' => 'required',
        ]);

        $tr = $request->all();

        Tr::create($tr); //salva

        Session::flash('create_tr', 'TR cadastrada com sucesso!');

        return redirect(route('trs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
