<?php

namespace App\Http\Controllers;

use App\Models\Pregoeiro;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\PregoeiroExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class PregoeiroController extends Controller
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
        if (Gate::denies('pregoeiro-index')) {
            abort(403, 'Acesso negado.');
        }

        $pregoeiros = new Pregoeiro;

        // ordena
        $pregoeiros = $pregoeiros->orderBy('nome', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $pregoeiros = $pregoeiros->paginate(session('perPage', '5'));

        return view('pregoeiros.index', compact('pregoeiros', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('pregoeiro-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('pregoeiros.create');
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
          'nome' => 'required',
        ]);

        $pregoeiro = $request->all();

        Pregoeiro::create($pregoeiro); //salva

        Session::flash('create_pregoeiro', 'Pregoeiro cadastrado com sucesso!');

        return redirect(route('pregoeiros.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function show(Pregoeiro $pregoeiro)
    {
        if (Gate::denies('pregoeiro-show')) {
            abort(403, 'Acesso negado.');
        }

        return view('pregoeiros.show', [
            'pregoeiro' => $pregoeiro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregoeiro $pregoeiro)
    {
        if (Gate::denies('pregoeiro-edit')) {
            abort(403, 'Acesso negado.');
        }

        return view('pregoeiros.edit', [
            'pregoeiro' => $pregoeiro    
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pregoeiro $pregoeiro)
    {
        $this->validate($request, [
          'nome' => 'required',
        ]);
            
        $pregoeiro->update($request->all());
        
        Session::flash('edited_pregoeiro', 'Pregoeiro do TR alterado com sucesso!');

        return redirect(route('pregoeiros.edit', $pregoeiro));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pregoeiro $pregoeiro)
    {
        if (Gate::denies('pregoeiro-delete')) {
            abort(403, 'Acesso negado.');
        }

        $pregoeiro->delete();

        Session::flash('deleted_pregoeiro', 'Pregoeiro do TR excluído com sucesso!');

        return redirect(route('pregoeiros.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('pregoeiro-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new PregoeiroExport(), 'Pregoeiros_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('pregoeiro-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new PregoeiroExport(), 'Pregoeiros_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('pregoeiro-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Pregoeiro;

        $dataset = $dataset->select('nome');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('pregoeiros.report', compact('dataset'));
        
        return $pdf->download('Pregoeiros_' .  date("Y-m-d H:i:s") . '.pdf');

    }    
}
