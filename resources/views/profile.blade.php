@extends('layouts.app')
@section('content')
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">

                                @guest
                                    <img src="{{ asset('profile-default.png') }}" class="img-fluid img-thumbnail mt-4 mb-2"
                                        style="width: 150px; z-index: 1"
                                        style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;" alt="">
                                @else
                                    @if (Auth::user()->foto_profil != null)
                                        <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                                            class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1"
                                            style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                            alt="">
                                    @else
                                        <img src="{{ asset('profile-default.png') }}" class="img-fluid img-thumbnail mt-4 mb-2"
                                            style="width: 150px; z-index: 1"
                                            style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                            alt="">
                                    @endif
                                @endguest
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_editprofil"
                                    class="btn btn-outline-dark mt-5" data-mdb-ripple-color="dark" style="z-index: 1;">
                                    Edit profil
                                </button>
                                <div class="modal" id="modal_editprofil" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="color: #000;">Edit profil anda.</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="FormUpdateProfil" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body" style="color: #000;">
                                                    <div class="mb-3">
                                                        <label for="foto_profil" class="form-label">Foto Profil</label>
                                                        <input type="file" name="foto_profil" id="foto_profil" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tentang" class="form-label">Tentang</label>
                                                        <textarea name="tentang" id="tentang" cols="15" rows="5" class="form-control">{{ Auth::user()->tentang }}</textarea></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button onclick="UpdateProfil()" type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{ Auth::user()->name }}</h5>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5">{{ Auth::user()->Count_Photos() }}</p>
                                    <p class="small text-muted mb-0">Photos</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1">Tentang</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    {{ Auth::user()->tentang }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0">Postingan</p>
                            </div>
                            <div class="row">
                                @forelse (Auth::user()->Posts as $item)
                                <div class="col mb-2">
                                    <a href="/show_post/{{ $item->slug }}">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="image 1"
                                            class="w-100 rounded-3">
                                    </a>
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
            </div>
        </div>
    </section>
    <script>
        function UpdateProfil()
        {
            $("#FormUpdateProfil").off("submit");
            $("#FormUpdateProfil").submit(function (e) {
                e.preventDefault();
                let route = $(this).attr("action");
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    data: data,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, error, status) {
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
