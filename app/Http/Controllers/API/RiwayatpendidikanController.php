<?php

namespace App\Http\Controllers\API;

use App\Riwayatpendidikan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RiwayatpendidikanController extends Controller
{
    public function index()
    {
        return Riwayatpendidikan::get();
    }

    // Cara 1
    // public function show(Course $data){
    //     return $data;
    // }

    // cara 2
    public function show($data)
    {
        $detail = Riwayatpendidikan::where('id_pendidikan', $data)->first();

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
        $detail = Riwayatpendidikan::where('id_pendidikan', $data)->first();

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
            "jenjang" => "required",
            "jurusan" => "required",
            "tahun" => "required",
            "keterangan" => "required"
        ]);

        if ($validasi->passes()) {
            return response()->json([
                'pesan' => "Data Berhasil disimpan",
                'data' => Riwayatpendidikan::create($request->all())
            ]);
        }
        return response()->json([
            'pesan' => 'Data Gagal ditambahkan',
            'data' => $validasi->errors()->all()
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $data = Riwayatpendidikan::where('id_pendidikan', $id)->first();

        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        } else {

            $validasi = Validator::make($request->all(), [
                "jenjang" => "required",
                "jurusan" => "required",
                "tahun" => "required",
                "keterangan" => "required"
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
