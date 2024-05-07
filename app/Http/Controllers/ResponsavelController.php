<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\ResponsavelExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class ResponsavelController extends Controller
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
        if (Gate::denies('responsavel-index')) {
            abort(403, 'Acesso negado.');
        }

        $responsavels = new Responsavel;

        // ordena
        $responsavels = $responsavels->orderBy('nome', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $responsavels = $responsavels->paginate(session('perPage', '5'))->withPath(env('APP_URL', null) .  '/responsavels');

        return view('responsavels.index', compact('responsavels', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('responsavel-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('responsavels.create');
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

        $responsavel = $request->all();

        Responsavel::create($responsavel); //salva

        Session::flash('create_responsavel', 'Responsável cadastrado com sucesso!');

        return redirect(route('responsavels.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('responsavel-show')) {
            abort(403, 'Acesso negado.');
        }

        $responsavel = Responsavel::findOrFail($id);

        return view('responsavels.show', compact('responsavel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('responsavel-edit')) {
            abort(403, 'Acesso negado.');
        }

        $responsavel = Responsavel::findOrFail($id);

        return view('responsavels.edit', compact('responsavel'));
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
        $this->validate($request, [
          'nome' => 'required',
        ]);

        $responsavel = Responsavel::findOrFail($id);
            
        $responsavel->update($request->all());
        
        Session::flash('edited_responsavel', 'Responsável do TR alterada com sucesso!');

        return redirect(route('responsavels.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('responsavel-delete')) {
            abort(403, 'Acesso negado.');
        }

        Responsavel::findOrFail($id)->delete();

        Session::flash('deleted_responsavel', 'Responsável do TR excluído com sucesso!');

        return redirect(route('responsavels.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('responsavel-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new ResponsavelExport(), 'Responsaveis_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('responsavel-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new ResponsavelExport(), 'Responsaveis_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('responsavel-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Responsavel;

        $dataset = $dataset->select('nome');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('responsavels.report', compact('dataset'));
        
        return $pdf->download('Responsaveis_' .  date("Y-m-d H:i:s") . '.pdf');

    }         
}
