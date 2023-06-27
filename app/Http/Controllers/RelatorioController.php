<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('relatorio.index');
    }

    public function porSituacao()
    {
        $porSituacao = DB::table('situacaos');
        $porSituacao = $porSituacao->select('situacaos.descricao', DB::raw('(select count(trs.id) from trs where trs.situacao_id = situacaos.id) as total'));
        $porSituacao = $porSituacao->orderBy('situacaos.descricao');
        $porSituacao = $porSituacao->get();

        $counterTr = DB::table('trs')->count();

        return view('relatorio.porsituacao', [
            'porSituacao' => $porSituacao,
            'counterTr' => $counterTr
        ]);
    }


}
