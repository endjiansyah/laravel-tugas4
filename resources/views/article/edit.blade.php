@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
                <label for="title" class="form-label">title</label>
                <input type="text" name="title" id="title" class="form-control mb-3">

                <label for="description" class="form-label">description</label>
                <textarea name="description" id="description" class="form-control mb-3"></textarea>

                <img src="" alt="" class="img-fluid" id="gambare" width="100px"><br>
                <label for="gambar" class="form-label">gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control mb-3">

                <button onclick="ediit()" class="btn btn-success mt-3">Save</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
    $.ajax({
                url: "http://localhost:8000/api/article/{{$id}}",
                method: "GET",
                success: response => {
                let article = response.data
                $("#title").val(article.title)
                $("#description").html(article.description)
                $("#gambare").attr("src",article.gambar)
            }
            })

        function ediit() {
            let title = $("#title").val()
            let description = $("#description").val()
            let gambar = $("#gambar")

            if (title === "") return alert("Namanya kok kosong?")
            if (description === "") return alert("descriptionnya mana?")

            let fd = new FormData();
            fd.append("title", title)
            fd.append("description", description)
            if(gambar.prop("files").length > 0){
            fd.append("gambar", gambar.prop('files')[0])   
            }

            $.ajax({
                url: "http://localhost:8000/api/article/{{$id}}/edit",
                method: "POST",
                data: fd,
                processData: false, //agar data tidak diproses dulu sebelum dikirim
                contentType: false, //di false karena menggunakan form data (FD)
                success: _ => {
                    window.location.href = "http://localhost:8000/article"
                }
            })
        }
    </script>
@endsection