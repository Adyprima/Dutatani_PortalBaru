@extends('admin.layouts.admin_base')
@section('content')

    <div class="container mt-2">
        <h2>Detail Titik</h2>
        <a href="{{ url('detail_lahan_petani/'.$detail_lahan[0]->ID_Lahan) }}" class="btn btn-lg btn-success btn-sm">Kembali</a>
        <h4>Keterangan  Detail Titik Lahan Milik : {{ $detail_lahan[0]->Nama_Petani }}</h4>
        <p>Lahan ini termasuk lahan dalam daerah kelompok tani {{ $detail_lahan[0]->Nama_Kelompok_Tani }}</p>
    </div>

    <div class="container mt-2">
        <h2>Mapping Dutatani</h2>
        <div id="myMap"style="height: 400px"></div>
    </div>


    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
    </head>

    <body>

    </body>

    <script type='text/javascript'>
        var test = {!! json_encode($titik) !!}
        var jumlah = {!! json_encode($detail_lahan) !!}
        console.log(test);

        function GetMap() {
            
            var map = new Microsoft.Maps.Map('#myMap', {
                credentials: 'AjXKMCtulq4nJHNAOduup_pZA-263SCe3nZPT9kOGv0maVrYwYTlSc7Uk6LOUgv4',
                mapTypeId: Microsoft.Maps.MapTypeId.road,
                //center: new Microsoft.Maps.Location(test[0]['Koordinat_X'],test[0]['Koordinat_Y']),
                center:new Microsoft.Maps.Location(jumlah[0]['lat'],jumlah[0]['longt']),
                zoom: 18
            });
            
            // for (var i = 0; i < test.length; i++) {
            // pin.push(new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(test[0]['lat'],test[0]['longt'])));
            // console.log(pin);
            // map.entities.push(pin);
            // }
            // if( count($test) == 0){
            //     var pin = new Microsoft.Maps.EntityCollection();
            //     pin.push(new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(test[0]['Koordinat_X'],test[0]['Koordinat_Y'])));
            //     console.log(pin);
            //     map.entities.push(pin);
            // }else{
            
            var exteriorRing = [];
            var pin = new Microsoft.Maps.EntityCollection();
            for (var i = 0; i < test.length; i++) {
            //exteriorRing.push(new Microsoft.Maps.Location(test[i]['Koordinat_X'],test[i]['Koordinat_Y']));
            exteriorRing.push(new Microsoft.Maps.Location(test[i]['lat'],test[i]['longt']));
            pin.push(new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(test[i]['lat'],test[i]['longt'])));
            console.log(pin);
            }

            //Create a polygon
            var polygon = new Microsoft.Maps.Polygon(exteriorRing, {
            fillColor: 'rgba(0, 255, 0, 0.5)',
            strokeColor: 'red',
            strokeThickness: 2
            });

            //Add the polygon to map
            map.entities.push(polygon);
            map.entities.push(pin);
            }
    </script>
    <div class="container mt-2">
        <h2>Data Lahan Petani</h2>
        {{-- <a class="btn btn-block btn-success" title="Detail" href="/admin/tambah_titik/{{$nama_lahan->ID_Lahan}}"    
            style="margin-left: 1px; margin-top: 1px;">Tambah titik</a> --}}
    </div>
    <br>
    <div style="overflow-x:auto;">
        <table class="table">
            <thead class="bg-success">
                <tr>
                    <th scope="col">ID TITIK</th>
                    <th scope="col">LAT</th>
                    <th scope="col">LONG</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($titik as $petani)
                    <tr>
                        <td scope="row">{{ $petani->id_detail }}</td>
                        {{-- <td scope="row">{{ $petani->Koordinat_X }}</td>
                        <td scope="row">{{ $petani->Koordinat_Y }}</td> --}}
                        <td scope="row">{{ $petani->lat }}</td>
                        <td scope="row">{{ $petani->longt }}</td>
                        <td scope="row"><a class="btn btn-block btn-warning" title="Detail" href="/admin/ubah_titik/{{$petani->id_detail}}"    
                            style="margin-left: 1px; margin-top: 1px;">Ubah</a> 
                        <a class="btn btn-block btn-danger" title="Detail" onclick="return confirm('Anda Yakin Ingin Menghapus Lahan {{$petani->id_detail}}?');" href="{{url('hapus')}}/{{$petani->id_detail}}"    
                            style="margin-left: 1px; margin-top: 1px;">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    
    @endsection
