@extends('admin.layouts.admin_base')

@section('content')


    <div class="container mt-2">
        <h1>Peta Persebaran Lahan Pertanian</h1>
        <div id="map"style="height: 400px"></div>
    </div>

    <script type='text/javascript' 
   src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' 
   async defer>
 </script>
    
 <script type='text/javascript'>
    var map;
    // var locations = [
    // @foreach ($peta as $petas)
    //     [ {{ $petas->Koordinat_X }} ][{{ $petas->Koordinat_Y }}]     
    // @endforeach
    
    // ];

    // console.log({!! json_encode($peta[0]->Koordinat_X) !!})

    var test = {!! json_encode($peta) !!}

    // for(var i = 0; i < test.length; i++){
    //         console.log(test[i])
    //     }

    function GetMap() {
        // Seting Map Options 
  map = new Microsoft.Maps.Map('#map', {
            credentials:"AjXKMCtulq4nJHNAOduup_pZA-263SCe3nZPT9kOGv0maVrYwYTlSc7Uk6LOUgv4",
            //mapTypeId: Microsoft.Maps.MapTypeId.road,
            center: new Microsoft.Maps.Location(test[0]['Koordinat_X'],test[0]['Koordinat_Y']),
            zoom: 16.5
  //  center: new Microsoft.Maps.Location(-7.92848867, 110.30111726)
        }); 
        // var center = map.getCenter();
        var pin = new Microsoft.Maps.EntityCollection();

        for(var i = 0; i < test.length; i++){
            //console.log(test[i]['Koordinat_X'],test[i]['Koordinat_Y'])
            pin.push(new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(test[i]['Koordinat_X'], test[i]['Koordinat_Y'])));
        }
        console.log(pin);
        map.entities.push(pin);
        
    }

    </script>

  

 <div class="container mt-2">
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              
                <h3>{{$lahan}}</h3>

                <p>Jumlah Lahan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$petani}}</h3>

                <p>jumlah Petani</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$keltani}}</h3>

                <p>Jumlah Kelompok Tani</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          </div>
            
    @endsection
