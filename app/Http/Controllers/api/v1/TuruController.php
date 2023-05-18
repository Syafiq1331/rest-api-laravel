<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Students::latest()->get();
        return response([
            'success' => true,
            'message' => 'List semua siswa',
            'data' => $students
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'tempat_lahir' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_telp.required' => 'No Telp tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'agama.required' => 'Agama tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 401);
        } else {
            $student = new Students();
            $student->nama = $request->nama;
            $student->alamat = $request->alamat;
            $student->no_telp = $request->no_telp;
            $student->email = $request->email;
            $student->jenis_kelamin = $request->jenis_kelamin;
            $student->agama = $request->agama;
            $student->tempat_lahir = $request->tempat_lahir;
            $student->save();

            if ($student) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan',
                    'data' => $student,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data gagal ditambahkan',
                ], 401);
            }
        }
    }

    public function update(Request $request)
    {
        // validate data
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'tempat_lahir' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_telp.required' => 'No Telp tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'agama.required' => 'Agama tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan isi bidang yang kosong',
                'data' => $validator->errors()
            ]);
        } else {
            $student = Students::whereId($request->input('id'))->update([
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'no_telp' => $request->input('no_telp'),
                'email' => $request->input('email'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'tempat_lahir' => $request->input('tempat_lahir'),
            ]);

            if ($student) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diupdate',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data gagal diupdate',
                ], 401);
            }
        }
    }

    public function show($id)
    {
        $students = Students::whereId($id)->first();

        if ($students) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Siswa',
                'data' => $students
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak ditemukan',
            ], 401);
        }
    }
}
