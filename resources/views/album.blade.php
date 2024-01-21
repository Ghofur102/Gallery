@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($albums as $item)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="" style="position: relative;">
                            <a href="{{ route('show.post', $item->slug) }}">
                                <img width="100%" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->gambar }}">
                            </a>

                            <div class="p-3" style="position: absolute;bottom: 0px;" >
                                <svg data-bs-toggle="modal" data-bs-target="#confirmation_unalbum{{ $item->id }}"
                                    class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
                                                    <button type="submit" class="btn btn-danger">Hapus dari album</button>
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
    </div>
@endsection
