<?php
namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\TiposExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class TipoController extends Controller
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
        if (Gate::denies('tipo-index')) {
            abort(403, 'Acesso negado.');
        }

        $tipos = new Tipo;

        // ordena
        $tipos = $tipos->orderBy('descricao', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $tipos = $tipos->paginate(session('perPage', '5'))->withPath(env('APP_URL', null) .  '/tipos');

        return view('tipos.index', compact('tipos', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('tipo-create')) {
            abort(403, 'Acesso negado.');
        } 

        return view('tipos.create');
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

        $tipo = $request->all();

        Tipo::create($tipo); //salva

        Session::flash('create_tipo', 'Tipo do TR cadastrado com sucesso!');

        return redirect(route('tipos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('tipo-show')) {
            abort(403, 'Acesso negado.');
        }

        $tipo = Tipo::findOrFail($id);

        return view('tipos.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('tipo-edit')) {
            abort(403, 'Acesso negado.');
        }

        $tipo = Tipo::findOrFail($id);

        return view('tipos.edit', compact('tipo'));
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

        $tipo = Tipo::findOrFail($id);
            
        $tipo->update($request->all());
        
        Session::flash('edited_tipo', 'Tipo do TR alterado com sucesso!');

        return redirect(route('tipos.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('tipo-delete')) {
            abort(403, 'Acesso negado.');
        }

        Tipo::findOrFail($id)->delete();

        Session::flash('deleted_tipo', 'Tipo do TR excluído com sucesso!');

        return redirect(route('tipos.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('tipo-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new TiposExport(), 'Tipos_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('tipo-export')) {
            abort(403, 'Acesso negado.');
        }

        return Excel::download(new TiposExport(), 'Tipos_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportpdf()
    {
        if (Gate::denies('tipo-export')) {
            abort(403, 'Acesso negado.');
        }

        # criação do dataset
        $dataset = new Tipo;

        $dataset = $dataset->select('descricao');

        $dataset = $dataset->get();

        $pdf = PDF::loadView('tipos.report', compact('dataset'));
        
        return $pdf->download('Tipos_' .  date("Y-m-d H:i:s") . '.pdf');

    }      
}
