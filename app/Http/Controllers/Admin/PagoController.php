<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePagoRequest;
use App\Models\Pago;
use App\Models\Cuenta;
use App\Models\Obligacione;

class PagoController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.pagos.index');//->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pagos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Pago::class);
        $idobligacione = null;

        $cuentas = Cuenta::all()->pluck('cuenta', 'id');
        if (isset($_GET['idobligacione'])){
            $idobligacione = Obligacione::find($_GET['idobligacione'])->id;
        }

        return view('admin.pagos.create', compact('cuentas', 'idobligacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePagoRequest $request)
    {

        Pago::create($request->all());

        return redirect()->route('admin.pagos.index')->with('info', 'El pago se registro correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        $cuentas = Cuenta::all()->pluck('cuenta', 'id');
        return view('admin.pagos.edit', compact('pago' ,'cuentas'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function update(StorePagoRequest $request, Pago $pago)
    {
        $this->authorize('update', $pago);
        $pago->update($request->all());

        return redirect()->route('admin.pagos.index')->with('info', 'El pago se registro correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();

        return redirect()->route('admin.pagos.index')->with('info', 'El pago se eliminó');
    }
}
