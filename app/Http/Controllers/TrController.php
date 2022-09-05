<?php

namespace App\Http\Controllers;

use App\Models\Tr;

use App\Models\Situacao;
use App\Models\Origem;
use App\Models\Tipo;
use App\Models\Responsavel;
use App\Models\Deliberacao;
use App\Models\Modalidade;
use App\Models\Pregoeiro;

use App\Models\Perpage;

use Response;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\TrsExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;

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

        // fitros
        $lista_de_filtros = ['numero', 'ano', 'descricao', 'situacao_id', 'origem_id', 'tipo_id', 'requisicaoCompras', 'protocoloSisprot', 'modalidade_id', 'numeroModalidade', 'numeroEdital'];

        foreach ($lista_de_filtros as $filtro) {
            if (request()->has($filtro) && !empty(request($filtro))){
                if (is_int(request($filtro))) {
                    $trs = $trs->where($filtro, '=', request($filtro));
                } else {
                    $trs = $trs->where($filtro, 'like', '%' . request($filtro) . '%');
                }
            }   
        }

        // ordena
        $trs = $trs->orderBy('ano', 'desc')->orderBy('numero', 'asc');

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
            'descricao' => request('descricao'),           
            'situacao_id' => request('situacao_id'),           
            'origem_id' => request('origem_id'),           
            'tipo_id' => request('tipo_id'),           
            'requisicaoCompras' => request('requisicaoCompras'),           
            'protocoloSisprot' => request('protocoloSisprot'),           
            'modalidade_id' => request('modalidade_id'),           
            'numeroModalidade' => request('numeroModalidade'),           
            'numeroEdital' => request('numeroEdital'),                   
            ]);


        $situacaos = Situacao::orderBy('descricao', 'asc')->get();
        $origems = Origem::orderBy('descricao', 'asc')->get();
        $tipos = Tipo::orderBy('descricao', 'asc')->get();
        $modalidades = Modalidade::orderBy('descricao', 'asc')->get();

        return view('trs.index', compact('trs', 'perpages', 'situacaos', 'origems', 'tipos', 'modalidades'));
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
        $modalidades = Modalidade::orderBy('descricao', 'asc')->get();
        $pregoeiros = Pregoeiro::orderBy('nome', 'asc')->get();

        return view('trs.create', compact('situacaos', 'origems', 'tipos', 'responsavels','deliberacaos', 'modalidades', 'pregoeiros'));
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
          'situacao_id' => 'required',
          'origem_id' => 'required',
          'descricao' => 'required',
          'tipo_id' => 'required',
          'responsavel_id' => 'required',
          'deliberacao_id' => 'required',
          'modalidade_id' => 'required',
          'pregoeiro_id' => 'required',
        ],
        [
            'situacao_id.required' => 'Selecione o status do TR na lista',
            'origem_id.required' => 'Selecione a origem do TR na lista',
            'descricao.required' => 'É obrigatório preencher a descrição do TR',
            'tipo_id.required' => 'Selecione o tipo do TR na lista',
            'responsavel_id.required' => 'Selecione o responsável do TR na lista',
            'deliberacao_id.required' => 'Selecione a deliberação do TR na lista',
            'modalidade_id.required' => 'Selecione a modalidade do TR na lista',
            'pregoeiro_id.required' => 'Selecione o pregoeiro do TR na lista',
        ]);

        $tr = $request->all();

        $user = Auth::user(); // usuário logado no sistema

        $tr['user_id'] = $user->id; // sava o id d user logado no sistema

        // conversão dos formatos dos campos de data em formato do banco
        $datas_a_ajustar = ['entregueSupAdm', 'entregueComprasContrato', 'inicioCotacao', 'terminoCotacao', 'envioSuplanPro', 'retornoSuplanPro', 'assinaturasGabinete', 'envioCCOAF', 'retornoCCOAF', 'autuacao', 'inicioMinutas', 'teminoMinutas', 'inicioMinutasEdital', 'terminoMinutasEdital', 'envioPgm', 'retornoPgm', 'inicioSaneamentoPendencias', 'terminoSaneamentoPendencias', 'dataPregao', 'dataHomologacao', 'dataRatificacao', 'formalizacaoContratoArp', 'dataContratoArp', 'solicitacaoEmpenho', 'inicioAnaliseTecnica', 'terminoAnaliseTecnica', 'impugnacao'];

        foreach ($datas_a_ajustar as $formatacao_de_data) {
            if(isset($tr[$formatacao_de_data]) && !empty($tr[$formatacao_de_data])) {
                $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', $tr[$formatacao_de_data])->format('Y-m-d');
                $tr[$formatacao_de_data] =  $dataFormatadaMysql;
            }
        }

        $new_tr = Tr::create($tr); //salva

        Session::flash('create_tr', 'TR cadastrada com sucesso!');

        return redirect(route('trs.edit', $new_tr->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('tr-show')) {
            abort(403, 'Acesso negado.');
        }

        $tr = Tr::findOrFail($id);

        return view('trs.show', compact('tr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('tr-edit')) {
            abort(403, 'Acesso negado.');
        }

        // usuário que será alterado
        $tr = Tr::findOrFail($id);

        $situacaos = Situacao::orderBy('descricao', 'asc')->get();
        $origems = Origem::orderBy('descricao', 'asc')->get();
        $tipos = Tipo::orderBy('descricao', 'asc')->get();
        $responsavels = Responsavel::orderBy('nome', 'asc')->get();
        $deliberacaos = Deliberacao::orderBy('descricao', 'asc')->get();
        $modalidades = Modalidade::orderBy('descricao', 'asc')->get();
        $pregoeiros = Pregoeiro::orderBy('nome', 'asc')->get();

        return view('trs.edit', compact('tr','situacaos', 'origems', 'tipos', 'responsavels','deliberacaos', 'modalidades', 'pregoeiros'));
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
          'situacao_id' => 'required',
          'origem_id' => 'required',
          'descricao' => 'required',
          'tipo_id' => 'required',
          'responsavel_id' => 'required',
          'deliberacao_id' => 'required',
          'modalidade_id' => 'required',
          'pregoeiro_id' => 'required',
        ],
        [
            'situacao_id.required' => 'Selecione o status do TR na lista',
            'origem_id.required' => 'Selecione a origem do TR na lista',
            'descricao.required' => 'É obrigatório preencher a descrição do TR',
            'tipo_id.required' => 'Selecione o tipo do TR na lista',
            'responsavel_id.required' => 'Selecione o responsável do TR na lista',
            'deliberacao_id.required' => 'Selecione a deliberação do TR na lista',
            'modalidade_id.required' => 'Selecione a modalidade do TR na lista',
            'pregoeiro_id.required' => 'Selecione o pregoeiro do TR na lista',
        ]);

        $tr = $request->all();

        // conversão dos formatos dos campos de data em formato do banco
        $datas_a_ajustar = ['entregueSupAdm', 'entregueComprasContrato', 'inicioCotacao', 'terminoCotacao', 'envioSuplanPro', 'retornoSuplanPro', 'assinaturasGabinete', 'envioCCOAF', 'retornoCCOAF', 'autuacao', 'inicioMinutas', 'teminoMinutas', 'inicioMinutasEdital', 'terminoMinutasEdital', 'envioPgm', 'retornoPgm', 'inicioSaneamentoPendencias', 'terminoSaneamentoPendencias', 'dataPregao', 'dataHomologacao', 'dataRatificacao', 'formalizacaoContratoArp', 'dataContratoArp', 'solicitacaoEmpenho', 'inicioAnaliseTecnica', 'terminoAnaliseTecnica', 'impugnacao'];

        foreach ($datas_a_ajustar as $formatacao_de_data) {
            if(isset($tr[$formatacao_de_data]) && !empty($tr[$formatacao_de_data])) {
                $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', $tr[$formatacao_de_data])->format('Y-m-d');
                $tr[$formatacao_de_data] =  $dataFormatadaMysql;
            }
        }

        $new_tr = Tr::findOrFail($id);
            
        $new_tr->update($tr);
        
        Session::flash('edited_tr', 'TR alterado com sucesso!');

        return redirect(route('trs.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('tr-delete')) {
            abort(403, 'Acesso negado.');
        }

        Tr::findOrFail($id)->delete();

        Session::flash('deleted_tr', 'TR excluído com sucesso!');

        return redirect(route('trs.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('tr-export')) {
            abort(403, 'Acesso negado.');
        }

        # filtragem
        $lista_de_campos_de_filtros = ['numero', 'ano', 'descricao', 'situacao_id', 'origem_id', 'tipo_id', 'requisicaoCompras', 'protocoloSisprot', 'modalidade_id', 'numeroModalidade', 'numeroEdital'];

        $lista_de_filtros_ajustada = [];

        foreach ($lista_de_campos_de_filtros as $filtro) {
            $lista_de_filtros_ajustada[$filtro] =(request()->has($filtro) ? request($filtro) : '');
        }

        return Excel::download(new TrsExport($lista_de_filtros_ajustada), 'Trs_' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportxls()
    {
        if (Gate::denies('tr-export')) {
            abort(403, 'Acesso negado.');
        }

        # filtragem
        $lista_de_campos_de_filtros = ['numero', 'ano', 'descricao', 'situacao_id', 'origem_id', 'tipo_id', 'requisicaoCompras', 'protocoloSisprot', 'modalidade_id', 'numeroModalidade', 'numeroEdital'];

        $lista_de_filtros_ajustada = [];

        foreach ($lista_de_campos_de_filtros as $filtro) {
            $lista_de_filtros_ajustada[$filtro] = (request()->has($filtro) ? request($filtro) : '');
        }

        return Excel::download(new TrsExport($lista_de_filtros_ajustada), 'Trs_' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


    public function exportpdf()
    {
        if (Gate::denies('tr-export')) {
            abort(403, 'Acesso negado.');
        }

        $trs = new Tr;

        // fitros
        $lista_de_filtros = ['numero', 'ano', 'descricao', 'situacao_id', 'origem_id', 'tipo_id', 'requisicaoCompras', 'protocoloSisprot', 'modalidade_id', 'numeroModalidade', 'numeroEdital'];

        foreach ($lista_de_filtros as $filtro) {
            if (request()->has($filtro) && !empty(request($filtro))){
                if (is_int(request($filtro))) {
                    $trs = $trs->where($filtro, '=', request($filtro));
                } else {
                    $trs = $trs->where($filtro, 'like', '%' . request($filtro) . '%');
                }
            }   
        }

        // ordena
        $trs = $trs->orderBy('ano', 'desc')->orderBy('numero', 'asc');

        $trs = $trs->get();

        $pdf = PDF::loadView('trs.report', compact('trs'))->setPaper('a4', 'landscape');
        
        return $pdf->download('TRs_' .  date("Y-m-d H:i:s") . '.pdf');

    }

}
