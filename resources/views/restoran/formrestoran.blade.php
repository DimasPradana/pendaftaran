@extends('layouts.index')
@section('content')

    <div class="section">
        <h4>Pajak Restoran</h4>
    </div>

    <div class="section">
        <form action="{{URL('FormController/insertRestoran')}}" method="POST">
            {{  csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
{{--                    <input readonly value="{{$ambildatanpwpds->NPWPD}} "id="npwpd" type="text" class="validate" name="NPWPD">--}}
                    <input  id="npwpd" type="text" class="validate" name="NPWPD">
                    <label for="disabled">NPWPD</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
{{--                    <input readonly value="{{$ambildatanpwpds->NamaWP}}" id="namawp" type="text" class="validate" name="NamaWP">--}}
                    <input readonly id="namawp" type="text" class="validate" name="NamaWP">
                    <label for="disabled">Nama</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
{{--                    <input readonly value="{{$ambildatanpwpds->AlamatWP}}" id="alamatwp" type="text" class="validate" name="AlamatWP">--}}
                    <input readonly id="alamatwp" type="text" class="validate" name="AlamatWP">
                    <label for="disabled">Alamat</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                  {{--<input readonly value="{{$ambildatanpwpds->ContactPerson}}" id="nohp" type="text" class="validate" name="nohp">--}}
                  {{--<label for="skpd">Nomor Handphone</label>--}}
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
                    <label for="obyekpajak" id="lblOP">Obyek Pajak</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                  <input placeholder="Nama OPD / Kecamatan / Desa" id="skpd" type="text" class="validate autofill" name="skpd">
                    <div id="namaskpd" name="namaskpd"></div>
                  <label for="skpd">Wajib Pajak</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="Kegiatan atau keterangan Pajak" id="kegiatan" type="text" data-position="top" class="validate autofill tooltip" name="kegiatan" data-tooltip="Jangan lupa memasukkan tanggal kegiatan">
                    <label for="kegiatan">Uraian</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="jumlahpajak" type="text"  data-position="top" class="validate autofill tooltip" data-length="15" data-position="right"  name="jumlahpajak" data-tooltip="tekan tab 2x untuk generate keterangan pajak, lalu tekan submit 😉 ">
                    <label for="jumlahpajak">Pagu</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <textarea readonly id="resume" name="resume" class="materialize-textarea"></textarea>
                    <button class="btn waves-effect waves-light modal-trigger teal white-text" href="#modal1">Confirm
                        <i class="material-icons right">check</i>
                    </button>
                </div>
            </div>

            {{--modal--}}
            <div class="modal" id="modal1">
                <div class="modal-content">
                    Informasikan nomor tersebut pada petugas pajak di kantor BPPKAD melalui WhatsApp :
                    <ul>
                        <li>- Rizal  : xxxxxxxxxxxxx</li>
                        <li>- Titien : xxxxxxxxxxxxx</li>
                        <li>- Susi   : xxxxxxxxxxxxx</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                    <button class="btn-small waves-effect waves-light teal white-text" type="submit" name="submit">Submit
                        <i class="material-icons right">done_all</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

        <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('public/js/jquery.mask.js')}}"></script>
        <script>
            // untuk jquery
           $(document).ready(function(){

               // popup select option
               $('#obyekpajak').formSelect();
               $('.tooltip').tooltip();
               $('#modal1').modal();

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

               // ambil data npwpd
               $('#npwpd').keyup(function(){
                  var querynpwpd = $(this).val();
                  if(querynpwpd != ''){
                      var _token = $('input[name="_token"]').val();
                      $.ajax({
                          url: "{{route('autocomplete.fetchnpwpd')}}",
                          method:"POST",
                          data:{querynpwpd:querynpwpd, _token:_token},
                          success:function (data) {
                              // $('#namawp').html(data);
                              // $('#alamatwp').html(data);
                              // console.log(data);
                              var _data = data.split(";",3);
                              // console.log(_data[1]);
                              $('#namawp').val(_data[0]);
                              $('#alamatwp').val(_data[1]);
                              $('#nohp').val(_data[2]);
                          }
                      });
                  }
               });

           });


            $(document).on('click','li', function () {
                $('#skpd').val($(this).text());
                $('#namaskpd').fadeOut();
            });

            // autofill textarea
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
                var resume = obyekpajak + ' \"' + kegiatan + ' \(' + skpd + '\)\" sebesar Rp.' + jumlahpajak + ',- x 10%';

                $('#resume').val(resume);
                $('#resume').trigger('autoresize');
            });

            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert('Nomor tiket pendaftaranmu adalah : '+ msg);
            }

            $('#jumlahpajak').mask('000.000.000.000.000', {reverse:true});
            $('#nohp').mask('0000-0000-0000', {reverse:true});

        </script>
@endsection
