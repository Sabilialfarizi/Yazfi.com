@extends('layouts.master', ['title' => 'Show Pengajuan Dana'])
@section('content')
<div class="row">
    <div class="col-sm-5 col-4">
        <h4 class="page-title">Show Pengajuan Dana</h4>
    </div>
    <div class="col-sm-7 col-8 text-right m-b-30">
        <div class="btn-group btn-group-sm ">
            <a href="{{ route('logistik.pengajuan.pdf',$pengajuan->id) }}" class="btn btn-success btn-sm">Export to PDF</a>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3 body-main">
            <div class="col-md-12">
                <div class="card shadow" id="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-logo">
                                    <img src="{{url('/img/logo/yazfi.png ')}}" alt="Image" />
                                </div>
                            </div>
                            <div class="col-md-8 text-right">
                                <h6><span style="font-size: 15px; color:white; background-color:blue;">{{$pengajuan->nomor_pengajuan}}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2><span style="color:blue; text-decoration: underline; font-size: 20px">Pengajuan Dana</span></h2>
                            </div>
                        </div> <br />
                        <div class="payment-details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p style="font-size: 12px">Nama :
                                        <a>
                                            {{ $jabatan->name }}
                                        </a>
                                    </p style="font-size: 12px">
                                    <p style="font-size: 12px">Jabatan :
                                        <a style="font-size: 12px">
                                            {{ $jabatan->nama }}
                                        </a>
                                    </p>
                                    <p style="font-size: 12px">Divisi :
                                        <a style="font-size: 12px">
                                            {{ $jabatan->name_roles }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-sm-6 tex-right">
                                    <div class="form-group">
                                        <p style="font-size: 12px">Tanggal : <a style="font-size: 12px">{{ Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y H:i:s') }}
                                            </a></p>
                                    </div>
                                    <div class="form-group">
                                        <p style="font-size: 12px">Lampiran : <a style="font-size: 12px">{{$pengajuan->nomor_pengajuan}}/{{ $pengajuan->file }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered  ">
                                        <tr class="bg-success">
                                            <th class="text-light">No.</th>
                                            <th class="text-light">Deskripsi</th>
                                            <th class="text-light">Harga Satuan</th>
                                            <th class="text-light">Kwitansi</th>
                                            <th class="text-light">Jumlah</th>
                                            <th class="text-light">Keterangan</th>
                                        </tr>
                                        <tbody>

                                            @php
                                            $total = 0
                                            @endphp

                                            <tr>
                                                <td class="dynamic-hidden-col">
                                                </td>
                                                <td>{{ $pengajuan->barang_id }}</td>
                                                <td>@currency($pengajuan->harga_beli)</td>
                                                <td>{{ $pengajuan->grandtotal }}</td>
                                                <td>{{ $pengajuan->grandtotal }}</td>
                                                <td>{{ $pengajuan->keterangan }}</td>
                                            </tr>
                                            @php
                                            $total += $pengajuan->grandtotal
                                            @endphp

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"><strong>Total<strong> </td>
                                                <td><b>@currency($total)</b></td>

                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" rowspan="1">Cat :</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p class="text-center">Diajukan Oleh,</p>
                                                </td>
                                                <td colspan="2">
                                                    <p class="text-center">DiPeriksa,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-left">Manager</p>
                                                    <p class="text-right" style="margin-top: -37px;">Keuangan</p>
                                                </td>
                                                <td colspan="1">
                                                    <p class="text-center">DiSetujui,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-center">Direktur</p>
                                                </td>
                                                <td colspan="1">
                                                    <p class="text-center">DiKetahui,</p>
                                                    <br>
                                                    <br>
                                                    <p class="text-center">Komisaris</p>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                            <td colspan="6" rowspan="2">Cat :</td>
                                        </tr> -->

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop