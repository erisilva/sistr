<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('monitor-view')) {
            abort(403, 'Acesso não autorizado!');
        }

        $porSituacao = DB::table('situacaos');
        $porSituacao = $porSituacao->select('situacaos.descricao', DB::raw('(select count(trs.id) from trs where trs.situacao_id = situacaos.id) as total'));
        $porSituacao = $porSituacao->orderBy('situacaos.descricao');
        $porSituacao = $porSituacao->get();

        $porModalidade = DB::table('modalidades');
        $porModalidade = $porModalidade->select('modalidades.descricao', DB::raw('(select count(trs.id) from trs where trs.modalidade_id = modalidades.id) as total'));
        $porModalidade = $porModalidade->orderBy('modalidades.descricao');
        $porModalidade = $porModalidade->get();

        $counterTr = DB::table('trs')->count();

        for ($i = 0; $i < 15; $i++){
                $timestamp = time();
                $tm = 86400 * $i; // 60 * 60 * 24 = 86400 = 1 day in seconds
                $tm = $timestamp - $tm;

                $the_date = date("Y-m-d", $tm);

                $dias[] = $the_date;
            }

        foreach ($dias as $dia) {
            $total_creados_no_dia = DB::table('trs')->whereDate('created_at', '=',  $dia)->count();
            $total_editados_no_dia = DB::table('trlogs')->whereDate('created_at', '=',  $dia)->count();
            $temp = array(
                'total_criado_dia' => $total_creados_no_dia,
                'total_editado_dia' => $total_editados_no_dia,
                'data' => $dia
            );
            $grafico_de_criados_editados_por_dia[] = $temp;
        }  

        return view('monitor.index', [
            'porSituacao' => $porSituacao,
            'porModalidade' => $porModalidade,
            'counterTr' => $counterTr,
            'criadoseditadosPorDia' => $grafico_de_criados_editados_por_dia
        ]);
    }

}
