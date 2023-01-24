  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-green elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('admin/approval')}}" class="brand-link">
      <img src="{{asset('/lte3/dist/img/logoukdw.jpg') }}" alt="logo ukdw" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" ><b>DUTA</b> Tani</span> 
      <!-- <span class="logo-lg"><b>DUTA</b> Tani</span>  -->

    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/lte3/dist/img/icon-admin.png') }}" class="img-circle elevation-2" alt="User Image" style="background-color: white">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Session::get('ID_User')}}</a>
          <!-- <p>{{Session::get('ID_User')}}</p> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
          <li class="nav-item">
            <a href="{{url('admin/approval')}}" class="nav-link">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Approval
                
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{url('admin/pertanyaan/')}}" class="nav-link">
              <i class="nav-icon fas fa-question-circle "></i>
              <p>
                Pertanyaan
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/pengajar/')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengajar
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/kategori/')}}" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Kategori
                
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-align-justify"></i>
              <p>
                Learning
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
            <a href="{{url('admin/pertanyaan/')}}" class="nav-link">
              <i class="nav-icon fas fa-question-circle "></i>
              <p>
                Pertanyaan
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/pengajar/')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengajar
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/kategori/')}}" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Kategori
                
              </p>
            </a>
          </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-align-justify"></i>
              <p>
                Data Petani
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
            <a href="{{url('admin/wilayah/show')}}" class="nav-link">
              <i class="nav-icon fa fa-map-marker "></i>
              <p>
                Pendataan Wilayah
                
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="{{url('admin/daftar/petani/')}}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Pendataan
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/daftar/petani/semua')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Lihat Data
                
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{url('admin/kategori/')}}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Pendataan Kelompok Tani
                
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="{{url('admin/kategori/')}}" class="nav-link">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                Struktur Organisasi
                
              </p>
            </a>
          </li> -->
          <!--  <li class="nav-item">
            <a href="{{url('admin/kategori/')}}" class="nav-link">
              <i class="nav-icon fa fa-user-circle-o"></i>
              <p>
                Keanggotaan Petani
                
              </p>
            </a>
          </li> -->
            </ul>
          </li>


         <!--  <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Data Petani
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/wilayah/')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendataan Wilayah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendataan Petani</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendataan Kelompok Tani</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Struktur Organisasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keanggotaan Petani</p>
                </a>
              </li>
            </ul>
          </li> -->
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-align-justify"></i>
              <p>
                Landing Page
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('admin/berita/')}}" class="nav-link">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/slide/')}}" class="nav-link">
              <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                Slideshow
              </p>
            </a>
          </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-align-justify"></i>
              <p>
                Mapping
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('admin/mapping')}}" class="nav-link">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/daftar_petani')}}" class="nav-link">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                Daftar Petani
              </p>
            </a>
          </li>
        
            </ul>
          </li>
         
       
  

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
