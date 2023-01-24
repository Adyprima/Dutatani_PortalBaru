<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class GoogleController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $lahan = DB::table('master_peta_lahan')->count();
        $petani = DB::table('master_petani')->count();
        $keltani = DB::table('master_kel_tani')->count();
        $peta = DB::select("SELECT ID_Lahan, nama_lahan,Koordinat_X,Koordinat_Y from master_peta_lahan");
        return view('admin.mapping.mapping', compact('lahan', 'petani', 'keltani', 'peta'));
        //return $peta;
    }

    public function daftar_petani(Request $request)
    {
        $pagination = 10;
        $cari = $request->cari;
        //$daftar = DB::TABLE('master_petani')->where('Nama_Petani','like',"%".$cari."%")->paginate($pagination);
        //return view('admin.mapping.daftar_petani', compact('daftar'))->with('i', ($request->input('page', 1) - 1) * $pagination);
        // $daftar = DB::Select("SELECT p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, COUNT(tl.ID_Lahan), 
        // (p.jml_lahan-COUNT(tl.ID_Lahan)) from trans_lahan tl, master_petani p, 
        // trans_ang_petani t WHERE tl.ID_User = p.ID_User and p.ID_User = t.ID_User");

        // $daftar = DB::Select("Select p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, (select count(tl.ID_Lahan)  from trans_lahan tl, master_petani p, 
        // trans_ang_petani t WHERE tl.ID_User = p.ID_User and p.ID_User = t.ID_User), 
        // (select p.jml_lahan - count(tl.ID_Lahan)  from trans_lahan tl, master_petani p, 
        // trans_ang_petani t WHERE tl.ID_User = p.ID_User and p.ID_User = t.ID_User) from trans_lahan tl, master_petani p, 
        // trans_ang_petani t WHERE tl.ID_User = p.ID_User and p.ID_User = t.ID_User");
        // $str = DB::select("SELECT p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, 0 as jml_tercatat, 0 as bisa from master_petani p, 
        // trans_ang_petani t 
        // where p.ID_User NOT IN (SELECT DISTINCT ID_User from trans_lahan) and p.ID_User = t.ID_User");
        // $str2 = DB::select(" UNION
        // SELECT tl.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, COUNT(tl.ID_Lahan), 
        // (p.jml_lahan-COUNT(tl.ID_Lahan)) from trans_lahan tl, master_petani p, 
        // trans_ang_petani t WHERE tl.ID_User = p.ID_User and p.ID_User = t.ID_User");
        // $daftar =$str .= $str2." GROUP BY ID_User
        // ORDER by bisa DESC, ID_User ASC";

        $daftar = DB::Select("SELECT p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, (select count(ID_Lahan) from trans_lahan where ID_User = p.ID_User) as jmlh_tercatat, (select p.jml_lahan - count(ID_Lahan) from trans_lahan where ID_User = p.ID_User) as jmlh_tersisa from master_petani p, 
        trans_ang_petani t 
        where p.ID_User = t.ID_User");
        // $coba = DB::table('master_peta_lahan')->where('Nama_Petani','like',"%".$cari."%")->paginate($pagination);
        // $titik = DB::Select("SELECT * FROM master_peta_lahan_detail WHERE id_lahan = 'tukiso' order by indeks asc");
        //return view('admin.mapping.daftar_petani', compact('daftar'));
        return view('admin.mapping.daftar_petani', compact('daftar'));
        //return $daftar;
    }

    public function detail_lahan($id)
    {
        $daftar = DB::Select("SELECT p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, 
        (select count(ID_Lahan) from trans_lahan where ID_User = p.ID_User) as jmlh_tercatat, 
        (select p.jml_lahan - count(ID_Lahan) from trans_lahan where ID_User = p.ID_User) as jmlh_tersisa from master_petani p, 
        trans_ang_petani t 
        where p.ID_User = '$id' AND t.ID_User='$id'");
        $daftar2 = DB::Select("SELECT p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, (select count(ID_Lahan) from trans_lahan where ID_User = p.ID_User) as jmlh_tercatat, (select p.jml_lahan - count(ID_Lahan) from trans_lahan where ID_User = p.ID_User) as jmlh_tersisa from master_petani p, 
        trans_ang_petani t 
        where p.ID_User = t.ID_User");
        
        // $daftar = DB::Select("SELECT l.ID_Lahan, p.Nama_Petani, l.nama_lahan, l.Koordinat_X as lat, l.Koordinat_Y as longt, 
        // l.luas_lahan, l.jenis_lahan, l.Desa, l.Kecamatan, l.Kabupaten, l.Provinsi, l.status_organik, k.Nama_Kelompok_Tani 
        // FROM master_peta_lahan l, master_petani p, trans_lahan tl, master_kel_tani k WHERE tl.ID_Lahan = l.ID_Lahan 
        // and tl.ID_User = p.ID_User AND l.ID_Lahan = $id AND l.ID_Kelompok_Tani = k.ID_Kelompok_Tani limit 1");
        $detail_lahan = DB::select("SELECT l.*, p.Nama_Petani as nama,l.Koordinat_Y as longitude,l.Koordinat_X
        as latitude, tl.ID_User as id_user, t.Nama_Kelompok_Tani 
        FROM trans_lahan tl, master_peta_lahan l, master_petani p, master_kel_tani t 
        WHERE tl.ID_Lahan = l.ID_Lahan 
        AND tl.ID_User = '$id'
        and tl.status_aktif = 1
        AND t.ID_Kelompok_Tani = l.ID_Kelompok_Tani
        AND tl.ID_User = p.ID_User 
        AND l.ID_Lahan not in('')
        ORDER BY l.ID_Lahan");
        $kotak = DB::Select("SELECT tl.ID_Lahan, tl.ID_User, ld.* FROM trans_lahan tl, master_peta_lahan_detail ld WHERE ld.ID_Lahan = tl.ID_LAHAN 
        AND tl.ID_User = '$id'");
        $titik = DB::Select("SELECT tl.ID_Lahan, tl.ID_User, pl.Koordinat_X, pl.Koordinat_Y FROM master_peta_lahan pl ,trans_lahan tl WHERE pl.ID_Lahan = tl.ID_LAHAN AND tl.ID_User = '$id'");
    
//         $str = DB::select("SELECT p.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, 0 as jml_tercatat, 0 as bisa from master_petani p, 
// trans_ang_petani t 
// where p.ID_User NOT IN (SELECT DISTINCT ID_User from trans_lahan) and p.ID_User = t.ID_User");
// $str2 = DB::select("
// SELECT tl.ID_User as ID_User, p.Nama_Petani, p.jml_lahan, COUNT(tl.ID_Lahan), 
// (p.jml_lahan-COUNT(tl.ID_Lahan)) from trans_lahan tl, master_petani p, 
// trans_ang_petani t WHERE tl.ID_User = p.ID_User and p.ID_User = t.ID_User");
        return view('admin.mapping.detail_petani', compact('daftar','daftar2','detail_lahan','kotak','titik'));
        //return $str;
    }

    
    public function detail_lahan_petani($id)
    {

        // $detail_lahan = DB::select("SELECT l.*, p.Nama_Petani as nama,l.Koordinat_Y as longitude,l.Koordinat_X as latitude, tl.ID_User as id_user, t.Nama_Kelompok_Tani 
        // FROM trans_lahan tl, master_peta_lahan l, master_petani p, master_kel_tani t 
        // WHERE tl.ID_Lahan = l.ID_Lahan 
        // AND tl.ID_User = '$id'
        // and tl.status_aktif = 1
        // AND t.ID_Kelompok_Tani = l.ID_Kelompok_Tani
        // AND tl.ID_User = p.ID_User 
        // AND l.ID_Lahan not in('')
        // ORDER BY l.ID_Lahan");
        $detail_lahan = DB::select("SELECT l.ID_Lahan, p.ID_User, p.Nama_Petani, l.nama_lahan, 
        l.Koordinat_X as lat, l.Koordinat_Y as longt, 
        l.luas_lahan, l.jenis_lahan, l.Desa, l.Kecamatan, l.Kabupaten, l.Provinsi, 
        l.status_organik, k.Nama_Kelompok_Tani 
        FROM master_peta_lahan l, master_petani p, trans_lahan tl, master_kel_tani k 
        WHERE tl.ID_Lahan = l.ID_Lahan 
        and tl.ID_User = p.ID_User AND l.ID_Lahan = '$id' AND l.ID_Kelompok_Tani = k.ID_Kelompok_Tani limit 1");
        $titik = DB::select("SELECT * FROM master_peta_lahan_detail WHERE id_lahan = '$id' order by indeks asc");
        //$titik = DB::select("SELECT * FROM master_peta_lahan WHERE id_lahan = '$id' order by indeks asc");
        return view('admin.mapping.detail_lahan_petani', compact('detail_lahan','titik'));
        //return $;
    }

    public function detail_titik($id)
    {
        $ID_Lahan = $id;
        $detail_lahan = DB::select("SELECT l.ID_Lahan, p.Nama_Petani, l.nama_lahan, 
        l.Koordinat_X as lat, l.Koordinat_Y as longt, 
        l.luas_lahan, l.jenis_lahan, l.Desa, l.Kecamatan, l.Kabupaten, l.Provinsi, 
        l.status_organik, k.Nama_Kelompok_Tani 
        FROM master_peta_lahan l, master_petani p, trans_lahan tl, master_kel_tani k 
        WHERE tl.ID_Lahan = l.ID_Lahan 
        and tl.ID_User = p.ID_User AND l.ID_Lahan = '$id' AND l.ID_Kelompok_Tani = k.ID_Kelompok_Tani limit 1");
        //$coba = DB::select("SELECT * FROM master_peta_lahan_detail WHERE id_lahan = '$id' order by indeks asc");
        $titik = DB::select("SELECT d.ID_Lahan,l.Koordinat_X, l.Koordinat_Y,d.id_detail, d.lat, d.longt, d.indeks  
        FROM master_petani p, master_peta_lahan l, master_peta_lahan_detail d, trans_lahan t WHERE p.ID_User = t.ID_User 
        and t.ID_Lahan = l.ID_Lahan  and d.ID_Lahan = t.ID_Lahan AND t.ID_Lahan = '$id'and t.status_aktif=1 order by indeks asc ");
        //$titik = DB::select("SELECT * FROM master_peta_lahan_detail WHERE id_lahan = '$id' order by indeks asc");
        //$titik = DB::select("SELECT l.ID_Lahan,l.Koordinat_X, l.Koordinat_Y,d.id_detail, d.lat, d.longt, d.indeks FROM master_petani p, master_peta_lahan l, master_peta_lahan_detail d, trans_lahan t WHERE p.ID_User = t.ID_User and t.ID_Lahan = l.ID_Lahan AND t.ID_Lahan = '$id'and t.status_aktif=1 order by indeks asc");
        return view('admin.mapping.detail_titik', compact('detail_lahan','titik'));
        //return $detail_lahan;
    }

    public function tambah_lahan($id)
    {
        $nama_petani = DB::select("SELECT Nama_Petani from master_petani WHERE ID_User = '$id'");
        $id_user = $id;
        $kelompok_tani = DB::select("SELECT DISTINCT l.ID_Kelompok_Tani as id, k.nama_kelompok_tani as nama_kel_tani 
        from master_kel_tani k, master_peta_lahan l, trans_lahan tl where k.ID_Kelompok_Tani = l.ID_Kelompok_Tani
        AND tl.ID_Lahan = l.ID_Lahan");
        $prov = DB::select("SELECT Nama_Provinsi from provinsi");
        return view('admin.mapping.tambah_lahan',compact('nama_petani','kelompok_tani','prov','id_user'));
    }
    public function post_lahan(Request $request)
    {
        $validatedData = $this->validate($request,[
            'kelompok_tani' => 'required',
            'nama_lahan' => 'required',
            'luas_lahan' => 'required',
            'jenis_lahan' => 'required',
            'status_organik' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        DB::insert("INSERT INTO `master_peta_lahan` (`ID_Lahan`, `nama_lahan`, `Koordinat_X`, `Koordinat_Y`, 
    `luas_lahan`, `jenis_lahan`, `Desa`, `Kecamatan`, `Kabupaten`, `Provinsi`, `status_organik`, `ID_Kelompok_tani`)
    VALUES (NULL, '".$request->nama_lahan."', '".$request->latitude."', '".$request->longitude."',
    ".$request->luas_lahan.", '".$request->jenis_lahan."', '".$request->kelurahan."', '".$request->kecamatan."',
    '".$request->kabupaten."', '".$request->provinsi."', '".$request->status_organik."', '".$request->kelompok_tani."');");
        $latest_id_lahan = DB::select("SELECT ID_Lahan FROM `master_peta_lahan` ORDER by ID_Lahan DESC limit 1");
        $lasstt_id = $latest_id_lahan[0]->ID_Lahan;
        DB::insert("INSERT INTO `trans_lahan` (`nomor`, `ID_User`, `ID_Lahan`, `tanggal`, `status_lahan`, `status_aktif`) 
        VALUES (NULL, '".$request->id_user."', '".$lasstt_id."', CURRENT_TIMESTAMP, '".$request->status_lahan."', '1');");
        return redirect('detail_lahan/'.$request->id_user)->with('success', 'Lahan Berhasil Ditambahkan');
        // return response()->json($validatedData['nama_lahan']);
        
    }
    // public function post_lahan(Request $request)
    // {
    //     DB::insert("INSERT INTO `master_peta_lahan` (`ID_Lahan`, `nama_lahan`, `Koordinat_X`, `Koordinat_Y`, 
    //     `luas_lahan`, `jenis_lahan`, `Desa`, `Kecamatan`, `Kabupaten`, `Provinsi`, `status_organik`, `ID_Kelompok_tani`)
    //      VALUES (NULL, '".$request->nama_lahan."', '".$request->latitude."', '".$request->longitude."',
    //       ".$request->luas_lahan.", '".$request->jenis_lahan."', '".$request->kelurahan."', '".$request->kecamatan."',
    //        '".$request->kabupaten."', '".$request->provinsi."', '".$request->status_organik."', '".$request->kelompok_tani."');");
    //     $latest_id_lahan = DB::select("SELECT ID_Lahan FROM `master_peta_lahan` ORDER by ID_Lahan DESC limit 1");
    //     $lasstt_id = $latest_id_lahan[0]->ID_Lahan;
    //     DB::insert("INSERT INTO `trans_lahan` (`nomor`, `ID_User`, `ID_Lahan`, `tanggal`, `status_lahan`, `status_aktif`) 
    //     VALUES (NULL, '".$request->id_user."', '".$lasstt_id."', CURRENT_TIMESTAMP, '".$request->status_lahan."', '1');");
    //     return redirect('detail_lahan/'.$request->id_user)->with('success', 'Lahan Berhasil Ditambahkan');
    // }

    

    public function post_titik(Request $request)
    {
        $max_indeks = DB::select("SELECT max(indeks) as indeks from master_peta_lahan_detail where id_lahan = '$request->id_lahan'");
        $indeks = 0;
        if(isset ($max_indeks[0]->indeks) && $max_indeks[0]->indeks>0){
           $indeks =  $max_indeks[0]->indeks+1;
        }else{
            $indeks = 1;
        }
        DB::insert("INSERT INTO `master_peta_lahan_detail` (`id_lahan`, `lat`, `longt`, `indeks`) VALUES ('".$request->id_lahan."', '".$request->latitude."', '".$request->longitude."', '".$indeks."');");
        return redirect('detail_lahan_petani/'.$request->id_lahan)->with('success', 'Titik Berhasil Ditambahkan');
        // return response()->json($request);
    }

    public function hapus_lahan($id)
    {
       

        DB::table('trans_lahan')
            ->where('ID_Lahan', $id)
            ->delete();
     
        DB::table('master_peta_lahan_detail')
            ->where('id_lahan', $id)
            ->delete();
        
        DB::table('master_peta_lahan')
            ->where('ID_Lahan', $id)
            ->delete();    
        
        // $hapus_tl = DB::delete("DELETE FROM trans_lahan WHERE ID_Lahan = '$id'");
        // $hapus_mptd = DB::delete("DELETE FROM master_peta_lahan_detail WHERE id_lahan = '$id'");
        // $hapus_mpt = DB::delete("DELETE FROM master_peta_lahan WHERE ID_Lahan = '$id'");
        
            
        // DB::table("DELETE l.*,d.*, t.* from master_peta_lahan l, master_peta_lahan_detail d, trans_lahan t 
        // WHERE t.ID_Lahan = l.ID_Lahan and d.id_lahan = l.ID_Lahan AND l.ID_Lahan ='$id'");

        //return redirect('admin/daftar_petani/')->with('success', 'Lahan berhasil di Hapus');    
        return redirect()->back()->with('success', 'Lahan berhasil di Hapus');
        //return $id;
        //return redirect('admin/daftar_petani/', compact('hapus_tl','hapus__mptd','hapus_mpt'))->with('success', 'Lahan berhasil di Hapus');
    }

    public function hapus_titik($id)
    {
       
        DB::table('master_peta_lahan_detail')
            ->where('id_detail', $id)
            ->delete();    

            return redirect()->back()->with('success', 'Lahan berhasil di Hapus');
    }

    public function tambah_titik($id)
    {
        $detail_lahan = DB::select("SELECT l.ID_Lahan, p.Nama_Petani, l.nama_lahan, 
        l.Koordinat_X as lat, l.Koordinat_Y as longt, 
        l.luas_lahan, l.jenis_lahan, l.Desa, l.Kecamatan, l.Kabupaten, l.Provinsi, 
        l.status_organik, k.Nama_Kelompok_Tani 
        FROM master_peta_lahan l, master_petani p, trans_lahan tl, master_kel_tani k 
        WHERE tl.ID_Lahan = l.ID_Lahan 
        and tl.ID_User = p.ID_User AND l.ID_Lahan = '$id' AND l.ID_Kelompok_Tani = k.ID_Kelompok_Tani limit 1");
        $nama_lahan = DB::select("SELECT ID_Lahan from master_peta_lahan WHERE ID_Lahan = '$id'"); 
        //$nama_lahan = DB::select("SELECT l.*, d.lat, d.longt,d.indeks from master_peta_lahan l, master_peta_lahan_detail d WHERE l.ID_Lahan = '$id' AND d.ID_Lahan = l.ID_Lahan");
        $id_lahan = $id;
        // $trans_lahan = DB::select("SELECT ID_L");
        // $detail_titik = DB::select("SELECT * from master_peta_lahan_detail");
        return view('admin.mapping.tambah_titik',compact('detail_lahan','nama_lahan','id_lahan'));
    }

    public function ubah_lahan($id)
    {
        $data_lahan = DB::select("SELECT l.ID_Lahan, p.Nama_Petani, l.nama_lahan, 
        l.Koordinat_X as lat, l.Koordinat_Y as longt, 
        l.luas_lahan, l.jenis_lahan, l.Desa, l.Kecamatan, l.Kabupaten, l.Provinsi, 
        l.status_organik, l.ID_Kelompok_Tani 
        FROM master_peta_lahan l, master_petani p, trans_lahan tl, master_kel_tani k 
        WHERE tl.ID_Lahan = l.ID_Lahan 
        and tl.ID_User = p.ID_User AND l.ID_Lahan = '$id' AND l.ID_Kelompok_Tani = k.ID_Kelompok_Tani limit 1");
        $id_user = $id;
        // $data_lahan = DB::table('master_peta_lahan')->where('ID_Lahan',$id)->first();
        $kelompok_tani = DB::select("SELECT DISTINCT l.ID_Kelompok_Tani as id, k.nama_kelompok_tani as nama_kel_tani 
        from master_kel_tani k, master_peta_lahan l, trans_lahan tl where k.ID_Kelompok_Tani = l.ID_Kelompok_Tani 
        AND tl.ID_Lahan = l.ID_Lahan");
        $prov = DB::select("SELECT Nama_Provinsi from provinsi");
        return view('admin.mapping.ubah_lahan', compact('data_lahan','kelompok_tani','prov','id_user'));
        // return view('admin.mapping.ubah_lahan');

    }

    public function ubah_titik($id)
    {
        $data_titik = DB::select("SELECT * FROM master_peta_lahan_detail where id_detail = '$id'");
        // $data_lahan = DB::table('master_peta_lahan')->where('ID_Lahan',$id)->first();
        return view('admin.mapping.ubah_titik', compact('data_titik'));
        // return view('admin.mapping.ubah_lahan');

    }

    public function post_lahan_ubah(Request $request)
    {
        
        DB::update("UPDATE `master_peta_lahan` SET `nama_lahan` = '".$request->nama_lahan."', `Koordinat_X` = '".$request->latitude."', `Koordinat_Y` = '".$request->longitude."', `luas_lahan` = ".$request->luas_lahan.", `jenis_lahan` = '".$request->jenis_lahan."', `Desa` = '".$request->kelurahan."', `Kecamatan` = '".$request->kecamatan."', `Kabupaten` = '".$request->kabupaten."', `Provinsi` = '".$request->provinsi."', `status_organik` = '".$request->status_organik."', `ID_Kelompok_Tani` = '".$request->kelompok_tani."' WHERE `master_peta_lahan`.`ID_Lahan` = '".$request->id_lahan."';");
        
        return redirect('admin/daftar_petani/')->with('success', 'Data Lahan berhasil di Ubah');
    }

    public function post_titik_ubah(Request $request)
    {
        DB::update("UPDATE `master_peta_lahan_detail` SET `id_detail` = '".$request->id_detail."', `id_lahan` = '".$request->id_lahan."', `lat` = '".$request->latitude."', `longt` = '".$request->longitude."', `indeks` = '".$request->indeks."' WHERE `master_peta_lahan_detail`.`id_detail` = '".$request->id_detail."';");
        return redirect('detail_lahan_petani/'.$request->id_lahan)->with('success', 'Titik Berhasil Diubah');
    }    

    // public function search(Request $request)
    // {
    //     $keyword = $request->search;
    //     $users = DB::where('Nama_Petani', 'like', "%" . $keyword . "%")->paginate(5);
    //     return view('admin.mapping.daftar_petani', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    // }
}
