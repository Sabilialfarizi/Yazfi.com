@extends('layouts.master', ['title' => 'Kategori Barang'])

@section('content')
<div class="row justify-content-center text-center">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Edit Kategori Barang</h4>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-sm-12 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" required="" name="nama_kategori" id="nama_kategori"
                                        class="form-control" value="{{ $kategori->nama_kategori ?? '' }}">

                                    @error('nama_kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-12 col-sg-4 m-b-4">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <label for="created_at">Tanggal</label>
                                <input type="datetime-local" name="created_at" id="created_at" class="form-control"
                                    value="{{Carbon\Carbon::parse($kategori->created_at)->format('Y-m-d').'T'.Carbon\Carbon::parse($kategori->created_at)->format('H:i:s')}}">

                                @error('created_at')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-12 col-sg-4 m-b-4 text-center">
                    <ul class="list-unstyled">
                        <li>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
                                    Save</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </form>
    </div>
</div>
@stop