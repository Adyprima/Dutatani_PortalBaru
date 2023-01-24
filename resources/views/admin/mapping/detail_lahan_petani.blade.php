@extends('admin.layouts.admin_base')
@section('content')

    <div class="container mt-2">
        {{-- <a class="btn btn-block btn-success" title="Detail" href="/detail_lahan/{{$daftar[0]->ID_User}}"    
            style="margin-left: 1px; margin-top: 1px;">Detail</a> --}}
            
            <h1>Detail Peta Lahan</h1>
            <a href="{{ url('detail_lahan/'.$detail_lahan[0]->ID_User) }}" class="btn btn-lg btn-success btn-sm">Kembali</a>
        <h4>Keterangan Lahan Milik : {{ $detail_lahan[0]->Nama_Petani }}</h4>
        <p>Lahan ini termasuk lahan dalam daerah kelompok tani {{ $detail_lahan[0]->Nama_Kelompok_Tani }}</p>
    </div>
    <div class="container mt-2">
        <h2>Data Lahan Petani</h2>
    </div>
    <br>
    <div style="overflow-x:auto;">
        <table class="table">
            <thead class="bg-success">
                <tr>
                    <th scope="col">ID LAHAN</th>
                    <th scope="col">LUAS LAHAN</th>
                    <th scope="col">JENIS LAHAN</th>
                    <th scope="col">Desa / Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Status Keorganikan</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_lahan as $petani)
                    <tr>
                        <td scope="row">{{ $petani->ID_Lahan }}</td>
                        <td scope="row">{{ $petani->luas_lahan }}</td>
                        <td scope="row">{{ $petani->jenis_lahan }}</td>
                        <td scope="row">{{ $petani->Desa }}</td>
                        <td scope="row">{{ $petani->Kecamatan }}</td>
                        <td scope="row">{{ $petani->Kabupaten }}</td>
                        <td scope="row">{{ $petani->Provinsi }}</td>
                        <td scope="row">{{ $petani->status_organik }}</td>
                        <td scope="row">
                            <a class="btn btn-block btn-info" title="Detail" href="/detail_titik/{{$petani->ID_Lahan}}"    
                            style="margin-left: 1px; margin-top: 1px;">Detail Titik</a>
                            <a class="btn btn-block btn-success" title="Detail" href="/admin/tambah_titik/{{$petani->ID_Lahan}}"    
                            style="margin-left: 1px; margin-top: 1px;">Tambah titik</a></td>     
                    </tr>
                @endforeach
            </tbody>

        </table>
    <div class="container mt-2">
        <h2>Mapping Dutatani</h2>
        
        <div id="myMap"style="height: 400px"></div>
    </div>


    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
    </head>

    <body>

    </body>

    <script type='text/javascript'>
        var test = {!! json_encode($detail_lahan) !!}
        console.log(test);

        function GetMap() {
            var map = new Microsoft.Maps.Map('#myMap', {
                credentials: 'AjXKMCtulq4nJHNAOduup_pZA-263SCe3nZPT9kOGv0maVrYwYTlSc7Uk6LOUgv4',
                mapTypeId: Microsoft.Maps.MapTypeId.road,
                center: new Microsoft.Maps.Location(test[0]['lat'],test[0]['longt']),
                zoom: 18
            });
            
            var pin = new Microsoft.Maps.EntityCollection();
            //var exteriorRing = [];

            for (var i = 0; i < test.length; i++) {
              pin.push(new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(test[i]['lat'],test[i]['longt'])));
            }
            console.log(pin);
        map.entities.push(pin);

            //Create a polygon
            // var polygon = new Microsoft.Maps.Polygon(exteriorRing, {
            //     fillColor: 'rgba(0, 255, 0, 0.5)',
            //     strokeColor: 'red',
            //     strokeThickness: 2
            // });

            // //Add the polygon to map
            // map.entities.push(polygon);
        }
    </script>
    
    @endsection
