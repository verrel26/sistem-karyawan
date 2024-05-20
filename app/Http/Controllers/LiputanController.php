<?php

namespace App\Http\Controllers;

use App\Models\Liputan;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class LiputanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Gate::allows('read-liputan')) {
            return view('liputan.index');
        } else {
            return view('error.unauthorize');
        }
    }

    public function data()
    {
        if (!Gate::allows('read-liputan')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to read liputan users'
            ]);
        }

        $user = Auth::user();
        // Menampilkan data cuti berdasarkan user yang login
        $cutiQuery = Liputan::with('karyawan');

        if (!$user->hasRole('admin')) {
            $cutiQuery->where('id_karyawan', $user->id);
        }
        // harus ada field role ditabel karyawan
        $cuti = $cutiQuery->get();

        return DataTables::of($cuti)->addIndexColumn()->toJson();

        // $liputans = Liputan::with('karyawan')->get();

        // return DataTables::of($liputans)->addIndexColumn()->toJson();
    }

    public function store(Request $request)
    {
        if (!Gate::allows('create-liputan')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to create liputans'
            ]);
        }
        try {
            $validate = Validator::make($request->all(), [
                'id_karyawan'   => 'required',
                'liputan'       => 'required'
            ], [
                'id_karyawan.required'  => 'The id_karyawan field is required',
                'liputan.required'      => 'The liputan field is required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors()->first()
                ]);
            }

            $liputan = Liputan::create([
                'id_karyawan'       => (int)$request->id_karyawan,
                'liputan'           => $request->liputan
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Liputan ' . $liputan->id_karyawan . ' has been created',
                'data' => $liputan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        if (!Gate::allows('delete-liputan')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to delete Lemburs'
            ]);
        }
        try {
            $liputan = Liputan::find($request->id);
            $liputan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Liputan ' . $liputan->id_karyawan . ' has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
