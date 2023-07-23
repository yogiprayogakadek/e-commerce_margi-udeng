<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('backend.kategori.index');
    }

    public function render()
    {
        $kategori = Kategori::all();

        $view = [
            'data' => view('backend.kategori.render', compact('kategori'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('backend.kategori.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(KategoriRequest $request)
    {
        try {
            $data = [
                'nama' => $request->nama,
            ];

            $kategori = Kategori::where('nama', $request->nama)->first();
            if(!$kategori) {
                Kategori::create($data);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan',
                    'title' => 'Berhasil'
                ]);
            } else {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Data sudah ada',
                    'title' => 'Info'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $view = [
            'data' => view('backend.kategori.edit', compact('kategori'))->render()
        ];

        return response()->json($view);
    }

    public function update(KategoriRequest $request)
    {
        try {
            $kategori = Kategori::find($request->id);
            $data = [
                'nama' => $request->nama,
                'status' => $request->status,
            ];

            $kategori->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Terjadi kesalahan',
                'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function print()
    {
        $kategori = Kategori::all();

        $view = [
            'data' => view('backend.kategori.print', compact('kategori'))->render(),
        ];

        return response()->json($view);
    }

}

