<div class="row">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">

                <div class="form-group">
                    <label for="jam_masuk">Jam Masuk</label>  
                    <input type="time" autofocus class="form-control" name="jam_masuk" id="jam_masuk"
                    value="{{ Carbon\Carbon::parse($jam->jam_masuk ?? old('jam_masuk'))->format('h:i') }}">
                </div>
                <div class="form-group">
                    <label for="jam_pulang">Nama</label>
                    <input type="time" autofocus class="form-control" name="jam_pulang" id="jam_pulang"
                    value="{{ Carbon\Carbon::parse($jam->jam_pulang ?? old('jam_pulang'))->format('h:i') }}">
                </div>

                <div class="form-group">
                    <div class="col-sm-1 offset-sm-0">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
