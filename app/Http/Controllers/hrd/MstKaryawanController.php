<?php


namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{mst_karyawan,mst_jabatan,User};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash; // Import library hash laravel
use Intervention\Image\Facades\Image;

class MstKaryawanController extends Controller
{

    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path('/img/profile');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
          $this->validate($request, [
            'limit' => 'integer',
        ]);

        //$employees = MstEmployee::orderBy('name')->paginate(8);

        $employees = DB::table('karyawan as a')
        ->join('jabatan as b','b.id','=','a.jabatan_id')
        ->select('a.*','b.jabatan')
        ->when($request->keyword, function ($query) use ($request) {
            $query->where('nik', 'like', "%{$request->keyword}%") // search by nik
            ->orWhere('nama', 'like', "%{$request->keyword}%"); // or by name
        })->paginate($request->limit ? $request->limit : 20);

        $employees->appends($request->only('keyword'));

        return view('mst_karyawan.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
              //generate code 
              $today = date("Ymd");
              // Get the last created nik
              $lastNik = mst_karyawan::orderBy('nik', 'desc')->first();
              if (!$lastNik)
              $number = 0;
              else
              $number = substr($lastNik->nik, 8);
      
             $this->data['nik'] = $lastTrx = $today . sprintf('%02d', intval($number) + 1);
      
              $this->data['jabatan'] = mst_jabatan::SelectBox();
              return view('mst_karyawan.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
      
        $req->validate([
            'nik' => ['required', 'string', 'unique:karyawan', 'max:12'],
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'unique:users'],
            'jk' => ['required', 'string'],
            'no_telp' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'jabatan_id' => ['required', 'string'],
            'tgl_lahir' => ['required', 'string'],
        ]);
        DB::table('users')->insert([
            'name'     => $req->nama,
            'email'    => $req->email,
            'foto'     => $req->foto,
            'password' => Hash::make($req->password),
            'is_admin' => $req->role_id
          ]);
       
          DB::table('karyawan')->insert([
            'users_id'      => User::all()->last()->id,
            'nama'          => $req->nama,
            'nik'           => $req->nik,
            'telp'          => $req->no_telp,
            'jabatan_id'    => $req->jabatan_id,
            'jenis_kelamin' => $req->jk,
            'alamat'        => $req->alamat,
            'tgl_lahir'        => $req->tgl_lahir
          ]);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('MstKaryawan.index');
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
    public function edit($id)
    {
        //
        $this->data['karyawan'] = mst_karyawan::where('users_id',$id)->first();
        $this->data['user'] = User::findOrFail($id);
        $this->data['jabatan'] = mst_jabatan::SelectBox();
        return view('mst_karyawan.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());    

        $request->validate([
            // 'nik' => ['required', 'string', 'unique:karyawan', 'max:11'],
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string'],
            'jk' => ['required', 'string'],
            'no_telp' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'jabatan_id' => ['required', 'string'],
            'role_id' => ['required', 'string'],
            'tgl_lahir' => ['required', 'string']
        ]);
        $karyawan =   DB::table('karyawan')
        ->where('users_id',$id)->first();
        $users =   DB::table('users')
        ->where('id',$id)->first();
          
        if ($request->password!= null ) {
            DB::table('users')->where('id',$id)
        ->update([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->role_id
          ]);
        } else {
            DB::table('users')->where('id',$id)
        ->update([
            'name'     => $request->nama,
            'email'    => $request->email,
            // 'password' => Hash::make($request->password),
            'is_admin' => $request->role_id
          ]);
        }
       
            DB::table('karyawan')
            ->where('users_id',$id)->update([
              'nama'          => $request->nama,
              'telp'          => $request->no_telp,
              'jabatan_id'    => $request->jabatan_id,
              'jenis_kelamin' => $request->jk,
              'alamat'        => $request->alamat,
              'tgl_lahir'        => $request->tgl_lahir
            ]); 
          
  
        Alert::success('Success', 'Data berhasil diUbah!');
        return redirect()->route('MstKaryawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($id);
        User::findOrFail($id)->delete();
        mst_karyawan::where('users_id',$id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('MstKaryawan.index');
    }

    
       // Function handle request
       private function handleRequest($req)
       {
           $data = $req->all();
   
           // jika field foto ada
           if ($req->hasFile('foto'))
           {
               $image       = $req->file('foto');
               $fileName    = date('YmdHis_').$image->getClientOriginalName();
               $destination = $this->uploadPath;
               // simpan foto pada direktori img
               Image:: make($image)->save($destination . '/' . $fileName);
               $data['foto'] = $fileName;
           }else{
            $data['foto'] = null;
           }
           return $data;
       }
   
       // Fungsi untuk mengapus foto yang tersimpan di applikasi
       private function removeImage($image)
       {
           if ( ! empty($image) )
           {
               $imagePath = $this->uploadPath.'/'. $image;
               if ( file_exists($imagePath) ) unlink($imagePath);
           }
       }
}
