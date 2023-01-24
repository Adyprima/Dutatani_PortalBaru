<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JsonGen extends Controller
{
 public function gen_kab($prov)
 {
    $kabupaten = DB::select("SELECT Nama_Kabupaten from kabupaten where Nama_Provinsi = '$prov'");
    return response()->json($kabupaten);
 }

 public function gen_kec($kab)
 {
    $kecamatan = DB::select("SELECT Nama_Kecamatan from kecamatan where Nama_Kabupaten = '$kab'");
    return response()->json($kecamatan);
 }

 public function gen_kel($kel)
 {
    $kelurahan = DB::select("SELECT Nama_Desa from kelurahan_desa where Nama_Kecamatan = '$kel'");
    return response()->json($kelurahan);
 }
}
