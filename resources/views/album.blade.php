@extends('layouts.app')
@section('content')
    <div class="container">
        <button type="button" data-bs-target="#modal_tambahalbum" data-bs-toggle="modal" class="btn btn-primary mb-3">Buat
            Album Baru</button>
        <div class="modal" tabindex="-1" id="modal_tambahalbum">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Album</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tambah.myalbum') }}" id="FormStoreAlbum" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name_album" class="form-label">Nama Album</label>
                                <input type="text" name="name_album" id="name_album" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description_album" class="form-label">Deskripsi Album</label>
                                <textarea name="description_album" id="description_album" class="form-control" cols="15" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" onclick="StoreAlbum()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-album-tab" data-bs-toggle="pill" data-bs-target="#pills-album"
                    type="button" role="tab" aria-controls="pills-album" aria-selected="true">Album</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-myalbum-tab" data-bs-toggle="pill" data-bs-target="#pills-myalbum"
                    type="button" role="tab" aria-controls="pills-myalbum" aria-selected="false">MyAlbum</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-album" role="tabpanel" aria-labelledby="pills-album-tab"
                tabindex="0">
                <div class="row">
                    @forelse ($albums as $item)
                        <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                            <div class="card">
                                <div class="" style="position: relative;">
                                    <a href="{{ route('show.post', $item->slug) }}">
                                        <img class="object-fit-cover border rounded" width="100%" height="250px;" src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->gambar }}">
                                    </a>

                                    <div class="p-3" style="position: absolute;bottom: 0px;">
                                        <svg data-bs-toggle="modal"
                                            data-bs-target="#confirmation_unalbum{{ $item->id }}" style="color: red;"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z" />
                                        </svg>
                                        <div class="modal" id="confirmation_unalbum{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus Album</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <b>Yakin mau mengeluarkan gambar ini dari album?</b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <form action="/album/{{ $item->id }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Hapus dari
                                                                album</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <b>Tidak ada data.</b>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="pills-myalbum" role="tabpanel" aria-labelledby="pills-myalbum-tab"
                tabindex="0">
                <div class="row">
                    @forelse ($myalbum as $item)
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="text-center" style="position: relative;">
                                    <b>{{ $item->name_album }}</b> <br>
                                    <a href="/show_myalbum/{{ $item->id }}">
                                        <button type="button" class="btn btn-primary mb-2">Detail</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <b>Tidak ada data.</b>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
    <script>
        function StoreAlbum() {
            $("#FormStoreAlbum").off("submit");
            $("#FormStoreAlbum").submit(function(e) {
                e.preventDefault();
                let route = $(this).attr("action");
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    data: data,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            'title': 'Error',
                            'message': xhr.responseText,
                            'position': 'topCenter'
                        });
                    }
                });
            });
        }
    </script>
@endsection
