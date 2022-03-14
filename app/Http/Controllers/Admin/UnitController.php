<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateWarehouseRequest;
use App\{Cabang, Unit, HargaProdukCabang, Perusahaan, Ruangan, UnitRumah};
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        // abort_unless(\Gate::allows('product-access'), 403);

        $units = DB::table('unit_rumahs')->orderBy('id','desc')
        ->get();
        return view('admin.unit.index', compact('units'));
    }

    public function create(UnitRumah $unit)
    {
        // abort_unless(\Gate::allows('product-create'), 403);

        $perusahaans = Perusahaan::get();

        return view('admin.unit.create', compact('unit','perusahaans'));
    }

    public function store(Request $request)
    {
        // abort_unless(\Gate::allows('product-create'), 403);

        $request['type'] = request('type');
        $request['blok'] = request('blok');
        $request['no'] = request('no');
        $request['lb'] = request('lb');
        $request['lt'] = request('lt');
        $request['nstd'] = request('nstd');
        $request['total'] = request('total');
        $request['jual'] = request('jual');
        $request['status_penjualan'] = 'Available';

        UnitRumah::create($request->all());

        return redirect()->route('admin.unit.index')->with('success', 'Unit Rumah has been added');
    }

    public function edit(UnitRumah $unit)
    {
        // abort_unless(\Gate::allows('cabang-edit'), 403);
     

        return view('admin.unit.edit', compact('unit'));
    }

    public function update(Request $request, UnitRumah $unit)
    {
        // abort_unless(\Gate::allows('product-edit'), 403);
        $request['type'] = request('type');
        $request['blok'] = request('blok');
        $request['no'] = request('no');
        $request['lb'] = request('lb');
        $request['lt'] = request('lt');
        $request['nstd'] = request('nstd');
        $request['total'] = request('total');
        $request['jual'] = request('jual');
        $request['status_penjualan'] = 'Available';

        $unit->update($request->all());

        return redirect()->route('admin.unit.index')->with('success', 'Unit Rumah has been updated');
    }

    public function destroy($id)
    {
        // abort_unless(\Gate::allows('product-delete'), 403);
        UnitRumah::where('id', $id)->delete();

        // $unit->delete();

        return redirect()->route('admin.unit.index')->with('success', 'Unit Rumah has been deleted');
    }
}
