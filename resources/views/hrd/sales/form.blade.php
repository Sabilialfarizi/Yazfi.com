<div class="row justify-content-left text-left">
    <div class="col-md-12">
        <div class="card shadow" id="card">
            <div class="card-body">

                
                <div class="form-group">
                    <label for="id_manager">Nama Manager Marketing</label>
                    <select name="id_manager" required="" id="id_manager" class="form-control">
                        <option disabled selected>-- Select Nama Manager Marketing --</option>
                        @foreach($manager_marketing as $manager_marketings)
                        
                        <option 
                            value="{{ $manager_marketings->id }}">{{ $manager_marketings->name }}</option>
                            @endforeach
                        </select>

                    @error('id_manager')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_spv">Nama Spv</label>
                    <select name="id_spv" id="id_spv" class="form-control">
                        <option disabled selected>-- Select Nama SPV --</option>
                        @foreach($spv as $spvs)

                        <option value="{{ $spvs->id }}">
                            {{ $spvs->name }}</option>
                        @endforeach
                    </select>

                    @error('id_jabatan')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_sales">Nama Sales </label>
                    <select name="id_sales[]" id="id_sales"  class="form-control select2" multiple="multiple">
                        {{-- @foreach($sale->user as $rol)
                                <option selected value="{{ $rol->id_sales }}">{{ $rol->name }}</option>
                        @endforeach --}}
                        @foreach($staff_marketing as $staff)
                        <option  value="{{ $staff->id }}">
                            {{ $staff->name }}</option>
                        @endforeach
                    </select>

                    @error('id_sales')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                
                
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save</button>
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
