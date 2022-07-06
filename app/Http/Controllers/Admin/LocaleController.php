<?php

namespace App\Http\Controllers\Admin;

use App\Models\Locale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.locales.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.locales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locales.create');
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
        ]);

        Locale::create($request->all());

        return redirect()->route('admin.locales.index')->with('info', 'El local se creó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locale  $locale
     * @return \Illuminate\Http\Response
     */
    public function show(Locale $locale)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locale  $locale
     * @return \Illuminate\Http\Response
     */
    public function edit(Locale $locale)
    {
        
        
        return view('admin.locales.edit', compact('locale'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Locale  $locale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Locale $locale)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        
        $locale->update($request->all());

        return redirect()->route('admin.locales.index')->with('info', 'El local se editó correctamente');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locale  $locale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locale $locale)
    {
        $locale->delete();
        
        return redirect()->route('admin.locales.index')->with('info', 'El local se eliminó correctamente');
    }
}
