<?php

namespace App\Http\Controllers;

use App\Models\Situacao;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\SituacaosExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class SituacaoController extends Controller
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
        if (Gate::denies('situacao-index')) {
            abort(403, 'Acesso negado.');
        }

        $situacaos = new Situacao;

        // ordena
        $situacaos = $situacaos->orderBy('descricao', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $situacaos = $situacaos->paginate(session('perPage', '5'))->withPath(env('APP_URL', null) .  '/situacaos');

        return view('situacaos.index', compact('situacaos', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('situacao-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('situacaos.create');
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

        $situacao = $request->all();

        Situacao::create($situacao); //salva

        Session::flash('create_situacao', 'Situação cadastrada com sucesso!');

        return redirect(route('situacaos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('situacao-show')) {
            abort(403, 'Acesso negado.');
        }

        $situacao = Situacao::findOrFail($id);

        return view('situacaos.show', compact('situacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('situacao-edit')) {
            abort(403, 'Acesso negado.');
        }

        $situacao = Situacao::findOrFail($id);

        return view('situacaos.edit', compact('situacao'));
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

        $situacao = Situacao::findOrFail($id);
            
        $situacao->update($request->all());
        
        Session::flash('edited_situacao', 'Situação do TR alterada com sucesso!');

        return redirect(route('situacaos.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('situacao-delete')) {
            abort(403, 'Acesso negado.');
        }

        Situacao::findOrFail($id)->delete();

        Session::flash('deleted_situacao', 'Situação do TR excluído com sucesso!');

        return redirect(route('situacaos.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('situacao-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new SituacaosExport(), 'Situações_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('situacao-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new SituacaosExport(), 'Situações_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('situacao-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Situacao;

        $dataset = $dataset->select('descricao');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('situacaos.report', compact('dataset'));
        
        return $pdf->download('Situações_' .  date("Y-m-d H:i:s") . '.pdf');

    }     
}
