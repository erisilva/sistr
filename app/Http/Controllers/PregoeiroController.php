<?php

namespace App\Http\Controllers;

use App\Models\Pregoeiro;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

use App\Exports\ResponsavelExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class PregoeiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function show(Pregoeiro $pregoeiro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Pregoeiro $pregoeiro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pregoeiro $pregoeiro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregoeiro  $pregoeiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pregoeiro $pregoeiro)
    {
        //
    }
}
