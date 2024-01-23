@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <b>Tambah Postingan Anda.</b>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('postingan.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="judul_gambar" class="form-label">Judul Gambar</label>
                                    <input type="text" name="judul_gambar" id="judul_gambar" class="form-control"
                                        placeholder="Berikan judul gambar.">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_gambar" class="form-label">Deskripsi Gambar</label>
                                    <textarea name="deskripsi_gambar" id="deskripsi_gambar" class="form-control" cols="30" rows="10"
                                        placeholder="Berikan deskripsi gambar."></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach ($posts as $item)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="" style="position: relative;">
                                <a href="{{ route('show.post', $item->slug) }}">
                                    <img width="100%" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->gambar }}">
                                </a>
                                <div class="d-flex"
                                    style="position: absolute;bottom: 0px;background-color:aliceblue;padding: 6px; border:1px solid black;border-top-right-radius:6px;">
                                    <svg class="text-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal_confirmation_delete{{ $item->id }}"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5q0-.425.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8q-.425 0-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8q-.425 0-.712.288T13 9v7q0 .425.288.713T14 17" />
                                    </svg>
                                    <div class="modal" id="modal_confirmation_delete{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <b>Yakin mau menghapus foto '{{ $item->judul_gambar }}'?</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('postingan.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <svg class="text-warning" data-bs-toggle="modal"
                                        data-bs-target="#modal_edit{{ $item->id }}" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z" />
                                    </svg>
                                    <div class="modal" id="modal_edit{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('postingan.update', $item->id) }}" method="post"
                                                        id="UpdatePostingan{{ $item->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="gambar" class="form-label">Gambar</label>
                                                            <input type="file" name="gambar" id="gambar"
                                                                class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="judul_gambar" class="form-label">Judul Gambar</label>
                                                            <input type="text" name="judul_gambar" id="judul_gambar"
                                                                value="{{ $item->judul_gambar }}" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi_gambar" class="form-label">Deskripsi
                                                                Gambar</label>
                                                            <textarea name="deskripsi_gambar" id="deskripsi_gambar" class="form-control" cols="30" rows="10">{{ $item->deskripsi_gambar }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" onclick="Update({{ $item->id }})"
                                                                class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <svg data-bs-target="#modal_album{{ $item->id }}" data-bs-toggle="modal"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M128 64h256v32H128zm-32 48h320v32H96zm368 336H48V160h416Z" />
                                    </svg>
                                    <div class="modal" id="modal_album{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Masukkan ke album.</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="FormAddOrUpdateAlbum{{ $item->id }}" action="{{ route('addOrUpdate.myalbum', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic checkbox toggle button group">
                                                            @forelse ($myalbums as $album)
                                                                <div class="form-check">
                                                                    @if ($album->check_post($item->id))
                                                                    <input class="form-check-input" type="radio"
                                                                    name="album" value="{{ $album->id }}" checked
                                                                    id="flexRadioDefault{{ $album->id }}">
                                                                    @else
                                                                    <input class="form-check-input" type="radio"
                                                                    name="album" value="{{ $album->id }}"
                                                                    id="flexRadioDefault{{ $album->id }}">
                                                                    @endif
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault{{ $album->id }}">
                                                                        {{ $album->name_album }}
                                                                    </label>
                                                                </div>
                                                            @empty
                                                                <div class="text-center">
                                                                    <b>Tidak ada data.</b>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                        <div class="mt-3">
                                                            <button type="submit" onclick="AddOrUpdateAlbum({{ $item->id }})" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endauth
    </div>
    <script>
        function AddOrUpdateAlbum(id)
        {
            $("#FormAddOrUpdateAlbum"+id).off("submit");
            $("#FormAddOrUpdateAlbum"+id).submit(function(e){
                e.preventDefault();
                let route = $(this).attr('action');
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    method: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Csrf-Token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        iziToast.destroy();
                        iziToast.success({
                            title: 'Success',
                            message: response.message,
                            position: 'topCenter'
                        });
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            title: 'Error',
                            message: xhr.responseText,
                            position: 'topCenter'
                        });
                    }
                });
            });
        }
        function Update(id) {
            $("#UpdatePostingan" + id).off('submit');
            $("#UpdatePostingan" + id).submit(function(event) {
                event.preventDefault();
                let route = $(this).attr('action');
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    method: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Csrf-Token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            title: 'Error',
                            message: xhr.responseText,
                            position: 'topCenter'
                        });
                    }
                });
            });
        }
    </script>
@endsection
