@extends('admin.layouts.admin_base')

@section('content')
<div class="col-lg-12">
  <div class="container">
    <div class="card card-green">
      <div class="card-header">
        <h3 class="card-title">Ubah Titik Pertanian</h3>
      </div>
  <div class="form-group">
    <form method="POST" action="/ubah_titik" class="mb-5">
      <div class="card-body">
        {{ csrf_field() }}
      
        <label for="nama_petani" class="form-label">id_detail</label>
        <input type="text" class="form-control" id="id_detail" name="id_detail" value={{$data_titik[0]->id_detail}}
        required readonly>
        <label for="nama_petani" class="form-label">ID_Lahan</label>
        <input type="text" class="form-control" id="id_lahan" name="id_lahan" value={{$data_titik[0]->id_lahan}}
        required readonly>
        <label for="nama_petani" class="form-label">Indeks</label>
        <input type="text" class="form-control" id="indeks" name="indeks" value={{$data_titik[0]->indeks}}
        required readonly>
        {{-- <input type="hidden" value={{$data_titik[0]->id_detail}} name="id_detail" id="id_detail">
        <input type="hidden" value={{$data_titik[0]->id_lahan}} name="id_lahan" id="id_lahan">
        <input type="hidden" value={{$data_titik[0]->indeks}} name="indeks" id="indeks"> --}}
        

      <h3 class="mt-3">Koordinat</h3>
      <div class="mb-3">
        <table>
          <td><label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" 
            required readonly></td>
            <td class="p-3"><label for="longitude" class="form-label">Longitude</label>
              <input type="text" class="form-control" id="longitude" name="longitude" 
              required readonly></td>
        
      </div>
    </table>
      <div class="mb-3">
        <div id="myMap"style="height: 400px"></div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Ubah</button>
    <a href="{{ url()->previous() }}" class="btn btn-lg btn-success btn-sm">Kembali</a> 
    </div>
    </form>
  </div>
</div>
  </div>
</div>
@push('custom-script')
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