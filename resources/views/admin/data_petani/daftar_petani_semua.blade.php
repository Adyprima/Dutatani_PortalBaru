@extends('admin.layouts.admin_base')
@section('content')
    <div class="row">
        
    
    <div class="col-lg-6">
       <h1 class="m-0 text-dark">Daftar Petani</h1> 
    </div>
    <div class="col-lg-6">
        <nav class="navbar navbar-light bg-light" style="margin-left: 180px;">
          <form class="form-inline" method="GET" action="{{url('/cari/lahan/')}}">
            <input class="form-control mr-sm-2" type="search" placeholder="Nama Petani" aria-label="Search" name="cari" value="{{ old('cari') }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 5px;">Cari</button>
            <a href="{{url('admin/daftar/petani/semua')}}" class="btn btn-outline-warning my-2 my-sm-0">Reset</a>
          </form>
        </nav>
    </div>
    </div>
    <br>

    <div style="overflow-x:auto;">
        <table class="table">
            <thead class="bg-success">
                <tr>
                <!-- <th scope="col">ID  </th> -->                    
                    <th scope="col">No</th>
                    <th scope="col">Nama Petani</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kabupaten</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Desa / Kelurahan</th>
                    <th scope="col">Aksi</th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach($daftar as $petani)
                            <tr>    
                            <td scope="row">
                                {{ ++$i }}
                            </td>

                                <td scope="row">{{$petani->Nama_Petani}}</td>

                                <td scope="row">{{$petani->Kecamatan}}</td>

                                <td scope="row">{{$petani->Kabupaten}}</td>

                                <td scope="row">{{$petani->Provinsi}}</td>

                                <td scope="row">{{$petani->Desa_Kelurahan}}</td>

                                <td scope="row">
                                    
                                        
                                          <a class="btn btn-s btn-info btn-sm" href="{{url('cetak')}}/{{$petani->ID_User}}" title="Cetak Kartu" target="_blank" style="margin-left: 1px; margin-top: 1px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
</svg></a>
                                           <a class="btn btn-s btn-primary btn-sm" title="Detail" href="/detail/{{$petani->ID_User}}"

                                            
                                            
                                            style="margin-left: 1px; margin-top: 1px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
</svg></a>
                                           <a class="btn btn-s btn-warning btn-sm" title="Ubah" href="/ubah/{{$petani->ID_User}}" style="margin-left: 1px; margin-top: 1px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a><br>
                                           <a class="btn btn-s btn-danger btn-sm" title="Hapus" href="{{url('hapus')}}/{{$petani->ID_User}}" style="margin-left: 1px; margin-top: 1px;" onclick="return confirm('Anda Yakin?');" arial-label="Hapus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></a>
                                           
                                          
                                            
                                        
                                      
                                    </td>
                                     
                                </td>
                            </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{$daftar->links("pagination::bootstrap-4")}}
            
        </div>
    </div>
@endsection
