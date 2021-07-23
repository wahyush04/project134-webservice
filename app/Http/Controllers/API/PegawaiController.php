<?php

namespace App\Http\Controllers\API;

use App\pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PegawaiController extends Controller
{
    public function index()
    {
        return Pegawai::With('jabatan','Riwayatpendidikan')->get();
    }

    // Cara 1
    // public function show(Course $data){
    //     return $data;
    // }

    // cara 2
    public function show($data)
    {
        $detail = Pegawai::where('nip', $data)->With('jabatan','Riwayatpendidikan')->first();

        if (empty($detail)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'pesan' => 'Data Berhasil ditemukan',
            'data' => $detail
        ], 200);
    }

    // cara 1 menggunakan dependency injection
    //    public function destroy(Course $data)
    //    {
    //        $data->delete();
    //    }

    // cara 2 cara lengkap
    public function destroy($data)
    {
        $detail = Pegawai::where('nip', $data)->first();

        if (empty($detail)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
        $detail->delete();
        return response()->json([
            'pesan' => 'Data Berhasil Dihapus',
            'data' => $detail
        ], 200);
    }

    public function store(Request $request)
    {
        //        Cara 1
        //        Course::create($request->all());
        //        Cara 2

        $validasi = Validator::make($request->all(), [
            "id_jabatan" => "required|integer",
            "id_pendidikan" => "required|integer",
            "nama" => "required",
            "alamat" => "required",
            "jenis_kelamin" => "required",
            "notelp" => "required",
            "status" => "required",
        ]);

        if ($validasi->passes()) {
            return response()->json([
                'pesan' => "Data Berhasil disimpan",
                'data' => Pegawai::create($request->all())
            ]);
        }
        return response()->json([
            'pesan' => 'Data Gagal ditambahkan',
            'data' => $validasi->errors()->all()
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $data = Pegawai::where('nip', $id)->first();

        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        } else {

            $validasi = Validator::make($request->all(), [
                "id_jabatan" => "required|integer",
                "id_pendidikan" => "required|integer",
                "nama" => "required",
                "alamat" => "required",
                "jenis_kelamin" => "required",
                "notelp" => "required",
                "status" => "required",
            ]);

            if ($validasi->passes()) {
                return response()->json([
                    'pesan' => "Data Berhasil disimpan",
                    'data' => $data->update($request->all())
                ]);
            } else {
                return response()->json([
                    'pesan' => 'Data Gagal di Update',
                    'data' => $validasi->errors()->all()
                ], 404);
            }
        }
    }
}
