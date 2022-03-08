<?php

namespace App\Http\Controllers\Purchasing;

use App\Barang;
use App\DetailTukarFaktur;
use App\HargaProdukCabang;
use App\Http\Controllers\Controller;
use App\InOut;
use App\PenerimaanBarang;
use App\Purchase;
use App\Supplier;
use App\Project;
use App\TukarFaktur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TukarFakturController extends Controller
{
    public function index(Purchase $purchase)
    {
        if (request('from') && request('to')) {
            $from = Carbon::createFromFormat('d/m/Y', request('from'))->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d/m/Y', request('to'))->format('Y-m-d H:i:s');
            $purchases = TukarFaktur::groupBy('no_faktur')->whereBetween('tanggal_tukar_faktur', [$from, $to])->get();
        } else {

            $tukar = DB::table('tukar_fakturs')
            ->leftJoin('suppliers','tukar_fakturs.id_supplier','=','suppliers.id')
            ->select('tukar_fakturs.no_faktur','tukar_fakturs.id','tukar_fakturs.tanggal_tukar_faktur','tukar_fakturs.no_po_vendor','tukar_fakturs.nilai_invoice','suppliers.nama')
            ->orderBy('tukar_fakturs.id','desc')
            ->get();
          
        }


        return view('purchasing.tukarfaktur.index', compact('purchases','tukar'));
    }
    

    public function create(Request $request)
    {
        $purchasing = DB::table('dokumen_tukar_faktur')->get();
        
        $purchases = DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->leftJoin('suppliers','purchases.supplier_id','=','suppliers.id')
        ->leftJoin('barangs','penerimaan_barangs.barang_id','=','barangs.id')
        ->leftJoin('users','users.id','=','penerimaan_barangs.id_user')
        ->select('penerimaan_barangs.status_tukar_faktur','purchases.status_barang','purchases.project_id','purchases.invoice','penerimaan_barangs.total','penerimaan_barangs.id','purchases.supplier_id','barangs.nama_barang','penerimaan_barangs.id_purchase','penerimaan_barangs.qty',
        'penerimaan_barangs.harga_beli','users.name','suppliers.nama','penerimaan_barangs.no_penerimaan_barang')
        ->where('penerimaan_barangs.no_penerimaan_barang', $request->no_penerimaan_barang)
        ->where('purchases.status_barang','completed')
        ->where('penerimaan_barangs.status_tukar_faktur','pending')
        ->get();
        // $purchases = Purchase::where('status_barang', 'pending')->where('invoice',$request->invoice)->get();
      
        $suppliers = Supplier::get();
        $project = Project::get();
        //no PO
        $barangs = Barang::where('id_jenis', '1')->get();
        $AWALPO = 'PO';
        $noUrutAkhirPO = \App\Purchase::max('id');
        $nourutPO = $AWALPO . '/' .  sprintf("%02s", abs($noUrutAkhirPO + 1)) . '/' . sprintf("%05s", abs($noUrutAkhirPO + 1));
        //nomor tukarfaktur

        $tukarfaktur = 'TF';
        $noUrutAkhirTF = \App\TukarFaktur::max('id');
        // dd($noUrutAkhir);
        $nourutTF = $tukarfaktur . '/' .  sprintf("%02s", abs($noUrutAkhirTF + 1)) . '/' . sprintf("%05s", abs($noUrutAkhirTF + 1));

        // dd($purchases);
   
 
        $purchase = DB::table('penerimaan_barangs')->groupBy('no_penerimaan_barang')->get();
        
        return view('purchasing.tukarfaktur.create', compact('purchasing','purchase','purchases','suppliers', 'barangs', 'project', 'nourutPO','nourutTF'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required',
            'id_supplier' => 'required',
            'no_po_vendor' => 'required',
            'no_invoice' => 'required',
            'nilai_invoice' => 'required',
            'tanggal_tukar_faktur' => 'required',
            'id_dokumen' => 'required',
            'id_project' => 'required',
            'pilihan' => 'required',
            'nama_barang' => 'required',
        ]);

        $dokumen = $request->input('id_dokumen', []);
        $barang = $request->input('nama_barang', []);
        $attr = [];
        $in = [];
        // dd($request->all());
        DB::beginTransaction();
    
        $attr[] = [
            'no_faktur' => $request->no_faktur,
            'id_supplier' => $request->id_supplier,
            'po_spk' => $request->po_spk,
            'no_po_vendor' => $request->no_po_vendor,
            'no_invoice' => $request->no_invoice,
            'nama_barang' => $request->nama_barang,
            'nilai_invoice' => $request->nilai_invoice,
            'id_project' => $request->id_project,
            'id_user' => Auth::user()->id,
            'tanggal_tukar_faktur' => $request->tanggal_tukar_faktur,
            'is_active' =>1,
            
        ];
        // dd($attr);
      
        foreach ($dokumen as $key => $no) {
            $in[] = [
                'no_faktur' => $request->no_faktur,
                'id_dokumen' => $no,
                'catatan' => $request->catatan[$key] ,
                'pilihan' => $request->pilihan[$key],
                'is_active' => 1,
            ];
            // dd($in);

            $penerimaan = PenerimaanBarang::where('no_po', $request->no_po_vendor)->first();
            //  dd($penerimaan);
            $array =  DB::table('penerimaan_barangs')->whereIn('id', $penerimaan)->update(array( 
            'status_tukar_faktur' => 'completed'));
            // dd($array);
            
        }
        
       

        DB::table('tukar_fakturs')->insert($attr);
        DB::table('detail_tukar_fakturs')->insert($in);

        DB::commit();

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Tukar Faktur barang berhasil');
    }
    // public function spk(Request $request)
    // {
    //     $request->validate([
    //         'no_faktur' => 'required',
    //         'id_supplier' => 'required',
    //         'no_po_vendor' => 'required',
    //         'no_invoice' => 'required',
    //         'nilai_invoice' => 'required',
    //         'nama_barang' => 'required',
    //         'tanggal_tukar_faktur' => 'required',
    //         'id_dokumen' => 'required',
    //         'pilihan' => 'required',
    //     ]);

    //     $dokumen = $request->input('id_dokumen', []);
    //     $attr = [];
    //     $in = [];
    //     // dd($request->all());
    //     DB::beginTransaction();
    //     $attr[] = [
    //         'no_faktur' => $request->no_faktur,
    //         'id_supplier' => $request->id_supplier,
    //         'po_spk' => $request->po_spk,
    //         'no_po_vendor' => $request->no_po_vendor,
    //         'no_invoice' => $request->no_invoice,
    //         'nilai_invoice' => $request->nilai_invoice,
    //         'nama_barang' => $request->nama_barang,
    //         'id_user' => auth()->user()->id,
    //         'tanggal_tukar_faktur' => $request->tanggal_tukar_faktur,
    //         'is_active' =>1,
            
    //     ];
    //     foreach ($dokumen as $key => $no) {
    //         $in[] = [
    //             'no_faktur' => $request->no_faktur,
    //             'id_dokumen' => $no,
    //             'catatan' => $request->catatan[$key] ,
    //             'pilihan' => $request->pilihan[$key],
    //             'is_active' => 1,
    //         ];
    //         // dd($in);
    //         // dd($attr);
    //     }

    //     DB::table('tukar_fakturs')->insert($attr);
    //     DB::table('detail_tukar_fakturs')->insert($in);

    //     DB::commit();

    //     return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Tukar Faktur barang berhasil');
    // }
    public function search(Request $request)
    {
        $data = [];
        $tukar =  DB::table('penerimaan_barangs')
        ->leftJoin('purchases','penerimaan_barangs.id_purchase','=','purchases.id')
        ->select('purchases.status_barang','penerimaan_barangs.id_purchase','purchases.id','penerimaan_barangs.no_penerimaan_barang')
        ->where('penerimaan_barangs.no_penerimaan_barang', $request->no_penerimaan_barang)
        ->where('purchases.status_barang', 'completed')
        ->get();
        if (count($tukar) == 0) {
            $data[] = "No Items Found";
        } else {
            foreach ($tukar as $value) {
                $data[] = [
                    'id' => $value->id,
                    'no_penerimaan_barang' => $value->no_penerimaan_barang,
                 
                ];
            }
        }
        return $data;
    }

    public function show(TukarFaktur $tukar, Request $request)
    {
        

       
        $detail = DB::table('tukar_fakturs')
            // ->leftJoin('detail_tukar_fakturs', 'tukar_fakturs.no_faktur', '=', 'detail_tukar_fakturs.no_faktur')
            // ->leftJoin('dokumen_tukar_faktur','detail_tukar_fakturs.id_dokumen','=','dokumen_tukar_faktur.id_dokumen')
            // ->select('tukar_fakturs.no_faktur','tukar_fakturs.id','tukar_fakturs.nilai_invoice','detail_tukar_fakturs.pilihan','dokumen_tukar_faktur.nama_dokumen', 'detail_tukar_fakturs.catatan')
            ->where('id',$tukar->id)
            ->get();
            dd($tukar);
            $dokumen = DB::table('dokumen_tukar_faktur')->get();

             $tukars = DB::table('tukar_fakturs')
            ->leftJoin('suppliers', 'tukar_fakturs.id_supplier', '=', 'suppliers.id')
            ->select('suppliers.nama', 'tukar_fakturs.no_faktur', 'tukar_fakturs.nilai_invoice', 'tukar_fakturs.tanggal_tukar_faktur')
            ->first();
        return view('purchasing.tukarfaktur.show', compact('tukars','tukar','detail','dokumen'));
    }

    public function edit(Purchase $purchase)
    {
        $purchases = Purchase::where('invoice', $purchase->invoice)->get();
        $suppliers = Supplier::get();
        $project = Project::get();
        $barangs = Barang::where('jenis', 'barang')->get();

        return view('purchasing.tukarfaktur.edit', compact('project', 'purchase', 'suppliers', 'barangs', 'purchases'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required',
            'harga_beli' => 'required',
            'invoice' => 'required',
        ]);
        $barang = $request->input('barang_id', []);
        $attr = [];
        // $in = [];
        $id = [];
        $purchases = Purchase::where('invoice', $purchase->invoice)->pluck('id');
        // dd("ok");
        // dd($purchases);
        DB::beginTransaction();
        foreach ($barang as $key => $no) {
            $attr[] = [
                'invoice' => $request->invoice,
                'supplier_id' => $request->supplier_id,
                'barang_id' => $no,
                'qty' => $request->qty[$key],
                'harga_beli' => $request->harga_beli[$key],
                'PPN' => $request->PPN,
                'total' => $request->harga_beli[$key] * $request->qty[$key],
                'user_id' => auth()->user()->id,
                'created_at' => $request->tanggal,
                'status_pembayaran' => 'pending',
                'status_barang' => 'pending'
            ];
            $id[] = $purchases[$key];
        }

        // Purchase::updateOrInsert([
        //     'id' => $id
        // ], $attr);

        // InOut::insert($in);

        DB::commit();

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Purchase barang berhasil');
    }

    public function destroy($id)
    {
        $purchases = TukarFaktur::where('id', $id)->delete();
        // dd($purchases);
    

        return redirect()->route('purchasing.tukarfaktur.index')->with('success', 'Tukar Faktur barang didelete');
    }

    public function whereProject(Request $request)
    {
        $data = DB::table('projects')
            ->select('projects.alamat_project')
            ->groupBy('projects.alamat_project')
            ->where('projects.id', $request->id)->get();
        return $data;
        dd($data);
    }
    public function WhereProduct(Request $request)
    {
        $data = [];
        $product =  Barang::where('jenis', 'barang_id')
            ->where('nama_barang', 'like', '%' . $request->q . '%')
            ->get();
        foreach ($product as $row) {
            $data[] = ['id' => $row->id,  'text' => $row->nama_barang];
        }

        return $data;
        dd($data);
    }
}
