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
                                    @if ($user->foto_profil != null)
                                        <img src="{{ asset('storage/' . $user->foto_profil) }}"
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
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{ $user->name }}</h5>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5">{{ $count_posts }}</p>
                                    <p class="small text-muted mb-0">Photos</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1">Tentang</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    {{ $user->tentang }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0">Postingan</p>
                            </div>
                            <div class="row">
                                @forelse ($user->Posts as $item)
                                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                                    <a href="/show_post/{{ $item->slug }}">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="image 1" class="object-fit-cover border rounded" width="100%" height="250px;"
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
@endsection
