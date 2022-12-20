<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index()
    {
        $produk = produk::query()->get();

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $produk
        ]);
    }
    function show($id)
    {
        $produk = produk::query()->where("id", $id)->first();
        if (!isset($produk)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $produk
        ]);
    }
    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['nama'])) {
            return response()->json([
                "status" => false,
                "message" => "kasih nama dong",
                "data" => null
            ]);
        }
        if (!isset($payload['harga'])) {
            return response()->json([
                "status" => false,
                "message" => "kasih harga dong",
                "data" => null
            ]);
        }
        if (!isset($payload['stock'])) {
            return response()->json([
                "status" => false,
                "message" => "stock berapa?",
                "data" => null
            ]);
        }
        if (!isset($payload['foto'])) {
            return response()->json([
                "status" => false,
                "message" => "kasih foto dong",
                "data" => null
            ]);
        }

        $file = $request->file("foto");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = $request->getSchemeAndHttpHost() . "/foto/" . $filename;
        $payload['foto'] =  $path;
        $produk = produk::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $produk
        ]);
    }
    function update(Request $request, $id)
    {
        $produk = produk::query()->where("id", $id)->first();
        if (!isset($produk)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $hilih = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $hilih['foto'] = $path;

            //file lama
            $lokasifoto = str_replace($request->getSchemeAndHttpHost(), '', $produk->foto);
            $foto = public_path($lokasifoto);
            unlink($foto);
        }

        $isidb = array_intersect_key($hilih, array_flip(['nama', 'harga', 'foto', 'stock', 'deskripsi']));

        $produk->fill($isidb);
        $produk->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $produk
        ]);
    }
    function destroy(Request $request, $id)
    {
        $produk = produk::query()->where("id", $id)->first();
        if (!isset($produk)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }
        $lokasifoto = str_replace($request->getSchemeAndHttpHost(), '', $produk->foto);
        $foto = public_path($lokasifoto);
        $produk->delete();
        unlink($foto);
        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $produk
        ]);
    }
}
