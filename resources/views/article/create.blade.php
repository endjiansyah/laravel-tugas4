@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <div class="card card-body">

                <label for="title" class="form-label">title</label>
                <input type="text" name="title" placeholder="title article" id="title" class="form-control mb-3"
                    required>

                <label for="description" class="form-label">description</label>
                <textarea name="description" id="description" class="form-control mb-3"></textarea>

                <label for="gambar" class="form-label">gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control mb-3">

                <button type="submit" class="btn btn-success mt-3" onclick="add()">Save</button>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function add() {
            let title = $("#title").val()
            let description = $("#description").val()
            let gambar = $("#gambar").prop('files')[0]

            if (title === "") return alert("Namanya kok kosong?")
            if (description === "") return alert("descriptionnya mana?")

            let fd = new FormData();
            fd.append("title", title)
            fd.append("description", description)
            fd.append("gambar", gambar)

            $.ajax({
                url: "http://localhost:8000/api/article",
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
