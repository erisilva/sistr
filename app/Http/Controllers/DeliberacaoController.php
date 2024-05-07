<?php

namespace App\Http\Controllers;

use App\Models\Deliberacao;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\DeliberacaosExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class DeliberacaoController extends Controller
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
        if (Gate::denies('deliberacao-index')) {
            abort(403, 'Acesso negado.');
        }

        $deliberacaos = new Deliberacao;

        // ordena
        $deliberacaos = $deliberacaos->orderBy('descricao', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $deliberacaos = $deliberacaos->paginate(session('perPage', '5'))->withPath(env('APP_URL', null) .  '/deliberacaos');

        return view('deliberacaos.index', compact('deliberacaos', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('deliberacao-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('deliberacaos.create');
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

        $deliberacao = $request->all();

        Deliberacao::create($deliberacao); //salva

        Session::flash('create_deliberacao', 'Deliberação CCOAF cadastrada com sucesso!');

        return redirect(route('deliberacaos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('deliberacao-show')) {
            abort(403, 'Acesso negado.');
        }

        $deliberacao = Deliberacao::findOrFail($id);

        return view('deliberacaos.show', compact('deliberacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('deliberacao-edit')) {
            abort(403, 'Acesso negado.');
        }

        $deliberacao = Deliberacao::findOrFail($id);

        return view('deliberacaos.edit', compact('deliberacao'));
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

        $deliberacao = Deliberacao::findOrFail($id);
            
        $deliberacao->update($request->all());
        
        Session::flash('edited_deliberacao', 'Deliberação CCOAF do TR alterada com sucesso!');

        return redirect(route('deliberacaos.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('deliberacao-delete')) {
            abort(403, 'Acesso negado.');
        }

        Deliberacao::findOrFail($id)->delete();

        Session::flash('deleted_deliberacao', 'Deliberação CCOAF do TR excluído com sucesso!');

        return redirect(route('deliberacaos.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('deliberacao-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new DeliberacaosExport(), 'DeliberaçãoCCOAF_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('deliberacao-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new DeliberacaosExport(), 'DeliberaçãoCCOAF_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('deliberacao-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Deliberacao;

        $dataset = $dataset->select('descricao');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('deliberacaos.report', compact('dataset'));
        
        return $pdf->download('DeliberaçãoCCOAF_' .  date("Y-m-d H:i:s") . '.pdf');

    }         
}
