@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="card card-body">
                @csrf
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" placeholder="nama produk" id="nama" class="form-control mb-3"
                    required>

                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control mb-3"></textarea>

                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" placeholder="harga produk" id="harga" class="form-control mb-3">

                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" placeholder="stock produk" id="stock" class="form-control mb-3">

                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control mb-3">

                <input type="submit" value="Save" class="btn btn-success mt-3">
            </form>
        </div>
    </div>
@endsection
{{-- 
@section('script')
    <script>
        function add() {
            let nama = $("#nama").val()
            let deskripsi = $("#deskripsi").html()
            let harga = $("#harga").val()
            let stock = $("#stock").val()

            if (nama === "") return alert("Namanya kok kosong?")
            if (deskripsi === "") return alert("deskripsinya mana?")
            if (harga === "") return alert("lah harga berapa?")
            if (stock === "") return alert("gapunya stock?")

            let fd = new FormData();
            fd.append("nama", nama)
            fd.append("deskripsi", deskripsi)
            fd.append("harga", harga)
            fd.append("stock", stock)

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
@endsection --}}
