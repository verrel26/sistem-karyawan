<?php

namespace App\Http\Controllers;

use App\Models\Lembur;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::allows('read-lembur')) {
            return view('lembur.index');
        } else {
            return view('error.unauthorize');
        }
    }

    public function data()
    {
        if (!Gate::allows('read-lembur')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to read lembur users'
            ]);
        }
        $user = Auth::user();

        $cutiQuery = Lembur::with('karyawan');

        if (!$user->hasRole('admin')) {
            $cutiQuery->where('id_karyawan', $user->id);
        }
        // harus ada field role ditabel karyawan
        $cuti = $cutiQuery->get();

        return DataTables::of($cuti)->addIndexColumn()->toJson();
        // $lemburs = Lembur::with('karyawan')->get();

        // return DataTables::of($lemburs)->addIndexColumn()->toJson();
    }

    public function store(Request $request)
    {
        //Tambah Data Cuti
        if (!Gate::allows('create-lembur')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to create lemburs'
            ]);
        }
        try {
            $validate = Validator::make($request->all(), [
                'uraian_tugas'  => 'required',
                'mulai'         => 'required',
                'selesai'       => 'required',
                'ket'           => 'required'
            ], [
                'uraian_tugas.required' => 'The uraian tugas field is required',
                'mulai.required'        => 'The mulai field is required',
                'selesai.required'      => 'The selesai field is required',
                'ket.required'          => 'The ket field is required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first()
                ]);
            }
            $lembur = Lembur::create([
                'id_karyawan'       => Auth::user()->id,
                'uraian_tugas'      => $request->uraian_tugas,
                'mulai'             => $request->mulai,
                'selesai'           => $request->selesai,
                'ket'               => $request->ket
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Lembur has been created',
                'data' => $lembur
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        //
        if (!Gate::allows('update-lembur')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to update lemburs'
            ]);
        }
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'id'            => 'required',
                    'niy'           => 'required',
                    'nama_karyawan' => 'required',
                    'uraian_tugas'  => 'required',
                    'mulai'         => 'required',
                    'selesai'       => 'required',
                    'ket'           => 'required,' . $request->id,
                ],
                [
                    'id.required'  => 'The id field is required',
                    'niy.required'  => 'The id_karyawan field is required',
                    'nama_karyawan.required'  => 'The nama karyawan field is required',
                    'uraian_tugas.required' => 'The uraian tugas field is required',
                    'mulai.required'        => 'The mulai field is required',
                    'selesai.required'      => 'The selesai field is required',
                    'ket.required'          => 'The ket field is required'
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first()
                ]);
            }

            $lembur = Lembur::find($request->id);

            if (!$lembur) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lembur not found'
                ]);
            }

            $lembur->id_karyawan   = (int)$request->id_karyawan;
            $lembur->uraian_tugas  = $request->uraian_tugas;
            $lembur->mulai         = $request->mulai;
            $lembur->selesai       = $request->selesai;
            $lembur->ket           = $request->ket;


            $lembur->save();

            // if ($request->karyawan) {
            //     $karyawan = Karyawan::findById($request->karyawan);
            //     $lembur->syncRoles($karyawan);
            // }

            return response()->json([
                'success' => true,
                'message' => 'Lembur has been updated',
                'data' => $lembur
                // 'data' => $karyawan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        if (Gate::allows('read-lembur')) {
            $lembur = Lembur::with('karyawan')->find($id);

            // $lembur = Lembur::with('karyawan')->get()->find($id);
            return view('lembur.detail', [
                'lembur' => $lembur
            ]);
        } else {
            return view('error.unauthorize');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!Gate::allows('delete-lembur')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete Lemburs'
            ]);
        }
        try {
            $lembur = Lembur::find($request->id);
            $lembur->delete();

            return response()->json([
                'success' => true,
                'message' => 'Lembur ' . $lembur->karyawan->nama_karyawan . ' has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
