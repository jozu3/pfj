<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pfj;

class PfjController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.pfjs.index')->only('index');
        $this->middleware('can:admin.pfjs.create')->only('create', 'store');
        $this->middleware('can:admin.pfjs.edit')->only('edit', 'update');
        $this->middleware('can:admin.pfjs.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pfjs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pfjs.create');
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
            'nombre' => 'required',
            'lema' => 'required',
            'lema_abreviado' => 'required',
            'estado' => ['required', 'numeric'],
        ]);

        $pfj = Pfj::create($request->all());

        

        return redirect()->route('admin.pfjs.edit', compact('pfj'))->with('info', 'Pfj creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pfj $pfj)
    {
        return view('admin.pfjs.edit', compact('pfj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pfj $pfj)
    {
         $request->validate([
            'nombre' => 'required',
            'estado' => ['required', 'numeric'],
        ]);

        $pfj->update($request->all());

        return redirect()->route('admin.pfjs.edit', compact('pfj'))->with('info', 'Se actualizaron los datos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pfj $pfj)
    {


        if (count($pfj->grupos) || count($pfj->seguimientos)) {
            //return count($pfj->grupos);
            return redirect()->route('admin.pfjs.index')->with('error', 'No puede borrar si tiene grupos o comentarios acerca de este pfj');    
        } else {
            $pfj->delete();
            return redirect()->route('admin.pfjs.index')->with('info', 'El pfj se eliminó con éxito'); 
        }

    }
}
