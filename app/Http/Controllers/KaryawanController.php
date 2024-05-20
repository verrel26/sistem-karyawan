<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class KaryawanController extends Controller
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
        //Karyawan
        if (Gate::allows('admin')) {
            return view('karyawan.index');
        } else {
            return view('error.unauthorize');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function data()
    {
        if (!Gate::allows('read-karyawans')) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to read users'
            ]);
        }
        $karyawans = Karyawan::all();

        return DataTables::of($karyawans)->addIndexColumn()->toJson();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryawanRequest $request)
    {
        //
        if (Gate::allows('create-karyawans')) {
            try {
                $validate = Validator::make($request->all(), [
                    'karyawan' => 'required'
                ], [
                    'karyawan.required' => 'The karyawan field is required'
                ]);

                if ($validate->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validate->errors()->first()
                    ]);
                }
                $checkKaryawan = Karyawan::where('name', $request->karyawan)->first();
                if ($checkKaryawan) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Karyawan ' . $request->karyawan . ' already exists'
                    ]);
                }
                $karyawan = Role::create([
                    'nama_karyawan' => $request->karyawan,
                    'niy' => '112'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Karyawan' . $karyawan->name . 'has been created',
                    'data' => $karyawan
                ]);
            } catch (\Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to read karyawans'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //Detail
        if (Gate::allows('read-karyawans')) {
            $karyawan = Karyawan::find($id);
            return view('karyawan.detail', [
                'karyawan' => $karyawan
            ]);
        } else {
            return view('error.unauthorize');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateKaryawanRequest $request, Karyawan $karyawan)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!Gate::allows('karyawans')) return view('unautorize');

        try {
            $karyawan = Karyawan::find($request->id);
            $karyawan->delete();
            return response()->json([
                'success' => true,
                'message' => 'Karyawan ' . $karyawan->nama_karyawan . ' has been deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
