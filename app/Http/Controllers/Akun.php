<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_user;
use Illuminate\Support\Facades\DB;

class Akun extends Controller
{

    public function tambah(Request $request){
        $data = tbl_user::create([
            'name' => $request -> name,
            'username' => $request -> username,
            'password' => $request -> password
        ]);
        $res['message'] = "Sukses !";
        $res['value'] = $data;
        return response($res);
    }

    public function ubah(Request $request){
        $data = DB::table('tbl_user')->where('id', $request->id)->update([
            'name' => $request -> name,
            'username' => $request -> username,
            'password' => $request -> password
        ]);
        $res['message'] = "Berhasil !";
        $res['value'] = $data;
        return response($res);
    }

    public function Detail($username){
        $data = DB::table('tbl_user')->where('username', $username)->get();
        if(count($data) > 0){
            $res['message'] = "Berhasil mendapatkan data !";
            $res['value'] = $data;
            return response($res);
        }else {
            $res['message'] = "Data tidak ada !";
            return response($res);
        }
    }
}
