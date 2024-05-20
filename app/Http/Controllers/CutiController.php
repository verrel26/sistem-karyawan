<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;


class Status
{
    const menunggu_konfirmasi = 'menuggu konfirmasi';
    const terima = 'terima';
    const tolak = 'tolak';
}

class CutiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::allows('read-cuti')) {
            return view('cuti.index');
        } else {
            return view('error.unauthorize');
        }
    }


    public function data()
    {
        if (!Gate::allows('read-cuti')) {
            return view('error.unauthorize');
        }

        $user = Auth::user();

        // Menampilkan data cuti berdasarkan user yang login
        $cutiQuery = Cuti::with('karyawan');

        if (!$user->hasRole('admin')) {
            $cutiQuery->where('id_karyawan', $user->id);
        }
        // harus ada field role ditabel karyawan
        $cuti = $cutiQuery->get();

        return DataTables::of($cuti)->addIndexColumn()->toJson();
    }

    public function show($id)
    {
        if (Gate::allows('cuti')) {
            $cuti = Cuti::with('karyawan')->find($id);
            return view('cuti.detail', [
                'cuti' => $cuti
            ]);
        } else {
            return view('error.unauthorize');
        }
    }

    public function pengajuan()
    {
        if (Gate::allows('pengajuan-cuti')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to read users'
            ]);
        }

        $cuti = Auth::user()->roles[0]->name;

        // Ubah data ke dalam format yang sesuai dengan DataTables
        $data = Cuti::where('id_karyawan', $cuti)->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }
    public function store(Request $request)
    {
        //Tambah Data Cuti
        if (!Gate::allows('create-cuti')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to create cuti'
            ]);
        }
        try {
            $validate = Validator::make($request->all(), [
                'lamacuti' => 'required',
                'awalcuti' => 'required',
                'kategori_cuti' => 'required',
                'alasan_cuti' => 'required',
                'pengganti' => 'required',

            ], [
                'lamacuti.required' => 'The lama cuti field is required',
                'awalcuti.required' => 'The awal cuti field is required',
                'kategori_cuti.required' => 'The kategori cuti field is required',
                'alasan_cuti.required' => 'The alasan cuti field is required',
                'pengganti.required' => 'The pengganti field is required',

            ]);

            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first()
                ]);
            }

            $cuti = Cuti::create([
                'id_karyawan' => Auth::user()->id,
                'lamacuti' => $request->lamacuti,
                'awalcuti' => $request->awalcuti,
                'kategori_cuti' => $request->kategori_cuti,
                'alasan_cuti' => $request->alasan_cuti,
                'pengganti' => $request->pengganti,
                'status_cuti' => 'menunggu konfirmasi'
            ]);

            // $karyawan = Karyawan::findById($request->nama_karyawan);
            // $cuti->assignRole($karyawan);

            return response()->json([
                'success' => true,
                'message' => 'Cuti ' . $cuti->id_karyawan . ' has been created',
                'data' => $cuti
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

    public function update(Request $request)
    {
        //Edit Data
        if (!Gate::allows('update-cuti')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to update cuti'
            ]);
        }
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'id_karyawan' => 'required|max:255',
                    'lamacuti' => 'required|max:255',
                    'awalcuti' => 'required|max:255',
                    'kategori_cuti' => 'required|max:255',
                    'alasan_cuti' => 'required|max:255',
                    'pengganti' => 'required|max:255',
                    'status_cuti' => 'required|max:255' . $request->id
                ],
                [
                    'id_karyawan.required' => 'The id karyawan field is required',
                    'lamacuti.required' => 'The lama cuti field is required',
                    'awalcuti.required' => 'The awal cuti field is required',
                    'kategori_cuti.required' => 'The kategori cuti field is required',
                    'alasan_cuti.required' => 'The alasan cuti field is required',
                    'pengganti.required' => 'The pengganti field is required',
                    'status_cuti.required' => 'The status field is required'
                ]
            );

            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first()
                ]);
            }

            $cuti = Cuti::find($request->id);

            $cuti->id_karyawan = $request->id_karyawan;
            $cuti->lamacuti      = $request->lamacuti;
            $cuti->awalcuti      = $request->awalcuti;
            $cuti->kategori_cuti = $request->kategori_cuti;
            $cuti->alasan_cuti   = $request->alasan_cuti;
            $cuti->pengganti     = $request->pengganti;
            $cuti->status_cuti     = $request->status_cuti;

            $cuti->save();

            // if ($request->karyawan) {
            //     $karyawan = Karyawan::findById($request->karyawan);
            //     $cuti->syncRoles($karyawan);
            // }

            return response()->json([
                'success' => true,
                'message' => 'Cuti ' . $cuti->id_karyawan . ' has been updated',
                'data' => $cuti
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //Delete
        if (Gate::allows('delete-cuti')) {
            try {
                $cuti = Cuti::find($request->id);

                // $cuti->syncPermissions();

                $cuti->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Cuti ' . $cuti->id_karyawan . ' has been deleted'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete roles'
            ]);
        }
    }

    public function terima(Request $request)
    {
        // @dd($request->all());
        if (!Gate::allows('terima-cuti')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to update cuti'
            ]);
        }
        try {
            $cuti = Cuti::find($request->id);

            $cuti->status_cuti   =  Status::terima;

            $cuti->save();
            return response()->json([
                'success' => true,
                'message' => 'Cuti has been updated',
                'data' => $cuti
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function tolak(Request $request)
    {
        // @dd($request->all());
        if (!Gate::allows('tolak-cuti')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to update cuti'
            ]);
        }
        try {
            $cuti = Cuti::find($request->id);

            $cuti->status_cuti   =  Status::tolak;

            $cuti->save();
            return response()->json([
                'success' => true,
                'message' => 'Cuti has been updated',
                'data' => $cuti
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
