@extends('layouts.index')
@section('content')

    <div class="section">
        <h4>Pajak Restoran</h4>
    </div>

    <div class="section">

        <div class="row">
            <div class="input-field col s12">
                <input disabled value="{{$ambildatanpwpds->NamaWP}}" id="disabled" type="text" class="validate">
                <label for="disabled">Nama</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input disabled value="{{$ambildatanpwpds->AlamatWP}}" id="disabled" type="text" class="validate">
                <label for="disabled">Alamat</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <select class="select autofill" name="obyekpajak" id="obyekpajak">
                    <option value="" disabled selected>Pilih Obyek Pajak</option>
                    @foreach($ambildataobyekpajaks as $ambildataobyekpajak)
                        <option value="{{$ambildataobyekpajak->uraian}}">{{$ambildataobyekpajak->uraian}}</option>
                    @endforeach
                </select>
                {{--{{$ambildataobyekpajak->uraian}}--}}
                {{--<label id="lblOP">Obyek Pajak</label>--}}
                <label for="obyekpajak" id="lblOP">Obyek Pajak</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
              <input placeholder="Nama OPD / Kecamatan / Desa" id="skpd" type="text" class="validate autofill" name="skpd">
                <div id="namaskpd" name="namaskpd"></div>
              <label for="skpd">Nama OPD / Kecamatan / Desa</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input placeholder="Kegiatan atau keterangan Pajak" id="kegiatan" type="text" data-position="right" class="validate autofill tooltip" name="kegiatan" data-tooltip="Jangan lupa memasukkan tanggal kegiatan">
                <label for="kegiatan">Kegiatan Pajak / Keterangan Pajak</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input placeholder="Pagu Kegiatan" id="jumlahpajak" type="number" class="validate autofill" data-position="right"  name="jumlahpajak">
                <label for="jumlahpajak">Pagu Kegiatan</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <textarea disabled id="resume" name="resume" class="materialize-textarea"></textarea>
                {{--<input disabled value="Resume goes here" id="resume" name="resume" type="text" class="validate">--}}
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>

        {{csrf_field()}}
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/masknumber.js')}}"></script>
        <script>
            // untuk jquery
           $(document).ready(function(){

               // popup select option
               // $('.select').formSelect();
               $('#obyekpajak').formSelect();
               $('.tooltip').tooltip();

               // autocomplete skpd
               $('#skpd').keyup(function(){
                  var query = $(this).val();
                  if(query != ''){
                      var _token = $('input[name="_token"]').val();
                      $.ajax({
                         url:"{{route('autocomplete.fetch')}}",
                          method:"POST",
                          data:{query:query, _token:_token},
                          success:function(data){
                             $('#namaskpd').fadeIn();
                             $('#namaskpd').html(data);
                          }
                      });
                  }
               });

               // autoresize textarea
               $('#resume').val();
               M.textareaAutoResize($('#resume'));

           });

            $(document).on('click','li', function () {
                $('#skpd').val($(this).text());
                $('#namaskpd').fadeOut();
            });

            //autofill textarea
            // $('#jumlahpajak').change(function(){
            $('.autofill').focusout(function(){
                var obyekpajak = "";
                var skpd = "";
                var kegiatan = "";
                var jumlahpajak = "";
                $('#resume').val('');

                obyekpajak = $('#obyekpajak').val();
                skpd = $('#skpd').val();
                kegiatan = $('#kegiatan').val();
                jumlahpajak = $('#jumlahpajak').val();
                // alert(obyekpajak + ','  + skpd + ',' + kegiatan + ',' + jumlahpajak);
                var resume = obyekpajak + ' \"' + kegiatan + ' \(' + skpd + '\)\" sebesar Rp.' + jumlahpajak + ',- x 10%';
                $('#resume').val(resume);
            });
        </script>
@endsection
