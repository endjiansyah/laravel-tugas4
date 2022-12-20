@extends('template')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between my-auto">
                <h5 id="ttl"></h5>
            </div>
        </div>
        <div class="card-body row">
            <div class="col-lg-7 pt-3">
                <p id="desc">
                </p>
            </div>
            <div class="col-lg-5">
                <img src="" alt="" class="img-fluid" id="gambar">
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $.ajax({
            url: "http://localhost:8000/api/article/{{ $id }}",
            method: "GET",
            success: response => {
                let article = response.data
                $("#ttl").html(article.title)
                $("#desc").html(article.description)
                $("#gambar").attr("src",article.gambar)
                $("#gambar").attr("alt",article.title)
            }
        })
    </script>
@endsection

@section('script')
@endsection