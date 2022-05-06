<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Personale_unidade;
use Illuminate\Http\Request;

class PersonaleUnidadeController extends Controller
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
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Personale_unidade $personale_unidade)
    {
        return view('st.personale_unidade.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Personale_unidade $personale_unidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personale_unidade $personale_unidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personale_unidade  $personale_unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personale_unidade $personale_unidade)
    {
        //
    }
}
