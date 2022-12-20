@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('article.create') }}" class="btn btn-secondary">Tambah article</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="card-info">
                        <td>title</td>
                        <td>description</td>
                        <td>Gambar</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody id="table-article">

                </tbody>
            </table>
        </div>
    </div>
@endsection
{{-- ---------------------- --}}
@section('script')
    <script>
        $.ajax({
            url: "http://localhost:8000/api/article",
            method: "GET",
            dataType: "json",
            success: response => {
                let listArticle = response.data
                let filler = ""
                for (let article of listArticle) {
                    filler += `
                         <tr>
                            <td>${article.title}</td>
                            <td>${article.description}</td>
                            <td><img src="${article.gambar}" alt="${article.title}" width="100px"></td>
                            <td>
                                <a href="http://localhost:8000/article/edit/${article.id}" class="btn btn-sm btn-primary">Edit</a>
                                <button onclick="deleteArticle(${article.id})"  class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                            </tr>
                            `
                }
                html = $.parseHTML(filler)
                $("#table-article").append(html)
            }
        })

        function deleteArticle(id) {
            $.ajax({
                url: `http://localhost:8000/api/article/${id}/delete`,
                method: "POST",
                dataType: "json",
                success: _ => {
                    console.log("SUCCESS")
                    window.location.href = ""
                }
            })
        }
    </script>
@endsection
