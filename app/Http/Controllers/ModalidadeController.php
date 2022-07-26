<?php

namespace App\Http\Controllers;

use App\Models\Modalidade;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\ModalidadeExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class ModalidadeController extends Controller
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
        if (Gate::denies('modalidade-index')) {
            abort(403, 'Acesso negado.');
        }

        $modalidades = new Modalidade;

        // ordena
        $modalidades = $modalidades->orderBy('descricao', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $modalidades = $modalidades->paginate(session('perPage', '5'));

        return view('modalidades.index', compact('modalidades', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('modalidade-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('modalidades.create');
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

        $modalidade = $request->all();

        Modalidade::create($modalidade); //salva

        Session::flash('create_modalidade', 'Modalidade cadastrada com sucesso!');

        return redirect(route('modalidades.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('modalidade-show')) {
            abort(403, 'Acesso negado.');
        }

        $modalidade = Modalidade::findOrFail($id);

        return view('modalidades.show', compact('modalidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('modalidade-edit')) {
            abort(403, 'Acesso negado.');
        }

        $modalidade = Modalidade::findOrFail($id);

        return view('modalidades.edit', compact('modalidade'));
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

        $modalidade = Modalidade::findOrFail($id);
            
        $modalidade->update($request->all());
        
        Session::flash('edited_modalidade', 'Modalidade do TR alterada com sucesso!');

        return redirect(route('modalidades.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('modalidade-delete')) {
            abort(403, 'Acesso negado.');
        }

        Modalidade::findOrFail($id)->delete();

        Session::flash('deleted_modalidade', 'Modalidade do TR excluído com sucesso!');

        return redirect(route('modalidades.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('modalidade-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new ModalidadeExport(), 'Modalidades_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('modalidade-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new ModalidadeExport(), 'Modalidades_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('modalidade-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Modalidade;

        $dataset = $dataset->select('descricao');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('modalidades.report', compact('dataset'));
        
        return $pdf->download('Modalidades_' .  date("Y-m-d H:i:s") . '.pdf');

    }     
}
