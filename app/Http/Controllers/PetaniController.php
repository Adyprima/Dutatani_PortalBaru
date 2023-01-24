<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PetaniController extends Controller
{

    public function autoComplete(Request $request) {
        $query = $request->get('term','');

        $products = DB::table('kabupaten')
                ->where('Nama_Kabupaten', 'LIKE', '%$query%')
                ->get();

        // $products=DB::table('name','LIKE','%'.$query.'%')->get();
        
        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->Nama_Kabupaten);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

    public function reset_password(Request $request, $id)
    {
        $id = $request->route('id');
        $user = DB::table('master_user')
                ->where('ID_User', $id)
                ->first();
        return view('admin.data_petani.reset_password', compact('user'));
    }

    public function reset(Request $request, $id)
    {
        // $Password = $request->input('Password');
        $Password = $request->Password;
        $hashpass=sha1($Password);
        $reset = DB::table('master_user')
                ->where('ID_User', $id)
                ->update(['Password'=> $hashpass]);
        if($reset){
        return back()->with('success', 'Password Berhasil Diubah');
        }else{
            echo "Gagal";
        }

    }
    public function refresh_user(Request $request, $id){
        $awal_data = DB::table('master_petani')->where('ID_User',$id)->first();
        // var_dump($awal_data);
        $ID_User_Det = $awal_data->ID_User;
        $Nama_Petani = $awal_data->Nama_Petani;
        $Alamat_Petani = $awal_data->Nama_Petani;
        $Kabupaten = $awal_data->Kabupaten;
        $Kecamatan = $awal_data->Kecamatan;
        $Provinsi = $awal_data->Provinsi;
        $Desa_Kelurahan = $awal_data->Desa_Kelurahan;

        $nama_istri = $awal_data->Nama_Petani;
        $jml_tng_kerja_musiman = $awal_data->jml_tng_kerja_musiman;
        $jml_lahan = $awal_data->jml_lahan;
        $Foto = 'asal';
        $Nomor_Telpon = $awal_data->Nomor_Telpon;

        $Pendidikan_Terakhir = $awal_data->Pendidikan_Terakhir;
        $Jumlah_Tanggungan = $awal_data->Jumlah_Tanggungan;
        $Email = $awal_data->Email;
        $Agama = $awal_data->Agama;
        $Tanggal_Lahir = $awal_data->Tanggal_Lahir;
        $Deskripsi_Keahlian = $awal_data->Deskripsi_Keahlian;
        $Status = $awal_data->Status;
        $Jenis_Kelamin = $awal_data->jns_kelamin;

        $awal_ket = DB::table('master_petani')->where('ID_User',$id)->first();
        $ID_User_Get = $awal_ket->ID_User;
        $ID_Kategori = 'PET';
     
         $maspet = array('Nama_Petani'=>$Nama_Petani, 'Email'=>$Email, 'Alamat_Petani'=>$Alamat_Petani,'Nomor_Telpon'=>$Nomor_Telpon, 'Tanggal_Lahir'=>$Tanggal_Lahir,'Pendidikan_Terakhir'=>$Pendidikan_Terakhir, 'Jumlah_Tanggungan'=>$Jumlah_Tanggungan, 'Agama'=>$Agama, 'Deskripsi_Keahlian'=>$Deskripsi_Keahlian, 'Status'=>$Status, 'nama_istri'=> $nama_istri, 'jml_tng_kerja_musiman'=>$jml_tng_kerja_musiman, 'jml_lahan'=>$jml_lahan, 'jns_kelamin'=>$Jenis_Kelamin,'Foto'=>$Foto);

         // $detail=array('ID_User'=>$ID_User_Det,'nama'=>$Nama_Petani,
         //            'tanggal_lahir'=>$Tanggal_Lahir,'alamat'=>$Alamat_Petani,'nomor_telpon'=>$Nomor_Telpon,'Email'=>$Email,'jenis_kelamin'=>$Jenis_Kelamin,'Foto'=>$Foto);

         $kat=array('ID_User'=>$ID_User_Get, 'ID_kategori'=>$ID_Kategori);

         $detail=array('ID_User'=>$ID_User_Det, 'nama'=>$Nama_Petani,'jenis_kelamin'=>$Jenis_Kelamin,
                    'tanggal_lahir'=>$Tanggal_Lahir,'provinsi'=>$Provinsi,'nomor_telpon'=>$Nomor_Telpon,'Email'=>$Email,
                    'kabupaten'=>$Kabupaten,'kecamatan'=>$Kecamatan,'kelurahan_desa'=>$Desa_Kelurahan,'Foto'=>$Foto); 

        DB::table('master_petani')->where('ID_User', $id)->update($maspet);
        DB::table('master_detail_user')->insert($detail);

        DB::table('master_user_kat')->insert($kat);
       
        return back()->with('success', 'Ubah Petani Berhasil');
        
                 
    }
    public function daftar_petani()
    {
        return view('admin.data_petani.daftar_petani');
    } 

    public function daftar_petani_semua(Request $request)
    {
        
        $pagination = 10;
        $cari = $request->cari;
        // $daftar = DB::TABLE('master_petani')->paginate($pagination);
        $daftar = DB::TABLE('master_petani')->where('Nama_Petani','like',"%".$cari."%")->paginate($pagination);


    //  $cari_petani = DB::table('master_petani')
    // ->where('Nama_Petani','like',"%".$cari."%")->paginate($pagination);


        // var_dump($daftar);
        return view('admin.data_petani.daftar_petani_semua', compact('daftar'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function detail_petani($id)
    {
        $detail_petani = DB::table('master_petani')->where('ID_User',$id)->first();
        return view('admin.data_petani.detail_petani', compact('detail_petani'));
       
    } 



    public function ubah_petani($id)
    {
        $kabupaten = DB::SELECT('SELECT * from kabupaten ORDER BY Nama_Kabupaten ASC');
        // var_dump($kabupaten);
        $provinsi = DB::SELECT("SELECT DISTINCT  Nama_Provinsi FROM kabupaten ORDER BY Nama_Provinsi ASC");
        $kecamatan = DB::SELECT('SELECT * from kecamatan ORDER BY Nama_Kecamatan ASC');
        $kelurahan_desa = DB::SELECT('SELECT DISTINCT Nama_Desa, Nama_Kecamatan, Nama_Kabupaten, Nama_Provinsi FROM kelurahan_desa  ORDER BY Nama_Desa, Nama_Kecamatan, Nama_Kabupaten, Nama_Provinsi ASC');

        $ubah_petani = DB::table('master_petani')->where('ID_User',$id)->first();
        // var_dump($ubah_petani);
        return view('admin.data_petani.ubah_petani', compact('ubah_petani','kabupaten','provinsi','kecamatan','kelurahan_desa'));
    }

    // public function ubah_petani_aksi(Request $request, $id)
    // {
    //  if($request->hasFile('Foto')){
    //         $resorce  = $request->file('Foto');
    //         $name   = $resorce->getClientOriginalName();
    //         $resorce->move(\base_path() ."/public/foto_petani", $name);

    //      $update = DB::table('master_petani')
    //           ->where('ID_User', $id)
    //           ->update(['Nama_Petani' => $request->Nama_Petani,
    //                     'Alamat_Petani' => $request->Alamat_Petani,
    //                     'Email' => $request->Email,
    //                     'Nomor_Telpon' => $request->Nomor_Telpon,
    //                     'Pendidikan_Terakhir' => $request->Pendidikan_Terakhir,
    //                     'Jumlah_Tanggungan' => $request->Jumlah_Tanggungan,
    //                     'Agama' => $request->Agama,

    //                     'Tanggal_Lahir' => $request->Tanggal_Lahir,

    //                     'Deskripsi_Keahlian' => $request->Deskripsi_Keahlian,

    //                     'Status' => $request->Status,

    //                     'nama_istri' => $request->nama_istri,
                
    //                     'jml_tng_kerja_musiman' => $request->jml_tng_kerja_musiman,

    //                     'jml_lahan' => $request->jml_lahan,
    //                     // 'Desa_Kelurahan' => $request->Nama_Desa,
    //                     // 'Kecamatan' => $request->Nama_Kecamatan,
    //                     // 'Kabupaten' => $request->Nama_Kabupaten,
    //                     // 'Provinsi' => $request->Nama_Provinsi,
    //                     'Foto' => $name
    //                     ]);
    //  // var_dump($ubah_petani);
    //           if($update){
    //              return redirect('admin/daftar/petani/semua')->with('success', 'Ubah Data Berhasil');
    //           }else{
    //              "Gagal";
    //           }
        
    //  }else{
    //      echo "Error";
    //  }
    // }

    public function ubah_petani_aksi(Request $request, $id)
    {
        $Nama_Petani = $request->input('Nama_Petani');
        $Alamat_Petani = $request->input('Alamat_Petani');
        $Email = $request->input('Email');
        $Nomor_Telpon = $request->input('Nomor_Telpon');
        $Pendidikan_Terakhir = $request->input('Pendidikan_Terakhir');
        $Jumlah_Tanggungan = $request->input('Jumlah_Tanggungan');
        $Agama = $request->input('Agama');
        $Tanggal_Lahir = $request->input('Tanggal_Lahir');
        $Deskripsi_Keahlian = $request->input('Deskripsi_Keahlian');
        $Status = $request->input('Status');

        $nama_istri = $request->input('nama_istri');
        $jml_tng_kerja_musiman = $request->input('jml_tng_kerja_musiman');
        $jml_lahan = $request->input('jml_lahan');

            
            $resorce  = $request->file('Foto');
            
            
         if(!empty($resorce))  {
            $name   = $resorce->getClientOriginalName();
            $resorce->move("foto_petani", $name);
         $maspet = array('Nama_Petani'=>$Nama_Petani, 'Email'=>$Email, 'Alamat_Petani'=>$Alamat_Petani,'Nomor_Telpon'=>$Nomor_Telpon, 'Tanggal_Lahir'=>$Tanggal_Lahir,'Pendidikan_Terakhir'=>$Pendidikan_Terakhir, 'Jumlah_Tanggungan'=>$Jumlah_Tanggungan, 'Agama'=>$Agama, 'Deskripsi_Keahlian'=>$Deskripsi_Keahlian, 'Status'=>$Status, 'nama_istri'=> $nama_istri, 'jml_tng_kerja_musiman'=>$jml_tng_kerja_musiman, 'jml_lahan'=>$jml_lahan, 'Foto'=>$name);

         $detail=array('nama'=>$Nama_Petani,
                    'tanggal_lahir'=>$Tanggal_Lahir,'alamat'=>$Alamat_Petani,'nomor_telpon'=>$Nomor_Telpon,'Email'=>$Email, 'Foto'=>$name);
        DB::table('master_petani')->where('ID_User', $id)->update($maspet);
        DB::table('master_detail_user')->where('ID_User', $id)->update($detail);
        }else{
            $maspet = array('Nama_Petani'=>$Nama_Petani, 'Email'=>$Email, 'Alamat_Petani'=>$Alamat_Petani,'Nomor_Telpon'=>$Nomor_Telpon, 'Tanggal_Lahir'=>$Tanggal_Lahir,'Pendidikan_Terakhir'=>$Pendidikan_Terakhir, 'Jumlah_Tanggungan'=>$Jumlah_Tanggungan, 'Agama'=>$Agama, 'Deskripsi_Keahlian'=>$Deskripsi_Keahlian, 'Status'=>$Status, 'nama_istri'=> $nama_istri, 'jml_tng_kerja_musiman'=>$jml_tng_kerja_musiman, 'jml_lahan'=>$jml_lahan);

         $detail=array('nama'=>$Nama_Petani,
                    'tanggal_lahir'=>$Tanggal_Lahir,'alamat'=>$Alamat_Petani,'nomor_telpon'=>$Nomor_Telpon,'Email'=>$Email);
        DB::table('master_petani')->where('ID_User', $id)->update($maspet);
        DB::table('master_detail_user')->where('ID_User', $id)->update($detail);
        //return $detail;
        }
        return redirect('admin/daftar/petani/semua')->with('success', 'Ubah Petani Berhasil');
        

        // if($request->hasFile('Foto')){
     //        $resorce  = $request->file('Foto');
     //        $name   = $resorce->getClientOriginalName();
     //        $resorce->move(\base_path() ."/public/foto_petani", $name);

        //  $update = DB::table('master_petani')
     //          ->where('ID_User', $id)
     //          ->update(['Nama_Petani' => $request->Nama_Petani,
     //                    'Alamat_Petani' => $request->Alamat_Petani,
     //                    'Email' => $request->Email,
     //                    'Nomor_Telpon' => $request->Nomor_Telpon,
     //                    'Pendidikan_Terakhir' => $request->Pendidikan_Terakhir,
     //                    'Jumlah_Tanggungan' => $request->Jumlah_Tanggungan,
     //                    'Agama' => $request->Agama,

     //                    'Tanggal_Lahir' => $request->Tanggal_Lahir,

     //                    'Deskripsi_Keahlian' => $request->Deskripsi_Keahlian,

     //                    'Status' => $request->Status,

     //                    'nama_istri' => $request->nama_istri,
                
     //                    'jml_tng_kerja_musiman' => $request->jml_tng_kerja_musiman,

     //                    'jml_lahan' => $request->jml_lahan,
     //                    // 'Desa_Kelurahan' => $request->Nama_Desa,
     //                    // 'Kecamatan' => $request->Nama_Kecamatan,
     //                    // 'Kabupaten' => $request->Nama_Kabupaten,
     //                    // 'Provinsi' => $request->Nama_Provinsi,
     //                    'Foto' => $name
     //                    ]);

     //          $master_detail_user = DB::table('master_detail_user')
     //          ->where('ID_User', $id)
     //          ->update(['nama' => $request->Nama_Petani,
     //                    'alamat' => $request->Alamat_Petani,
     //                    'Email' => $request->Email,
     //                    'nomor_telpon' => $request->Nomor_Telpon,
     //                    'tanggal_lahir' => $request->Tanggal_Lahir,
     //                    'Foto' => $name
     //                    ]);

        
             
     //         return redirect('admin/daftar/petani/semua')->with('success', 'Ubah Data Berhasil');
              
        
        // }else{
        //  echo "Error";
        // }
    }


    // public function daftar_baru_admin(Request $request){
    //     $ID_User = $request->input('ID_User'); //OK
    //     $Password = $request->input('password');
    //     $PIN = '123456'; 
    //     $jawaban = ' asal ';
    //     $Tingkat_Priv = '0';
    //     $nama = $request->input('nama');
    //     $jenis_kelamin = $request->input('jenis_kelamin');
    //     $tanggal_lahir = $request->input('tanggal_lahir');
    //     $alamat = $request->input('alamat');
    //     $provinsi= $request->input('provinsi');
    //     $kabupaten = 'asal ';
    //     $kecamatan = 'asal ';
    //     $kelurahan_desa = 'asal ';  
    //     $nomor_telpon = $request->input('nomor_telpon');
    //     $Email = $request->input('Email');
    //     $foto = 'asal';
    //     $ID_Kategori = $request->input('ID_Kategori'); //OK
    //     //$hashpass=bcrypt($Password);
    //     $hashpass=sha1($Password);

    //  $m_user=array('ID_User'=>$ID_User,'password'=>$hashpass,'jawaban'=>$jawaban,'PIN'=>$PIN,'Tingkat_Priv'=>$Tingkat_Priv);

    //     $detail=array('ID_User'=>$ID_User, 'nama'=>$nama,'jenis_kelamin'=>$jenis_kelamin,
    //                 'tanggal_lahir'=>$tanggal_lahir,'alamat'=>$alamat,'provinsi'=>$provinsi,'nomor_telpon'=>$nomor_telpon,'Email'=>$Email,
    //                 'kabupaten'=>$kabupaten,'kecamatan'=>$kecamatan,'kelurahan_desa'=>$kelurahan_desa,'foto'=>$foto);

    //     $maspet = array('ID_User'=>$ID_User, 'Nama_Petani'=>$nama, 'Email'=>$Email, 'Alamat_Petani'=>$alamat, 'Provinsi'=>$provinsi, 'Nomor_Telpon'=>$nomor_telpon, 'Tanggal_Lahir'=>$tanggal_lahir, 'jns_kelamin'=>$jenis_kelamin);
                    
    //     $kat=array('ID_User'=>$ID_User, 'ID_kategori'=>$ID_Kategori); 

    //     $count =DB::table('master_user')->where('ID_User', $ID_User)->count();
        
    //     if($count > 0){
    //         return redirect('/register')->with('alert','Maaf Username ànda telah digunakan ');
    //     }else{
        
                  
    //                 DB::table('master_user')->insert($m_user);
    //                 DB::table('master_detail_user')->insert($detail);
    //                 DB::table('master_petani')->insert($maspet);
    //                 DB::table('master_user_kat')->insert($kat);
                   
    //                 return redirect('admin/daftar/petani')->with('success', 'Tambah Petani Berhasil');         
    //     } 
                 
    // }

    public function hapus($id)
    {
        DB::table('master_user')
            ->where('ID_User', $id)
            ->delete();

        DB::table('master_petani')
            ->where('ID_User', $id)
            ->delete();
     
        DB::table('master_detail_user')
            ->where('ID_User', $id)
            ->delete();
        
        DB::table('master_user_kat')
            ->where('ID_User', $id)
            ->delete();

            return redirect('admin/daftar/petani/semua')->with('success', 'Petani berhasil di Hapus');
    }


 //    public function cari(Request $request)
    // {
    //  // menangkap data pencarian
    //  $cari = $request->cari;
 
 //         // mengambil data dari table petani sesuai pencarian data
    //  $daftar = DB::table('master_petani')
    //  ->where('Nama_Petani','like',"%".$cari."%")
    //  ->paginate();
 
 //         // mengirim data petani ke view petani
    //  return view('admin.data_petani.daftar_petani_semua', compact('daftar'));
 
    // }

    public function cetak($id)
    {
        $cetak = DB::table('master_petani')->where('ID_User',$id)->first();
        // $url = "www.google.com/$cetak->ID_User";
        $url = "http://okenih.rapidserver.my.id/petani/$cetak->ID_User";
        $img = 'foto_petani/dutataniid-teks.png';
        // var_dump($url);
        $for = 'png';
        $h = 'H';



        $kel = DB::table('master_kel_tani')
                ->select('Nama_Kelompok_Tani')
                ->where('ID_User', $id)
                ->first();

        return view('admin.data_petani.cetak_kartu', compact('cetak','url','img','for','h','kel'));
    }

    public function dashboard_petani()
    {
        $materi = DB::table('master_upload_materi')
        ->join('master_detail_user', function($join){
            $join->on('master_detail_user.ID_User', '=', 'master_upload_materi.ID_User');
            })
        ->join('master_user', function($join){
            $join->on('master_user.ID_User', '=', 'master_upload_materi.ID_User');
            })
        ->count();
        $lahan = DB::table('master_peta_lahan')->count();
        $petani = DB::table('master_petani')->count();
        $berita = DB::table('master_berita_informasi')->count();
        return view('petani.dashboard_petani', compact('materi','lahan','petani','berita'));
    }

    

    public function data_diri_petani($id)
    {
        $data = DB::table('master_petani')->where('ID_User',$id)->first();
        return view('petani.data_diri', compact('data'));
    }

     
}
