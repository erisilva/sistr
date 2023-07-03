<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Exports\ReportPorSituacaoExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

class RelatorioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['middleware' => 'auth']);
        $this->middleware(['middleware' => 'hasaccess']);
    }

    /**
     * Mostra a página para acesso aos relatórios adicionais do sistema
     *
     */
    public function index()
    {
        return view('relatorio.index');
    }

    /**
     * Exibe uma página com um relatório de TRs por situação, filtrados por período
     *
     */
    public function porSituacao()
    {       
        if (request()->has('dataInicial') && request()->has('dataFinal')) {
            $dataInicial = Carbon::createFromFormat('d/m/Y', request('dataInicial'))->format('Y-m-d 00:00:00');
            $dataFinal = Carbon::createFromFormat('d/m/Y', request('dataFinal'))->format('Y-m-d 23:59:59');
        } else {
            $dataInicial = date('Y-m-d 00:00:00', strtotime('-30 days'));
            $dataFinal = date('Y-m-d 23:59:59');
        }

        # get data
        $porSituacao = DB::table('trs')
            ->join('situacaos', 'situacaos.id', '=', 'trs.situacao_id')
            ->select('situacaos.descricao', DB::raw('count(trs.id) as total'))
            ->where('trs.created_at', '>=', $dataInicial)
            ->where('trs.created_at', '<=', $dataFinal)
            ->groupBy('trs.situacao_id')
            ->orderBy('situacaos.descricao')
            ->get();

        // # get total of trs
        $counterTr = DB::table('trs')
            ->where('trs.created_at', '>=', $dataInicial)
            ->where('trs.created_at', '<=', $dataFinal)
            ->count();

        return view('relatorio.porsituacao', [
            'porSituacao' => $porSituacao,
            'counterTr' => $counterTr
        ]);
    }

    /**
     * Exportação para XLS do relatório de TRs por situação, filtrados por período
     *
     */
    public function porSituacaoExportXLSX()
    {
        # validate and set dates
        if (request()->has('dataInicial') && request()->has('dataFinal')) {
            $dataInicial = Carbon::createFromFormat('d/m/Y', request('dataInicial'))->format('Y-m-d 00:00:00');
            $dataFinal = Carbon::createFromFormat('d/m/Y', request('dataFinal'))->format('Y-m-d 23:59:59');
        } else {
            $dataInicial = date('Y-m-d 00:00:00', strtotime('-30 days'));
            $dataFinal = date('Y-m-d 23:59:59');
        }

        return Excel::download(new ReportPorSituacaoExport($dataInicial, $dataFinal), 'Relatorio_trs_por_situacao' .  date("Y-m-d H:i:s") . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);    
    }

    /**
     * Exportação para XLS do relatório de TRs por situação, filtrados por período
     *
     */
    public function porSituacaoExportCSV()
    {
        # validate and set dates
        if (request()->has('dataInicial') && request()->has('dataFinal')) {
            $dataInicial = Carbon::createFromFormat('d/m/Y', request('dataInicial'))->format('Y-m-d 00:00:00');
            $dataFinal = Carbon::createFromFormat('d/m/Y', request('dataFinal'))->format('Y-m-d 23:59:59');
        } else {
            $dataInicial = date('Y-m-d 00:00:00', strtotime('-30 days'));
            $dataFinal = date('Y-m-d 23:59:59');
        }

        return Excel::download(new ReportPorSituacaoExport($dataInicial, $dataFinal), 'Relatorio_trs_por_situacao' .  date("Y-m-d H:i:s") . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }


    /**
     * Exibe uma página com um relatório de TRs por modalidade, filtrados por período
     *
     */
    public function porModalidade()
    {  
        # validate and set dates
        if (request()->has('dataInicial') && request()->has('dataFinal')) {
            $dataInicial = Carbon::createFromFormat('d/m/Y', request('dataInicial'))->format('Y-m-d 00:00:00');
            $dataFinal = Carbon::createFromFormat('d/m/Y', request('dataFinal'))->format('Y-m-d 23:59:59');
        } else {
            $dataInicial = date('Y-m-d 00:00:00', strtotime('-30 days'));
            $dataFinal = date('Y-m-d 23:59:59');
        }

        # get data
        $porModalidade = DB::table('trs')
            ->join('modalidades', 'modalidades.id', '=', 'trs.modalidade_id')
            ->select('modalidades.descricao', DB::raw('count(trs.id) as total'))
            ->where('trs.created_at', '>=', $dataInicial)
            ->where('trs.created_at', '<=', $dataFinal)
            ->groupBy('trs.modalidade_id')
            ->orderBy('modalidades.descricao')
            ->get();

        // # get total of trs
        $counterTr = DB::table('trs')
            ->where('trs.created_at', '>=', $dataInicial)
            ->where('trs.created_at', '<=', $dataFinal)
            ->count();

        return view('relatorio.pormodalidade', [
            'porModalidade' => $porModalidade,
            'counterTr' => $counterTr
        ]);
    }



    /**
     * Exibe uma página com um relatório de TRs de acordo com a data do pregão, filtrados por período
     *
     */
    public function porUsuario()
    {  
        # vaidate and set dates
        if (request()->has('dataInicial') && request()->has('dataFinal')) {
            $dataInicial = Carbon::createFromFormat('d/m/Y', request('dataInicial'))->format('Y-m-d 00:00:00');
            $dataFinal = Carbon::createFromFormat('d/m/Y', request('dataFinal'))->format('Y-m-d 23:59:59');
        } else {
            $dataInicial = date('Y-m-d 00:00:00', strtotime('-30 days'));
            $dataFinal = date('Y-m-d 23:59:59');
        }

        # get data
        $porUsuario = DB::table('trlogs')
            ->join('users', 'users.id', '=', 'trlogs.user_id')
            ->select('users.name', DB::raw('count(trlogs.id) as total'))
            ->where('trlogs.created_at', '>=', $dataInicial)
            ->where('trlogs.created_at', '<=', $dataFinal)
            ->groupBy('trlogs.user_id')
            ->orderBy('users.name')
            ->get();

        # get total of trs
        $counterTr = DB::table('trlogs')
            ->where('trlogs.created_at', '>=', $dataInicial)
            ->where('trlogs.created_at', '<=', $dataFinal)
            ->count();
        
        return view('relatorio.porusuario', [         
            'porUsuario' => $porUsuario,
            'counterTr' => $counterTr
        ]);
    }



}
