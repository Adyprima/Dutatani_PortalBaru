@extends('admin.layouts.admin_base')

@section('content')
<div class="row">
    <div class="col-lg-6">
    <h2>Daftar Petani</h2>
</div>
<div class="col-lg-6">
    {{-- <nav class="navbar navbar-light bg-light" style="margin-left: 180px;">
      <form class="form-inline" method="GET" action="{{url('/cari/lahan/')}}">
        <input class="form-control mr-sm-2" type="search" placeholder="Nama Petani" aria-label="Search" name="cari" value="{{ old('cari') }}">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 5px;">Cari</button>
        
      </form>
    </nav> --}}
    {{-- <form class="form" method="get" action="{{ url('search') }}">
    <div class="form-group w-100 mb-3">
        <label for="search" class="d-block mr-2">Pencarian</label>
        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
        <button type="submit" class="btn btn-primary mb-1">Cari</button>
    </div>
</form> --}}
</div>
<br>
    <div style="overflow-x:auto;">
      <table class="table">
          <thead class="bg-success">
              <tr>
                  <th scope="col">USER ID</th>                    
                  <th scope="col">NAMA</th>
                  <th scope="col">JUMLAH LAHAN</th>
                  <th scope="col">JUMLAH LAHAN TERCATAT</th>
                  <th scope="col">JUMLAH LAHAN YANG BISA DITAMBAHKAN</th>
                  <th scope="col">ACTION</th>
              </tr>
          </thead>
          <tbody>
            @foreach($daftar as $petani)
                        <tr>    
                        {{-- <td scope="row">
                            {{ ++$i }}
                        </td> --}}
                            <td scope="row">{{$petani->ID_User}}</td>
                            <td scope="row">{{$petani->Nama_Petani}}</td>
                            <td scope="row">{{$petani->jml_lahan}}</td>
                            <td scope="row">{{$petani->jmlh_tercatat}}</td>
                            <td scope="row">{{$petani->jmlh_tersisa}}</td>
                            {{-- <td scope='row'><a class='btn btn-block btn-info' title='Detail' href='/detail_lahan/{{$petani->ID_User}}'    
                              style='margin-left: 1px; margin-top: 1px;'>Detail</a></td> --}}
                            <?php
                            if($petani->jmlh_tersisa <= 0){
                            echo "<td scope='row'><a class='btn btn-block btn-info' title='Detail' href='/detail_lahan/$petani->ID_User'    
                            style='margin-left: 1px; margin-top: 1px;'>Detail</a></td>";        
                          }else{
                            echo "<td scope='row'>
                            <a class='btn btn-block btn-info' title='Detail' href='/detail_lahan/$petani->ID_User'    
                            style='margin-left: 1px; margin-top: 1px;'>Detail</a>
                            <a class='btn btn-block btn-success' title='Tambah Lahan' href='/admin/tambah_lahan/$petani->ID_User'    
                            style='margin-left: 1px; margin-top: 1px;'>Tambah Lahan</a>
                            </td>";
                           
                        }?>
                      </tr>
          @endforeach
      </tbody>
      </table>
      {{-- <div class="d-flex justify-content-center">
        {{$daftar->links("pagination::bootstrap-4")}}    
    </div> --}}
  </div>
</div>

    
            
    @endsection
