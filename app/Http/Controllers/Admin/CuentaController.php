<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuenta;

class CuentaController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.cuentas.index')->only('index');
        $this->middleware('can:admin.cuentas.create')->only('create', 'store');
        $this->middleware('can:admin.cuentas.edit')->only('edit', 'update');
        $this->middleware('can:admin.cuentas.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cuentas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuentas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cuenta' => 'required',
        ]);

        $request['saldo'] = 0;

        Cuenta::create($request->all());
        return redirect()->route('admin.cuentas.index')->with('info', 'La cuenta se creó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {

        return view('admin.cuentas.edit', compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        $request->validate([
            'cuenta' => 'required',
        ]);

        $request['saldo'] = 0;
        
        $cuenta->update($request->all());
        return redirect()->route('admin.cuentas.index')->with('info', 'La cuenta se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        return redirect()->route('admin.cuentas.index')->with('info', 'La cuenta se elimnió correctamente');
    }
}
