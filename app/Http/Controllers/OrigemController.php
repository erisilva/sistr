<?php

namespace App\Http\Controllers;

use App\Models\Origem;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\OrigemsExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class OrigemController extends Controller
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
        if (Gate::denies('origem-index')) {
            abort(403, 'Acesso negado.');
        }

        $origems = new Origem;

        // ordena
        $origems = $origems->orderBy('descricao', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $origems = $origems->paginate(session('perPage', '5'));

        return view('origems.index', compact('origems', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('origem-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('origems.create');
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
          'descricao' => 'required',
        ]);

        $origem = $request->all();

        Origem::create($origem); //salva

        Session::flash('create_origem', 'Solicitante cadastrado com sucesso!');

        return redirect(route('origems.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('origem-show')) {
            abort(403, 'Acesso negado.');
        }

        $origem = Origem::findOrFail($id);

        return view('origems.show', compact('origem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('origem-edit')) {
            abort(403, 'Acesso negado.');
        }

        $origem = Origem::findOrFail($id);

        return view('origems.edit', compact('origem'));
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
          'descricao' => 'required',
        ]);

        $origem = Origem::findOrFail($id);
            
        $origem->update($request->all());
        
        Session::flash('edited_origem', 'Solicitante do TR alterado com sucesso!');

        return redirect(route('origems.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('origem-delete')) {
            abort(403, 'Acesso negado.');
        }

        Origem::findOrFail($id)->delete();

        Session::flash('deleted_origem', 'Solicitante do TR excluído com sucesso!');

        return redirect(route('origems.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('origem-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new OrigemsExport(), 'Solicitantes_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('origem-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new OrigemsExport(), 'Solicitantes_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('origem-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Origem;

        $dataset = $dataset->select('descricao');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('origems.report', compact('dataset'));
        
        return $pdf->download('Solicitantes_' .  date("Y-m-d H:i:s") . '.pdf');

    }         
}
