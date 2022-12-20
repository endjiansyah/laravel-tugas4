<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    function index()
    {
        $article = article::query()->get();

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $article
        ]);
    }
    function show($id)
    {
        $article = article::query()->where("id", $id)->first();
        if (!isset($article)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "nyoh",
            "data" => $article
        ]);
    }
    function store(Request $request)
    {
        $payload = $request->all();
        if (!isset($payload['title'])) {
            return response()->json([
                "status" => false,
                "message" => "kasih title dong",
                "data" => null
            ]);
        }
        if (!isset($payload['description'])) {
            return response()->json([
                "status" => false,
                "message" => "kasih description dong",
                "data" => null
            ]);
        }
        if (!isset($payload['gambar'])) {
            return response()->json([
                "status" => false,
                "message" => "kasih gambar dong",
                "data" => null
            ]);
        }

        $file = $request->file("gambar");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = $request->getSchemeAndHttpHost() . "/foto/" . $filename;
        $payload['gambar'] =  $path;
        $article = article::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data tersimpan",
            "data" => $article
        ]);
    }
    function update(Request $request, $id)
    {
        $article = article::query()->where("id", $id)->first();
        if (!isset($article)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }

        $payload = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $payload['gambar'] = $path;

            //file lama
            $lokasigambar = str_replace($request->getSchemeAndHttpHost(), '', $article->gambar);
            $gambar = public_path($lokasigambar);
            unlink($gambar);
        }

        $article->fill($payload);
        $article->save();

        return response()->json([
            "status" => true,
            "message" => "perubahan data tersimpan",
            "data" => $article
        ]);
    }
    function destroy(Request $request, $id)
    {
        $article = article::query()->where("id", $id)->first();
        if (!isset($article)) {
            return response()->json([
                "status" => false,
                "message" => "luru nopo mas?",
                "data" => null
            ]);
        }
        $lokasigambar = str_replace($request->getSchemeAndHttpHost(), '', $article->gambar);
        $gambar = public_path($lokasigambar);
        $article->delete();
        unlink($gambar);
        return response()->json([
            "status" => true,
            "message" => "Data Terhapus",
            "data" => $article
        ]);
    }
}
