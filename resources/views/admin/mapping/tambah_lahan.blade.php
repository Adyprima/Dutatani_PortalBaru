@extends('admin.layouts.admin_base')

@section('content')
<div class="col-lg-12">
  <div class="container">
    <div class="card card-green">
      <div class="card-header">
        <h3 class="card-title">Tambah Lahan Pertanian</h3>
      </div>
  <div class="form-group">
    <form method="POST" action="/tambah_lahan" class="mb-5">
      <div class="card-body">
        {{ csrf_field() }}
        <h3 class="mb-3">Data Lahan</h3>
      <div class="mb-3">
        <label for="nama_petani" class="form-label">Nama Petani</label>
        <input type="text" class="form-control" id="nama_petani" name="nama_petani" value={{$nama_petani[0]->Nama_Petani}}
         readonly>
        <input type="hidden" value="milik" name="status_lahan" id="status_lahan">
        <input type="hidden" value={{$id_user}} name="id_user" id="id_user">
      </div>
      <div class="mb-3">
        <label for="kelompok_tani" class="form-label">Kelompok Tani</label>
        <div class="form-group">
          <select name="kelompok_tani" id="kelompok_tani"  class="form-control" placeholder="kelompok tani">
            <option value=''>--Kelompok Tani--</option>
            @foreach ($kelompok_tani as $keltani)
          <option value="{{ $keltani->id }}">{{ $keltani->nama_kel_tani}}</option>    
          @endforeach
        </select>
      </div>
      </div>
      <div class="mb-3">
        <label for="nama_lahan" class="form-label">Nama Lahan</label>
        <input type="text" class="form-control" id="nama_lahan" name="nama_lahan" 
        >
      </div>
      <div class="mb-3 ">
        <label for="luas_lahan" class="form-label">Luas Lahan (dalam meter persegi/m2)</label>
        <input type="number" class="form-control w-25 " id="luas_lahan" name="luas_lahan" 
         value="0">
      </div>
      <div class="mb-3">
        <label for="jenis_lahan" class="form-label">Jenis Lahan</label>
        <div class="form-group">
          <select name="jenis_lahan" id="jenis_lahan"  class="form-control" placeholder="jenis_lahan" >
            <option value="">--Jenis Lahan--</option>
            <option value="sawah"> Sawah </option>
            <option value="tegalan"> Tegalan </option>
        </select>
      </div>
      </div>
      <div class="mb-3">
        <label for="status_organik" class="form-label">Status Organik</label>
        <div class="form-group">
          <select name="status_organik" id="status_organik" class="form-control" placeholder="status_organik" >
            <option value="">--Status Organik--</option>
            <option value="organik"> Organik </option>
            <option value="non_organik"> Non-organik </option>
        </select>
      </div>
      </div>
      <h3 class="mt-3">Alamat</h3>
      <div class="mb-3">
        <label for="provinsi" class="form-label">Provinsi</label>
        <div class="form-group">
          <select name="provinsi" id="provinsi" class="form-control" placeholder="provinsi" >
            <option value="">--Provinsi--</option>
            @foreach ($prov as $provinsi)
          <option value="{{ $provinsi->Nama_Provinsi }}">{{ $provinsi->Nama_Provinsi }}</option>    
          @endforeach
        </select>
      </div>
      </div>
      <div class="mb-3">
        <label for="kabupaten" class="form-label">Kabupaten</label>
        <div class="form-group">
          <select name="kabupaten" id="kabupaten" class="form-control" placeholder="kabupaten" >
            <option value="">--Kabupaten--</option>
        </select>
      </div>
      </div>
      <div class="mb-3">
        <label for="kecamatan" class="form-label">Kecamatan</label>
        <div class="form-group">
          <select name="kecamatan" id="kecamatan" class="form-control" placeholder="kecamatan" >
            <option value="">--Kecamatan--</option>
        </select>
      </div>
      </div>
      <div class="mb-3">
        <label for="kelurahan" class="form-label">Kelurahan</label>
        <div class="form-group">
          <select name="kelurahan" id="kelurahan" class="form-control" placeholder="kelurahan" >
            <option value="">--Kelurahan--</option>
        </select>
      </div>
      </div>
      <h3 class="mt-3">Koordinat</h3>
      <div class="mb-3">
        <table>
          <td><label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" 
             readonly></td>
            <td class="p-3"><label for="longitude" class="form-label">Longitude</label>
              <input type="text" class="form-control" id="longitude" name="longitude" 
               readonly></td>
        
      </div>
    </table>
      <div class="mb-3">
        <div id="myMap"style="height: 400px"></div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ url()->previous() }}" class="btn btn-lg btn-success btn-sm">Kembali</a>  
  </div>
    </form>
  </div>
</div>
  </div>
