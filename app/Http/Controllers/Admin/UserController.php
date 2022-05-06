<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use App\Models\Personale;

use App\Actions\Fortify\PasswordValidationRules;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function __construct(){
        $this->middleware('can:admin.users.index')->only('index');
        // $this->middleware('can:admin.users.destroy')->only('destroy');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $personal = $_GET['personal'];
        
        return view('admin.users.create', compact('personal'));
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
            'email' => ['required', 'email'],
            'password' => $this->passwordRules(),
        ]);

        $name = '';



        try {
            if (isset($request->personal_id)) {
                
                $personal_id = $request->personal_id;
                $personal = Personale::where('id', $personal_id)->first();            
                $name = $personal->nombres.' '.$personal->apellidos;
            
            }

            $user = User::create([
                    'name' => $name,
                    'email' => $request->email,
                    'estado' => $request->estado,
                    'password' => Hash::make($_POST['password']),
                ]);
            

            if (isset($request->personal_id) && $user) {
                
                if ($personal->update(['user_id' => $user->id])) {
                    return redirect()->route('admin.users.edit', $user)->with('info', 'El usuario se creó correctamente, ahora puede asignarle un rol.');
                }
            }


        } catch (\PDOException $e) {
            return view('admin.users.create', [
                'personal' => $personal_id,
                'error' => $e->getMessage()
            ]);
        }
        
        return view('admin.users.create', ['personal' => $personal_id]);

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
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'estado' => ['required', 'numeric', 'min:0', 'max:1']
        ]);


        $user->roles()->sync($request->roles);
        $user->update($request->all());

        return redirect()->route('admin.users.edit', $user)->with('info', 'Se actualizó y asigno los roles correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('info', 'El usuario se eliminó correctamente');
    }
}
