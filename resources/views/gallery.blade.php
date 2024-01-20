@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($posts as $item)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('show.post', $item->slug) }}">
                                <img width="100%" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->gambar }}">
                            </a>
                        </div>
                        <div class="card-footer">
                            <form id="form_album{{ $item->id }}" action="/album/{{ $item->id }}" method="post">
                                @csrf
                                <button type="submit" onclick="store_album({{ $item->id }})" class="btn btn-light">
                                    @if ($item->IsInAlbum())
                                        <svg id="svg_album{{ $item->id }}" class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z" />
                                        </svg>
                                    @else
                                        <svg id="svg_album{{ $item->id }}" class="text-secondary" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function store_album(id) {
            $("#form_album" + id).off('submit');
            $("#form_album" + id).submit(function (event) {
                event.preventDefault();
                let route = $(this).attr('action');
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    data: data,
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if ($("#svg_album" + id).hasClass('text-secondary')) {
                            $("#svg_album" + id).removeClass('text-secondary');
                            $("#svg_album" + id).addClass('text-primary');
                        } else {
                            $("#svg_album" + id).removeClass('text-primary');
                            $("#svg_album" + id).addClass('text-secondary');
                        }
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