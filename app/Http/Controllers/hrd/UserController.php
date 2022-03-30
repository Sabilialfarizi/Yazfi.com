<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\{User, Cabang, Jabatan, Perusahaan, Project};
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::leftJoin('karyawan','users.id','=','karyawan.users_id')
        ->leftJoin('perusahaans','karyawan.id_perusahaan','=','perusahaans.id')
        ->leftJoin('jabatans','karyawan.jabatan_id','=','jabatans.id')
        ->select('jabatans.nama','perusahaans.nama_perusahaan')
        ->orderBy('karyawan.id','desc')->get();
        dd($users);

        return view('hrd.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        $user = new User();
        $perusahaans = Perusahaan::get();
        $jabatans = Jabatan::get();
        $projects = Project::get();
        $perkawinans = DB::table('status_pernikahans')->get();
        $agamas = DB::table('agamas')->get();

        $noUrutAkhir = \App\User::max('id');
        // dd($noUrutAkhir);
        $nourut =   sprintf("%02s", abs($noUrutAkhir + 1))  . sprintf("%05s", abs($noUrutAkhir + 1));

        return view('hrd.users.create', compact('roles', 'nourut','user', 'jabatans', 'perusahaans', 'projects','perkawinans','agamas'));
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());

        $attr = $request->all();
        $image = $request->file('image');
        $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());
        $attr['image'] = $imageUrl;
        $attr['is_active'] = 1;
        $attr['password'] = Hash::make($request->password);  
        $user = User::create($attr);
        $user->assignRole($request->input('role'));
        
        DB::table('karyawan')->insert([
            'users_id'      => User::all()->last()->id,
            'name'          => $request->name,
            'nip'           => $request->nip,
            'no_ktp'           => $request->no_ktp,
            'telp'          => $request->phone_number,
            'id_agamas'     => $request->id_agamas,
            'jabatan_id'    => $request->id_jabatans,
            'jenis_kelamin' => $request->jk,
            'id_pernikahan' => $request->id_pernikahan,
            'id_perusahaan' => $request->id_perusahaan,
            'tgl_lahir'     => $request->tgl_lahir,
            'tgl_masuk'     => $request->created_at,
            
          ]);


        return redirect()->route('hrd.users.index')->with('success', 'User has been added');
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $perusahaans = Perusahaan::get();
        $jabatans = Jabatan::get();
        $projects = Project::get();
        $perkawinans = DB::table('status_pernikahans')->get();
        $agamas = DB::table('agamas')->get();

        $noUrutAkhir = \App\User::max('id');
        // dd($noUrutAkhir);
        $nourut =   sprintf("%02s", abs($noUrutAkhir + 1))  . sprintf("%05s", abs($noUrutAkhir + 1));

        return view('hrd.users.edit', compact('user', 'roles','nourut', 'perusahaans', 'jabatans', 'projects','perkawinans','agamas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $attr = $request->all();
        if ($request->input('password') == null) {
            $attr['password'] = $user->password;
        } else {
            $attr['password'] =  Hash::make($request->password);
        }

        $image = $request->file('image');

        if ($request->file('image')) {
            Storage::delete($user->image);
            $imageUrl = $image->storeAs('images/users', \Str::random(15) . '.' . $image->extension());
            $attr['image'] = $imageUrl;
        } else {
            $attr['image'] = $user->image;
        }

        $user->update($attr);
        $user->syncRoles($request->input('role'));

        return redirect()->route('hrd.users.index')->with('success', 'User has been updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('hrd.users.index')->with('success', 'User has been deleted');
    }
    public function whereProject(Request $request)
    {
        $data = DB::table('perusahaans')
            ->leftJoin('projects', 'perusahaans.id', '=', 'projects.id_perusahaan')
            ->select('projects.nama_project')
            ->groupBy('projects.nama_project')
            ->where('perusahaans.id', $request->id)->get();
        return $data;
        dd($data);
    }
}
