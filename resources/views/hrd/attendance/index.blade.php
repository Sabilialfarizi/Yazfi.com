@extends('layouts.master', ['title' => 'Attendance'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('hrd.attendance.laporan') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="month" name="month" value="{{ $month ?? '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                @for($i = 0; $i < Carbon\Carbon::parse($month)->endOfMonth()->format('d');$i++)
                                    <th>{{ Carbon\Carbon::parse($month)->startOfMonth()->addDay($i)->format('d') }}</th>
                                    @endfor
                                <th>terlambat</th>
                               <th>absen</th>
                            </tr>
                        </thead>
                        @php
                        $array_absen = [];
                        $array_telat = [];
                        @endphp
                        <tbody>
                            @foreach($user as $pegawai)
                            @php
                            $absen = 0;
                            $telat = 0;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <th>{{ $pegawai->name }}
                                </th>
                                
                                @for($i = 0 ;$i < Carbon\Carbon::parse($month)->endOfMonth()->format('d');$i++)
                                    <td>{{ $pegawai->absensi->where('tanggal', Carbon\Carbon::parse($month)->startOfMonth()->addDay($i)->format('Y-m-d'))->first()->jam_masuk ?? '' }}
                                        <br>
                                        {{ $pegawai->absensi->where('tanggal', Carbon\Carbon::parse($month)->startOfMonth()->addDay($i)->format('Y-m-d'))->first()->jam_keluar ?? '' }}
                                        {{-- @foreach($holiday as $list)
                                        @if(Carbon\Carbon::parse($list->holiday_date)->format('d') == $i)
                                        <span style="color: red;">{{ $list->title }}</span>
                                        @endif
                                        @endforeach --}}
                                    </td>
                                    @php
                                    if($pegawai->absensi->where('tanggal', Carbon\Carbon::parse($month)->startOfMonth()->addDay($i)->format('Y-m-d'))->first()->jam_masuk ?? false){
                                    $absen += 1;
                                    }
                                    if($pegawai->absensi->where('tanggal', Carbon\Carbon::parse($month)->startOfMonth()->addDay($i)->format('Y-m-d'))->first()){
                                    if($pegawai->absensi->where('tanggal', Carbon\Carbon::parse($month)->startOfMonth()->addDay($i)->format('Y-m-d'))->first()->jam_masuk >= \App\Jam::where('kode', 'SF1')->first()->selesai){
                                    $telat += 1;
                                    }
                                    }
                                    @endphp
                                    @endfor
                                    <td>{{ $telat }}</td>
                                    <td>{{ $absen }}</td>
                                    @php
                                    array_push($array_absen, $absen);
                                    array_push($array_telat, $telat);
                                    @endphp

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="{{ 2 + Carbon\Carbon::parse($month)->lastOfMonth()->format('d') }}"></td>
                                <td>{{ array_sum($array_telat) }}</td>
                                <td>{{ array_sum($array_absen) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('footer')
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script>
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
    })
    $('.delete_confirm').click(function(event) {
        let form = $(this).closest("form");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
@stop