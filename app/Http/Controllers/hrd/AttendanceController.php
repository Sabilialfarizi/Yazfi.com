<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\{Cabang, Holidays, Jadwal, Ruangan, Shift, User};
use App\Models\mst_jabatan;
use App\Models\mst_karyawan;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $array = [];
    public function index()
    {


        $datetime = Carbon::now();

        $month = $datetime->format('m');
        $year = $datetime->format('Y');
        $day = $datetime->endOfMonth()->format('d');

        $users = mst_karyawan::select('jabatan_id')->get();
        // dd($users);
        $pegawais = mst_karyawan::leftJoin('roles', 'karyawan.jabatan_id', '=', 'roles.id')->whereIn('roles.id', $users)->select('roles.key')->first();
        // dd($pegawais);


        return view('hrd.attendance.index', [
            'user' => mst_karyawan::get(),
            'pegawais' => $pegawais,
            'user_mode' => User::latest()->get(),
            'holiday' => Holidays::whereMonth('holiday_date', $datetime->format('m'))->whereYear('holiday_date', $datetime->format('Y'))->get(),
            // 'cabangs' => Cabang::get(),
            // 'ruangans' => Ruangan::get(),
            // 'shift' => Shift::pluck('kode'),
            'month' => Carbon::now()->format('Y-m'),
            'year' => $year,
            // 'day' => $day
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function laporan(Request $request)
    {
        $datetime = Carbon::now();

        $month = $datetime->format('m');
        $year = $datetime->format('Y');
        $day = $datetime->endOfMonth()->format('d');

        $users = mst_karyawan::select('jabatan_id')->get();
        // dd($users);
        $pegawais = mst_karyawan::leftJoin('roles', 'karyawan.jabatan_id', '=', 'roles.id')->whereIn('roles.id', $users)->select('roles.key')->first();
        // dd($pegawais);
        return view('hrd.attendance.index', [
            'user' => mst_karyawan::get(),
            'pegawais' => $pegawais,
            'user_mode' => User::latest()->get(),
            'holiday' => Holidays::get(),
            // 'cabangs' => Cabang::get(),
            // 'ruangans' => Ruangan::get(),
            'month' => Carbon::parse($request->month)->format('Y-m'),
            'year' => $year,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function cek($row)
    {
        $bulan = Carbon::now()->format('m');
        $tanggal_akhir = Carbon::now()->endOfMonth()->format('d');
        $holiday = Holidays::whereMonth('holiday_date', $bulan)->pluck('holiday_date');

        for ($i = 0; $i < $tanggal_akhir; $i++) {
            if (in_array(Carbon::now()->startOfMonth()->addDays($i)->format('Y-m-d'), $holiday->toArray())) {
                return 'disabled';
            } else {
                return 'checked';
            }
        }
    }
}