</div>
@push('custom-script')
<script>
   var s = document.getElementsByName('provinsi')[0];
            var value;
            s.addEventListener("change", changeOrg);
            function changeOrg() {
                value = s.options[s.selectedIndex].value;
            }
            //on page load
            changeOrg();
  $(document).ready(function() {
              $('#provinsi').on('change', function() {
              $('#kabupaten').empty();
              $('#kabupaten').append(
                                    '<option value="">--Kabupaten--</option>');
                    var prov = value;
                    var url = '{{ route('gen_kab', ':prov') }}';
                    url = url.replace(':prov', prov);
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            if (!response.length == 0) {
                                
                                $.each(response, function(key, response) {
                                    $('select[name="kabupaten"]').append(
                                        '<option value="' + response.Nama_Kabupaten +
                                        '">' +
                                        response.Nama_Kabupaten +
                                        '</option>');
                                });
                            } else if (value == 0) {
                                console.log(url);
                                $('#kabupaten').empty();
                                $('#kabupaten').append(
                                    '<option value="" >--Kabupaten--</option>');
                                $('#kode_akun').val('');
                        }
                      else {
                                
                                $('#kabupaten').empty();
                                $('#kabupaten').append(
                                    '<option value="">--Kabupaten--</option>');
                                $('#kode_akun').val('');
                            }
                      }
                    });
                });
            });
            $('document').ready(function() {
              $('#kecamatan').empty();
              $('#kecamatan').append(
                                    '<option value="">--Kecamatan--</option>');
                                    $('#provinsi').on('change', function() {
                                      $('#kecamatan').empty();
              $('#kecamatan').append(
                                    '<option value="">--Kecamatan--</option>');
                                    });
                                    $('#kabupaten').on('change', function() {
                                      $('#kecamatan').empty();
              $('#kecamatan').append(
                                    '<option value="">--Kecamatan--</option>');
                                    });
                                    
                $("#kabupaten").change(function() {
                  $('#kecamatan').empty();
              $('#kecamatan').append(
                                    '<option value="">--Kecamatan--</option>');
                    var kabupaten = $(this).children("option:selected").val();
                    var url = '{{ route('gen_kec', ':kab') }}';
                    url = url.replace(':kab', kabupaten);
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                          if (!response.length == 0) {
                                
                                $.each(response, function(key, response) {
                                    $('select[name="kecamatan"]').append(
                                        '<option value="' + response.Nama_Kecamatan +
                                        '">' +
                                        response.Nama_Kecamatan +
                                        '</option>');
                                });
                            } else if (value == 0) {
                                console.log(url);
                                $('#kecamatan').empty();
                                $('#kecamatan').append(
                                    '<option hidden value="">--Kecamatan--</option>');
                                
                        }
                      else {
                                
                                $('#kecamatan').empty();
                                $('#kecamatan').append(
                                    '<option value="">--Kecamatan--</option>');
                                
                            }
                      }
                    });
                        });
                    });
            $('document').ready(function() {
              $('#kelurahan').empty();
              $('#kelurahan').append(
                                    '<option value="">--Kelurahan--</option>');
                                    $('#provinsi').on('change', function() {
                                      $('#kelurahan').empty();
              $('#kelurahan').append(
                                    '<option value="">--Kelurahan--</option>');
                                    });
                                    $('#kabupaten').on('change', function() {
                                      $('#kelurahan').empty();
              $('#kelurahan').append(
                                    '<option value="">--Kelurahan--</option>');
                                    });
                                    $('#kecamatan').on('change', function() {
                                      $('#kelurahan').empty();
              $('#kelurahan').append(
                                    '<option value="">--Kelurahan--</option>');
                                    });
                $("#kecamatan").change(function() {
                  $('#kelurahan').empty();
              $('#kelurahan').append(
                                    '<option value="">--Kelurahan--</option>');
                    var kelurahan = $(this).children("option:selected").val();
                    var url = '{{ route('gen_kel', ':kel') }}';
                    url = url.replace(':kel', kelurahan);
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                          if (!response.length == 0) {
                                
                                $.each(response, function(key, response) {
                                    $('select[name="kelurahan"]').append(
                                        '<option value="' + response.Nama_Desa +
                                        '">' +
                                        response.Nama_Desa +
                                        '</option>');
                                });
                            } else if (value == 0) {
                                console.log(url);
                                $('#kelurahan').empty();
                                $('#kelurahan').append(
                                    '<option hidden value="">--Kelurahan--</option>');
                                
                        }
                      else {
                                
                                $('#kelurahan').empty();
                                $('#kelurahan').append(
                                    '<option value="">--Kelurahan--</option>');
                               
                            }
                      }
                    });
                        });
                    });
              
</script>
<script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
<script type='text/javascript'>
  var map,mapoptions; 
    var pinInfobox = null;
    function GetMap() 
    {

        var bingkey="AjXKMCtulq4nJHNAOduup_pZA-263SCe3nZPT9kOGv0maVrYwYTlSc7Uk6LOUgv4";

        var loc=new Microsoft.Maps.Location(-7.792378, 110.380988)
        mapOptions ={   credentials: bingkey,
                        center: loc,
                        zoom: 15.2,
                        mapTypeId: Microsoft.Maps.MapTypeId.road
                }

        map = new Microsoft.Maps.Map(document.getElementById("myMap"), mapOptions);
        Microsoft.Maps.Events.addHandler(map, 'click',getLatlng );          
    }
    function getLatlng(e) { 
        if (e.targetType == "map") {
           var point = new Microsoft.Maps.Point(e.getX(), e.getY());
           var locTemp = e.target.tryPixelToLocation(point);
           var location = new Microsoft.Maps.Location(locTemp.latitude, locTemp.longitude);

        


           var pin = new Microsoft.Maps.Pushpin(location, {'draggable': false});

             map.entities.push(pin);
             document.getElementById("latitude").value = locTemp.latitude;
             document.getElementById("longitude").value = locTemp.longitude;
             
             

        }              
       }
 
 </script>   
@endpush


                
@endsection