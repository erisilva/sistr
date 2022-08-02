<?php

namespace App\Http\Controllers;

use App\Models\Tr;

use App\Models\Situacao;
use App\Models\Origem;
use App\Models\Tipo;
use App\Models\Responsavel;
use App\Models\Deliberacao;
use App\Models\Modalidade;

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

        /*
numero
ano
descricao
situacao_id
origem_id
tipo_id
requisicaoCompras
protocoloSisprot
modalidade_id
numeroModalidade
numeroEdital
        */

        // filtros
        if (request()->has('numero') && !empty(request('numero'))){
            $trs = $trs->where('numero', '=', request('numero'));
        }

        if (request()->has('ano') && !empty(request('ano'))){
            $trs = $trs->where('ano', '=', request('ano'));
        }

        if (request()->has('descricao') && !empty(request('descricao'))){
            $trs = $trs->where('descricao', 'like', '%' . request('descricao') . '%');
        }

        if (request()->has('situacao_id') && !empty(request('situacao_id'))){
            $trs = $trs->where('situacao_id', '=', request('situacao_id'));
        }

        if (request()->has('origem_id') && !empty(request('origem_id'))){
            $trs = $trs->where('origem_id', '=', request('origem_id'));
        }

        if (request()->has('tipo_id') && !empty(request('tipo_id'))){
            $trs = $trs->where('tipo_id', '=', request('tipo_id'));
        }

        if (request()->has('requisicaoCompras') && !empty(request('requisicaoCompras'))){
            $trs = $trs->where('requisicaoCompras', 'like', '%' . request('requisicaoCompras') . '%');
        }

        if (request()->has('protocoloSisprot') && !empty(request('protocoloSisprot'))){
            $trs = $trs->where('protocoloSisprot', 'like', '%' . request('protocoloSisprot') . '%');
        }

        if (request()->has('modalidade_id') && !empty(request('modalidade_id'))){
            $trs = $trs->where('modalidade_id', '=', request('modalidade_id'));
        }

        if (request()->has('numeroModalidade') && !empty(request('numeroModalidade'))){
            $trs = $trs->where('numeroModalidade', 'like', '%' . request('numeroModalidade') . '%');
        }

        if (request()->has('numeroEdital') && !empty(request('numeroEdital'))){
            $trs = $trs->where('numeroEdital', 'like', '%' . request('numeroEdital') . '%');
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

        return view('trs.create', compact('situacaos', 'origems', 'tipos', 'responsavels','deliberacaos', 'modalidades'));
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
        ],
        [
            'situacao_id.required' => 'Selecione o status do TR na lista',
            'origem_id.required' => 'Selecione a origem do TR na lista',
            'descricao.required' => 'É obrigatório preencher a descrição do TR',
            'tipo_id.required' => 'Selecione o tipo do TR na lista',
            'responsavel_id.required' => 'Selecione o responsável do TR na lista',
            'deliberacao_id.required' => 'Selecione a deliberação do TR na lista',
            'modalidade_id.required' => 'Selecione a modalidade do TR na lista',
        ]);



        $tr = $request->all();

        $user = Auth::user(); // usuário logado no sistema

        $tr['user_id'] = $user->id; // sava o id d user logado no sistema

        # Conversão das datas para formato MySQL Y-m-d
        if(isset($tr['entregueSupAdm'])) {
            $tr['entregueSupAdm'] =  Carbon::createFromFormat('d/m/Y', $tr['entregueSupAdm'] )->format('Y-m-d');
        }

        if(isset($tr['entregueComprasContrato'])) {
            $tr['entregueComprasContrato'] =  Carbon::createFromFormat('d/m/Y', $tr['entregueComprasContrato'] )->format('Y-m-d');
        }

        if(isset($tr['inicioCotacao'])) {
            $tr['inicioCotacao'] =  Carbon::createFromFormat('d/m/Y', $tr['inicioCotacao'] )->format('Y-m-d');
        }
            
        if(isset($tr['terminoCotacao'])) {
            $tr['terminoCotacao'] =  Carbon::createFromFormat('d/m/Y', $tr['terminoCotacao'] )->format('Y-m-d');
        }

        if(isset($tr['envioSuplanPro'])) {
            $tr['envioSuplanPro'] =  Carbon::createFromFormat('d/m/Y', $tr['envioSuplanPro'] )->format('Y-m-d');
        }

        if(isset($tr['retornoSuplanPro'])) {
            $tr['retornoSuplanPro'] =  Carbon::createFromFormat('d/m/Y', $tr['retornoSuplanPro'] )->format('Y-m-d');
        }

        if(isset($tr['assinaturasGabinete'])) {
            $tr['assinaturasGabinete'] =  Carbon::createFromFormat('d/m/Y', $tr['assinaturasGabinete'] )->format('Y-m-d');
        }

        if(isset($tr['envioCCOAF'])) {
            $tr['envioCCOAF'] =  Carbon::createFromFormat('d/m/Y', $tr['envioCCOAF'] )->format('Y-m-d');
        }

        if(isset($tr['retornoCCOAF'])) {
            $tr['retornoCCOAF'] =  Carbon::createFromFormat('d/m/Y', $tr['retornoCCOAF'] )->format('Y-m-d');
        }

        if(isset($tr['autuacao'])) {
            $tr['autuacao'] =  Carbon::createFromFormat('d/m/Y', $tr['autuacao'] )->format('Y-m-d');
        }


        if(isset($tr['inicioMinutas'])) {
            $tr['inicioMinutas'] =  Carbon::createFromFormat('d/m/Y', $tr['inicioMinutas'] )->format('Y-m-d');
        }


        if(isset($tr['teminoMinutas'])) {
            $tr['teminoMinutas'] =  Carbon::createFromFormat('d/m/Y', $tr['teminoMinutas'] )->format('Y-m-d');
        }


        if(isset($tr['inicioMinutasEdital'])) {
            $tr['inicioMinutasEdital'] =  Carbon::createFromFormat('d/m/Y', $tr['inicioMinutasEdital'] )->format('Y-m-d');
        }

        if(isset($tr['terminoMinutasEdital'])) {
            $tr['terminoMinutasEdital'] =  Carbon::createFromFormat('d/m/Y', $tr['terminoMinutasEdital'] )->format('Y-m-d');
        }

        if(isset($tr['envioPgm'])) {
            $tr['envioPgm'] =  Carbon::createFromFormat('d/m/Y', $tr['envioPgm'] )->format('Y-m-d');
        }

        if(isset($tr['retornoPgm'])) {
            $tr['retornoPgm'] =  Carbon::createFromFormat('d/m/Y', $tr['retornoPgm'] )->format('Y-m-d');
        }

        if(isset($tr['pendenciasPgm'])) {
            $tr['pendenciasPgm'] =  Carbon::createFromFormat('d/m/Y', $tr['pendenciasPgm'] )->format('Y-m-d');
        }

        if(isset($tr['dataPregao'])) {
            $tr['dataPregao'] =  Carbon::createFromFormat('d/m/Y', $tr['dataPregao'] )->format('Y-m-d');
        }

        if(isset($tr['dataHomologacao'])) {
            $tr['dataHomologacao'] =  Carbon::createFromFormat('d/m/Y', $tr['dataHomologacao'] )->format('Y-m-d');
        }

        if(isset($tr['dataRatificacao'])) {
            $tr['dataRatificacao'] =  Carbon::createFromFormat('d/m/Y', $tr['dataRatificacao'] )->format('Y-m-d');
        }

        if(isset($tr['formalizacaoContratoArp'])) {
            $tr['formalizacaoContratoArp'] =  Carbon::createFromFormat('d/m/Y', $tr['formalizacaoContratoArp'] )->format('Y-m-d');
        }

        if(isset($tr['dataContratoArp'])) {
            $tr['dataContratoArp'] =  Carbon::createFromFormat('d/m/Y', $tr['dataContratoArp'] )->format('Y-m-d');
        }

        if(isset($tr['solicitacaoEmpenho'])) {
            $tr['solicitacaoEmpenho'] =  Carbon::createFromFormat('d/m/Y', $tr['solicitacaoEmpenho'] )->format('Y-m-d');
        }

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

        return view('trs.edit', compact('tr','situacaos', 'origems', 'tipos', 'responsavels','deliberacaos', 'modalidades'));
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
        ],
        [
            'situacao_id.required' => 'Selecione o status do TR na lista',
            'origem_id.required' => 'Selecione a origem do TR na lista',
            'descricao.required' => 'É obrigatório preencher a descrição do TR',
            'tipo_id.required' => 'Selecione o tipo do TR na lista',
            'responsavel_id.required' => 'Selecione o responsável do TR na lista',
            'deliberacao_id.required' => 'Selecione a deliberação do TR na lista',
            'modalidade_id.required' => 'Selecione a modalidade do TR na lista',
        ]);

        $tr = $request->all();

        //dd($tr);

        # Conversão das datas para formato MySQL Y-m-d
        if(isset($tr['entregueSupAdm']) && !empty($tr['entregueSupAdm'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('entregueSupAdm'))->format('Y-m-d');
            $tr['entregueSupAdm'] =  $dataFormatadaMysql;
        }

        if(isset($tr['entregueComprasContrato']) && !empty($tr['entregueComprasContrato'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('entregueComprasContrato'))->format('Y-m-d');
            $tr['entregueComprasContrato'] =  $dataFormatadaMysql;
        }

        if(isset($tr['inicioCotacao']) && !empty($tr['inicioCotacao'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('inicioCotacao'))->format('Y-m-d');
            $tr['inicioCotacao'] =  $dataFormatadaMysql;
        }
            
        if(isset($tr['terminoCotacao']) && !empty($tr['terminoCotacao'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('terminoCotacao'))->format('Y-m-d');
            $tr['terminoCotacao'] =  $dataFormatadaMysql;
        }

        if(isset($tr['envioSuplanPro']) && !empty($tr['envioSuplanPro'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('envioSuplanPro'))->format('Y-m-d');
            $tr['envioSuplanPro'] =  $dataFormatadaMysql;
        }

        if(isset($tr['retornoSuplanPro']) && !empty($tr['retornoSuplanPro'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('retornoSuplanPro'))->format('Y-m-d');
            $tr['retornoSuplanPro'] =  $dataFormatadaMysql;
        }

        if(isset($tr['assinaturasGabinete']) && !empty($tr['assinaturasGabinete'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('assinaturasGabinete'))->format('Y-m-d');
            $tr['assinaturasGabinete'] =  $dataFormatadaMysql;
        }

        if(isset($tr['envioCCOAF']) && !empty($tr['envioCCOAF'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('envioCCOAF'))->format('Y-m-d');
            $tr['envioCCOAF'] =  $dataFormatadaMysql;
        }

        if(isset($tr['retornoCCOAF']) && !empty($tr['retornoCCOAF'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('retornoCCOAF'))->format('Y-m-d');
            $tr['retornoCCOAF'] =  $dataFormatadaMysql;
        }

        if(isset($tr['autuacao']) && !empty($tr['autuacao'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('autuacao'))->format('Y-m-d');
            $tr['autuacao'] =  $dataFormatadaMysql;
        }


        if(isset($tr['inicioMinutas']) && !empty($tr['inicioMinutas'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('inicioMinutas'))->format('Y-m-d');
            $tr['inicioMinutas'] =  $dataFormatadaMysql;
        }


        if(isset($tr['teminoMinutas']) && !empty($tr['teminoMinutas'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('teminoMinutas'))->format('Y-m-d');
            $tr['teminoMinutas'] =  $dataFormatadaMysql;
        }


        if(isset($tr['inicioMinutasEdital']) && !empty($tr['inicioMinutasEdital'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('inicioMinutasEdital'))->format('Y-m-d');
            $tr['inicioMinutasEdital'] =  $dataFormatadaMysql;
        }

        if(isset($tr['terminoMinutasEdital']) && !empty($tr['terminoMinutasEdital'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('terminoMinutasEdital'))->format('Y-m-d');
            $tr['terminoMinutasEdital'] =  $dataFormatadaMysql;
        }

        if(isset($tr['envioPgm']) && !empty($tr['envioPgm'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('envioPgm'))->format('Y-m-d');
            $tr['envioPgm'] =  $dataFormatadaMysql;
        }

        if(isset($tr['retornoPgm']) && !empty($tr['retornoPgm'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('retornoPgm'))->format('Y-m-d');
            $tr['retornoPgm'] =  $dataFormatadaMysql;
        }

        if(isset($tr['pendenciasPgm']) && !empty($tr['pendenciasPgm'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('pendenciasPgm'))->format('Y-m-d');
            $tr['pendenciasPgm'] =  $dataFormatadaMysql;
        }

        if(isset($tr['dataPregao']) && !empty($tr['dataPregao'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('dataPregao'))->format('Y-m-d');
            $tr['dataPregao'] =  $dataFormatadaMysql;
        }

        if(isset($tr['dataHomologacao']) && !empty($tr['dataHomologacao'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('dataHomologacao'))->format('Y-m-d');
            $tr['dataHomologacao'] =  $dataFormatadaMysql;
        }

        if(isset($tr['dataRatificacao']) && !empty($tr['dataRatificacao'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('dataRatificacao'))->format('Y-m-d');
            $tr['dataRatificacao'] =  $dataFormatadaMysql;
        }

        if(isset($tr['formalizacaoContratoArp']) && !empty($tr['formalizacaoContratoArp'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('formalizacaoContratoArp'))->format('Y-m-d');
            $tr['formalizacaoContratoArp'] =  $dataFormatadaMysql;
        }

        if(isset($tr['dataContratoArp']) && !empty($tr['dataContratoArp'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('dataContratoArp'))->format('Y-m-d');
            $tr['dataContratoArp'] =  $dataFormatadaMysql;
        }

        if(isset($tr['solicitacaoEmpenho']) && !empty($tr['solicitacaoEmpenho'])) {
            $dataFormatadaMysql = Carbon::createFromFormat('d/m/Y', request('solicitacaoEmpenho'))->format('Y-m-d');
            $tr['solicitacaoEmpenho'] =  $dataFormatadaMysql;
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
}
