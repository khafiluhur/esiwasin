<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{

  public function download1($file) {;
    $file_path = public_path('/storage/upload/audit/keuangan/'.$file);
    return response()->download($file_path);
  }

  public function download2($file) {
    $file_path = public_path('/storage/upload/audit/kinerja/'.$file);
    return response()->download($file_path);
  }

  public function download3($file) {
    $file_path = public_path('/storage/upload/audit/tujuantertentu/'.$file);
    return response()->download($file_path);
  }

  public function download4($file) {
    $file_path = public_path('/storage/upload/reviu/keuangan/'.$file);
    return response()->download($file_path);
  }

  public function download5($file) {
    $file_path = public_path('/storage/upload/reviu/anggaran/'.$file);
    return response()->download($file_path);
  }

  public function download6($file) {
    $file_path = public_path('/storage/upload/evaluasi/sakip/'.$file);
    return response()->download($file_path);
  }

  public function download7($file) {
    $file_path = public_path('/storage/upload/evaluasi/reformasi/'.$file);
    return response()->download($file_path);
  }

  public function download8($file) {
    $file_path = public_path('/storage/upload/reviu/lakip/'.$file);
    return response()->download($file_path);
  }

  public function download9($file) {
    $file_path = public_path('/storage/upload/reviu/rkbmn/'.$file);
    return response()->download($file_path);
  }

  public function download10($file) {
    $file_path = public_path('/storage/upload/evaluasi/spip/'.$file);
    return response()->download($file_path);
  }

  public function download11($file) {
    $file_path = public_path('/storage/upload/evaluasi/iacm/'.$file);
    return response()->download($file_path);
  }

  public function download12($file) {
    $file_path = public_path('/storage/upload/pemantauan/bpk/'.$file);
    return response()->download($file_path);
  }

  public function download13($file) {
    $file_path = public_path('/storage/upload/pemantauan/lha/'.$file);
    return response()->download($file_path);
  }

  public function download14($file) {
    $file_path = public_path('/storage/upload/pemantauan/spip/'.$file);
    return response()->download($file_path);
  }

  public function download15($file) {
    $file_path = public_path('/storage/upload/pemantauan/lhkasn/'.$file);
    return response()->download($file_path);
  }

  public function download19($file) {
    $file_path = public_path('/storage/upload/pengawasan/rbzi/'.$file);
    return response()->download($file_path);
  }

  public function download20($file) {
    $file_path = public_path('/storage/upload/pengawasan/sakip/'.$file);
    return response()->download($file_path);
  }

}

