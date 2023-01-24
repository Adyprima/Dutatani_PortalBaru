@extends('admin.layouts.admin_base')

@section('content')
<div class="col-lg-12">
  <div class="container">
    <div class="card card-green">
      <div class="card-header">
        <h3 class="card-title">Tambah Titik Pertanian</h3>
      </div>
  <div class="form-group">
    <form method="POST" action="/tambah_titik" class="mb-5">
      <div class="card-body">
        {{ csrf_field() }}
      
      <h3 class="mt-3">Koordinat</h3>
      <div class="mb-3"> </div>

      <div class="mb-3">
        
        <input type="hidden" value={{$id_lahan}} name="id_lahan" id="id_lahan">
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
    <button type="submit" class="btn btn-primary">Simpan</button>
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
    var jumlah = {!! json_encode($detail_lahan) !!}
    function GetMap() 
    {

        var bingkey="AjXKMCtulq4nJHNAOduup_pZA-263SCe3nZPT9kOGv0maVrYwYTlSc7Uk6LOUgv4";

        var loc=new Microsoft.Maps.Location(jumlah[0]['lat'],jumlah[0]['longt'])
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