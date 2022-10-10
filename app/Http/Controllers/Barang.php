<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_katalog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Barang extends Controller
{ 
    // membuat fungsi store untuk menyimpan data
    public function store(Request $request){
        $this->validate($request, [
            'file' => 'required|max:2048'
        ]);
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = $file->storeAs('public/data_file', $nama_file);
        if($file->move($tujuan_upload, $nama_file)){
            $data = tbl_katalog::create([
                'nama_produk' => $request -> nama_produk,
                'berat' => $request -> berat,
                'harga' => $request -> harga,
                'gambar' => $nama_file,
                'keterangan' => $request -> keterangan
            ]);

            $res['message'] = "Sukses menyimpan data !";
            $res['value'] = $data;
            return response($res);
        }else{
            $res['message'] = "Gagal menyimpan data !";
            return response($res);
        }
    }

    // membuat fungsi getData untuk menampilkan semua data
    public function getData(){
        // mendapatkan data dari database
        $data = DB::table('tbl_katalog')->get();
        if(count($data) > 0){
            $res['message'] = "Berhasil mendapatkan semua data !";
            $res['value'] = $data;
            return response($res);
        }else{
            $res['message'] = "Gagal mendapatkan data !";
            return response($res);
        }
    }

    // membuat fungsi hapus untuk menghapus data sesuai id
    public function hapus($id){
        $data = DB::table('tbl_katalog')->where('id', $id)->get();
        foreach($data as $katalog){
            // membuat kondisi jika file gambar ada di dalam file penyimpanan akan melakukan menghapus data
            if(file_exists('public/data_file/'.$katalog->gambar)){
                Storage::delete('public/data_file/'.$katalog->gambar);
                DB::table('tbl_katalog')->where('id', $id)->delete();
                $res['message'] = "Data berhasil dihapus !";
                return response($res);
            }else{
                $res['message'] = "Data gagal dihapus !";
                return response($res);
            }
        }
    }

    //membuat fungsi getDetail untuk menampilkan data sesuai id
    public function getDetail($id){
        $data = DB::table('tbl_katalog')->where('id', $id)->get();
        if(count($data) > 0){
            $res['message'] = "Berhasil mendapatkan data !";
            $res['value'] = $data;
            return response($res);
        }else {
            $res['message'] = "Data tidak ada !";
            return response($res);
        }
    }

    // membuat fungsi update untuk mengupdate data
    public function update(Request $request){

        // membuat kondisi jika file ada makan akan menghapus file dan mengupdate data dengan yang baru
        if(!empty($request->file)){

            // untuk mengupload file
            $this->validate($request, [
                'file' => 'required|max: 2048'
            ]);
            // untuk menyimpan file
            $file = $request -> file('file');
            // untuk mendapatkan nama fie
            $nama_file = time()."_".$file->getClientOriginalName();
            // untuk menentukan dimana kita menyimpan file
            $tujuan_upload = $file->storeAs('public/data_file', $nama_file);
            // mengambil data sesuai id
            $data = DB::table('tbl_katalog')->where('id', $request->id)->get();
            foreach($data as $katalog){
                // menghapus file
                Storage::delete('public/data_file/'.$katalog->gambar);
                // mengupdate file atau data baru
                $ket = DB::table('tbl_katalog')->where('id', $request->id)->update([
                    'nama_produk' => $request -> nama_produk,
                    'berat' => $request -> berat,
                    'harga' => $request -> harga,
                    'gambar' => $nama_file,
                    'keterangan' => $request -> keterangan
                ]);
                // respon jika berhasil melakukan eksekusi
                $res['message'] = "Data berhasil di update !";
                $res['value'] = $ket;
                return response($res);
            }
        }else{
            $data = DB::table('tbl_katalog')->where('id', $id)->get();
            foreach($data as $katalog){
                $ket = DB::table('tbl_katalog')->where('id', $id)->update([
                    'nama_produk' => $request -> nama_produk,
                    'berat' => $request -> berat,
                    'harga' => $request -> harga,
                    'keterangan' => $request -> keterangan
                ]);
                $res['message'] = "Data berhasil di update !";
                $res['value'] = $ket;
                return response($res);
            }
        }
    }
}
