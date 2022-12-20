@extends('template')

@section('content')
    <div class="row" id="list-article">
    </div>
@endsection

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
                        <div class="col-lg-4 p-2">
                            <div class="card">
                                <img class="card-img-top" src="${article.gambar}" alt="${article.title}">
                                <div class="card-body">
                                    <h4 class="card-title">${article.title}</h4>
                                    <p class="card-text">${article.description}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="http://localhost:8000/detail/${article.id}" class="btn btn-sm btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                }
                html = $.parseHTML(filler)
                $("#list-article").append(html)
            }
        })
    </script>
@endsection
