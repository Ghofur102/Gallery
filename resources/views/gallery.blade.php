@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($posts as $item)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card my-3">
                        <div class="" style="position:relative;">
                            <a href="{{ route('show.post', $item->slug) }}">
                                <img style="border-radius:6px;" class="object-fit-cover border rounded" width="100%" height="250px;"
                                    src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->gambar }}">
                            </a>
                            <form style="position:absolute;bottom:0px;" id="form_album{{ $item->id }}" action="/album/{{ $item->id }}" method="post">
                                @csrf
                                <button type="submit" onclick="store_album({{ $item->id }})" class="btn btn-light" style="background-color:transparent;border-color:transparent;">
                                    @auth
                                        @if ($item->IsInAlbum())
                                            <svg id="svg_album{{ $item->id }}" class="text-love"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z" />
                                            </svg>
                                        @else
                                            <svg id="svg_album{{ $item->id }}" class="text-secondary"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z" />
                                            </svg>
                                        @endif
                                    @else
                                        <svg id="svg_album{{ $item->id }}" class="text-secondary"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z" />
                                        </svg>
                                    @endauth
                                </button>
                            </form>
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
    <script>
        function store_album(id) {
            $("#form_album" + id).off('submit');
            $("#form_album" + id).submit(function(event) {
                event.preventDefault();
                let route = $(this).attr('action');
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    data: data,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if ($("#svg_album" + id).hasClass('text-secondary')) {
                            $("#svg_album" + id).removeClass('text-secondary');
                            $("#svg_album" + id).addClass('text-love');
                        } else {
                            $("#svg_album" + id).removeClass('text-love');
                            $("#svg_album" + id).addClass('text-secondary');
                        }
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
