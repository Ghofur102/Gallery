@extends('layouts.app')

@section('content')
    <section style="font-family: UnifrakturCook;">
        <div class="text-center mx-5">
            <h1>Welcome To Website <span style="color: black;">Gall</span></h1>
            <h3>
                Tempat dimana anda dapat membagikan foto-foto terbaik anda serta mendapat inspirasi dari berbagai foto
                unggahan pengguna lain.
                Bagikan foto dan carilah inspirasi, <span style="color: black;">apapun itu membuat hidup anda menjadi lebih
                    baik.</span>
            </h3>
        </div>
    </section>
    @if ($posts_count > 0)
    <div id="carouselExampleIndicators" class="carousel slide w-100">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 0"></button>
            @foreach ($posts as $num => $item)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $num+=1 }}" class="active"
            aria-current="true" aria-label="Slide {{ $num+=1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="object-fit:cover;" height="300px;" src="{{ asset('storage/'.$post_first->gambar) }}" class="d-block w-100" alt="...">
            </div>
            @foreach ($posts as $item)
            <div class="carousel-item">
                <img style="object-fit:cover;" height="300px;" src="{{ asset('storage/'.$item->gambar) }}" class="d-block w-100" alt="...">
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif
    <section style="font-family: UnifrakturCook;">
        <div class="text-center mx-5 my-3">
            <h3 style="color: black;">
              Jangan lupa untuk membagikan foto terbaik anda disini.
            </h3>
        </div>
    </section>
@endsection
