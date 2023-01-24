@extends('admin.layouts.admin_base')
@section('content')
  <div class="container mt-2">
                        <h1>Peta dan Data Lahan</h1>
                   </div>

                    <div class="container mt-2">
                        <!--konten-->
                        <a href="{{url('admin/daftar_petani/')}}" class="btn btn-lg btn-success btn-sm">Kembali</a>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                             
                            
                            </div>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">Lahan Milik : {{$daftar[0]->Nama_Petani}} </li>
                              <li class="list-group-item">Jumlah Lahan : {{$daftar[0]->jml_lahan}} </li>
                              <li class="list-group-item">Jumlah Lahan Tercatat : {{$daftar[0]->jmlh_tercatat}} </li>
                              <li class="list-group-item">Jumlah Lahan yang Dapat Ditambahkan : {{$daftar[0]->jmlh_tersisa}} </li>

                            </ul>
                          </div>  
                         </div>
                         <div class="container mt-2">
                          <h2>Peta Lahan</h2>
                          <div id="myMap"style="height: 400px"></div>
                        </div>
                        
                        
                        
                        <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
                        </head>
                        <body>
  
                        </body>
                        
                        <script type='text/javascript'>
                         //var detail_lahan = {!! json_encode($detail_lahan) !!}
                         var test = {!! json_encode($kotak) !!}
                         console.log(test);
                         var titik = {!! json_encode($titik) !!}
                         console.log(test);
                          function GetMap() {
                          
                                                        var map = new Microsoft.Maps.Map('#myMap', {
                                                            credentials: 'AjXKMCtulq4nJHNAOduup_pZA-263SCe3nZPT9kOGv0maVrYwYTlSc7Uk6LOUgv4',
                                                            mapTypeId: Microsoft.Maps.MapTypeId.road,
                                                            

                                                            center: new Microsoft.Maps.Location(titik[0]['Koordinat_X'],titik[0]['Koordinat_Y']),
                                                            zoom: 16
                                                        });
                                                
                                                        var center = map.getCenter();
                                                
                                                        var exteriorRing = [];

                                                        for (var i = 0; i < test.length; i++) {
                                                          exteriorRing.push(new Microsoft.Maps.Location(test[i]['lat'],test[i]['longt']));
                                                        }

                                                          //Create a polygon
                                                          var polygon = new Microsoft.Maps.Polygon(exteriorRing, {
                                                              fillColor: 'rgba(0, 255, 0, 0.5)',
                                                              strokeColor: 'red',
                                                              strokeThickness: 2
                                                          });

                                                          //Add the polygon to map
                                                          map.entities.push(polygon);
                                                                                                      }
                        
                        </script>   
                         <div class="container mt-2">
                          <h2>Data Lahan Petani</h2>
                          {{-- <a class="btn btn-block btn-success" title="Detail" href="/admin/tambah_lahan/{{$detail_lahan[0]->id_user}}"    
                            style="margin-left: 1px; margin-top: 1px;">Tambah Lahan</a>  --}}
                            <?php
                            if($daftar[0]->jmlh_tersisa > 0){
                              echo "<td scope='row'><a class='btn btn-block btn-success' title='Tambah Lahan' href='/admin/tambah_lahan/{$daftar[0]->ID_User}'    
                            style='margin-left: 1px; margin-top: 1px;'>Tambah Lahan</a></td>";
                          }else{
                            echo "Tidak dapat menambah lahan lagi";
                          }?> 
                        </div>
                        <br>
    <div style="overflow-x:auto;">
      <table class="table">
          <thead class="bg-success">
              <tr>
                  <th scope="col">ID LAHAN</th> 
                  <th scope="col">NAMA LAHAN</th>                    
                  <th scope="col">LUAS LAHAN</th>
                  <th scope="col">JENIS LAHAN</th>
                  <th scope="col">ALAMAT</th>
                  <th scope="col">ACTION</th>
              </tr>
          </thead>
          <tbody>
            @foreach($detail_lahan as $petani)
                        <tr>    
                            <td scope="row">{{$petani->ID_Lahan}}</td>
                            <td scope="row">{{$petani->nama_lahan}}</td>
                            <td scope="row">{{$petani->luas_lahan}}</td>
                            <td scope="row">{{$petani->jenis_lahan}}</td>
                            <td scope="row">{{$petani->Desa}},{{$petani->Kecamatan}},{{$petani->Kabupaten}},{{$petani->Provinsi}}</td>
                            <td scope="row"><a class="btn btn-block btn-info" title="Detail" href="/detail_lahan_petani/{{$petani->ID_Lahan}}"    
                            style="margin-left: 1px; margin-top: 1px;">Detail</a> 
                            <a class="btn btn-block btn-warning" title="Ubah" href="/admin/ubah_lahan/{{$petani->ID_Lahan}}"    
                              style="margin-left: 1px; margin-top: 1px;">Ubah</a>
                              <a class="btn btn-block btn-danger" title="Hapus" onclick="return confirm('Anda Yakin Ingin Menghapus Lahan {{$petani->ID_Lahan}}?');" href="/hapus_lahan/{{$petani->ID_Lahan}}"    
                                style="margin-left: 1px; margin-top: 1px;">Hapus</a></td> 
                      </tr>
          @endforeach
      </tbody>
          
      </table>
                         
                            
                        
                  

                    
                          
               
@endsection