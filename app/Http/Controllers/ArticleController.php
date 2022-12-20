<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = article::query()
            ->get();
        return view("article.index", ["articles" => $articles]);
    }
    public function list()
    {
        $articles = article::query()
            ->get();
        return view("article.list", ["articles" => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = article::all();
        return view("article.create", compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file("gambar");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = $request->getSchemeAndHttpHost() . "/foto/" . $filename;
        $isian = [
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "gambar" => $path
        ];
        article::query()->create($isian);
        return redirect()->back()->with(['success' => 'Data Tersimpan']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(article $article)
    {
        return view('article.edit', compact('article'));
    }
    public function detail(article $article)
    {
        return view('article.detail', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, article $article)
    {
        $this->validate($request, [
            'title' => 'Required',
            'foto' => 'file|image|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $lokasigambar = str_replace($request->getSchemeAndHttpHost(), '', $article->gambar);
            $gambar = public_path($lokasigambar);

            $article->update([
                "title" => $request->input('title'),
                "description" => $request->input('description'),
                "gambar" => $path
            ]);
            unlink($gambar);
        } else {
            $article->update([
                "title" => $request->input('title'),
                "description" => $request->input('description')
            ]);
        }

        return redirect()->back()->with(['success' => 'Data Tersimpan']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article, Request $request)
    {
        $lokasifoto = str_replace($request->getSchemeAndHttpHost(), '', $article->gambar);
        $foto = public_path($lokasifoto);
        $article->delete();
        unlink($foto);
        return redirect()->back()->with(['hapus' => 'Data Tehapus']);
    }
}
