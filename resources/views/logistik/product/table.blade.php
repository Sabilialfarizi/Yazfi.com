<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped custom-table report" id="product">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Nama Item</th>
                        <th>Supllier</th>
                        <th>Project</th>
                        {{-- <th>Before</th> --}}
                        <th>In</th>
                        <th>Out</th>
                        <th>Last Stok</th>
                        <th>Waktu</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $barang->barang->nama_barang }}</td>
                        <td>{{ $barang->supplier->nama ?? '-' }}</td>
                        <td>
                            @if($barang->project_id)
                            {{ $barang->cabang->nama_project }}
                            @endif
                        </td>   
                        {{-- <td>{{ $barang->in ? $barang->last_stok - $barang->in : $barang->last_stok - $barang->out }}</td> --}}
                        <td>{{ $barang->in ?? '-' }}</td>
                        <td>{{ $barang->out ?? '-' }}</td>
                       <td>{{ $barang->in - $barang->out }}</td>
                        <td>{{ Carbon\Carbon::parse($barang->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $barang->admin->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total : </td>
                       
                     
                        {{-- <td>{{ $barangs->sum('last_stok') - ($barang->sum('out') + $barangs->sum('in')) ?? 0 }}</td> --}}
                        <td>{{ $barangs->sum('in') ?? 0 }}</td>
                        <td>{{ $barangs->sum('out') ?? 0 }}</td>
                        <td>{{$barang->sum('in') - $barangs->sum('out') ?? 0 }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>