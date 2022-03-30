<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" required=""
                                        value="{{ $user ? $user->name : '' }}">

                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="nik">NIP</label>
                                    <input type="text" name="nip" id="nip" value="{{ $nourut }}" required=""
                                        class="form-control">

                                    @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="no">No. KTP</label>
                                    <input type="text" name="no_ktp" id="no_ktp" required="" maxlength="16"
                                        minlength="16" class="form-control" value="{{ $user ? $user->no_ktp : '' }}">

                                    @error('no_ktp')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" required="" id="email" class="form-control"
                                        value="{{ $user ? $user->email : '' }}">

                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="phone_number">No Telp.</label>
                                    <input type="text" name="phone_number" id="phone_number" required=""
                                        class="form-control" maxlength="12" minlength="12"
                                        value="{{ $user ? $user->phone_number : '' }}">

                                    @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="jabatan">Agama</label>
                                    <select name="id_agamas" required="" id="id_agamas" class="form-control">
                                        <option disabled selected>-- Select Agama --</option>
                                        @foreach($agamas as $agama)
                                        <option {{ $user->id_agamas == $agama->id ? 'selected' : '' }}
                                            value="{{ $agama->id }}">
                                            {{ $agama->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('id_agama')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="role">Divisi </label>
                                    <select name="role[]" id="roles" class="form-control select2" multiple="multiple">
                                        @foreach($user->roles as $rol)
                                        <option selected value="{{ $rol->id }}">{{ $rol->key }}</option>
                                        @endforeach
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->key }}</option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="id_jabatans" id="jabatan" class="form-control">
                                        <option disabled selected>-- Select Jabatan --</option>
                                        @foreach($jabatans as $jabatan)
                                        <option {{ $user->id_jabatans == $jabatan->id ? 'selected' : '' }}
                                            value="{{ $jabatan->id }}">
                                            {{ $jabatan->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('id_jabatan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label class="form-control-label" for="jk">Jenis
                                        Kelamin<span class="small text-danger">*</span>
                                    </label>
                                    <select id="jk" class="form-control" name="jk">
                                        <option value="M">Pria</option>
                                        <option value="F">Wanita</option>
                                    </select>

                                    @error('jk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label class="form-control-label" for="tgl_lahir">Tanggal
                                        Lahir<span class="small text-danger">*</span>
                                    </label>
                                    <input type="text" id="tgl_lahir" class="form-control datepicker" name="tgl_lahir"
                                        placeholder="Tanggal Lahir" required="" value="{{old('tgl_lahir')}}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>

                                    @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="jabatan">Status Pribadi</label>
                                    <select name="id_pernikahan" required="" id="id_pernikahan" class="form-control">
                                        <option disabled selected>-- Select Pribadi --</option>
                                        @foreach($perkawinans as $perkawinan)
                                        <option {{ $user->id_pernikahan == $perkawinan->id ? 'selected' : '' }}
                                            value="{{ $perkawinan->id }}">
                                            {{ $perkawinan->nama }}</option>
                                        @endforeach
                                    </select>

                                    @error('id_pernikahan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="perusahaan">Perusahaan</label>
                                    <select name="id_perusahaan" id="perusahaan" class="form-control input-lg dynamic"
                                        data-dependent="nama_project">
                                        <option disabled selected>-- Select Perusahaan --</option>
                                        @foreach($perusahaans as $perusahaan)
                                        <option {{ $user->id_perusahaan == $perusahaan->id ? 'selected' : '' }}
                                            value="{{ $perusahaan->id }}">
                                            {{ $perusahaan->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>

                                    @error('id_jabatan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" required=""
                                        class="form-control">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="image">Image Profile</label><br>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                            </li>
                        </ul>
                    </div>


                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>

                                <div class="form-group">
                                    <label for="tanggal">Tanggal Masuk<span style="color: red">*</span></label>
                                    <input type="datetime-local" name="created_at" id="created_at"
                                        value="{{Carbon\Carbon::parse( $user ? $user->created_at : '')->format('Y-m-d').'T'.Carbon\Carbon::parse($user ? $user->created_at : '')->format('H:i:s')}}"
                                        class=" form-control">
                                    @error('tanggal')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </li>
                        </ul>
                    </div>


                    <div class="col-sm-6 col-sg-4 m-b-4">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" rows="4"
                                        class="form-control">{{ $user->address }}</textarea>

                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-10 offset-sm-20">
                        <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i>
                            Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </html>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dynamic').change(function () {
                var id = $(this).val();
                var div = $(this).parent();
                var op = "";
                $.ajax({
                    url: `/hrd/where/project`,
                    method: "get",
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].nama_project + '">' + data[i]
                                .nama_project + '</option>'
                        };
                        $('.root1').html(op);
                    },
                    error: function () {

                    }
                })
            })
        })

    </script>
