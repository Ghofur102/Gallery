@extends('layouts.app')

@section('content')
<style>
    .text-love {
        color: red !important;
    }
</style>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">
                    <b>
                        {{ $post->judul_gambar }}
                    </b>
                </h1>
                <a href="/profile-oranglain/{{ $post->User->id }}">
                    @guest
                    <img src="{{ asset('profile-default.png') }}"
                        style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;" alt="">
                @else
                    @if (Auth::user()->foto_profil != null)
                        <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                            style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;" alt="">
                    @else
                        <img src="{{ asset('profile-default.png') }}"
                            style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;" alt="">
                    @endif
                @endguest
                </a>
                - {{ \Carbon\Carbon::parse($post->created_at)->locale('id_ID')->diffForHumans() }}
            </div>
            <div class="">
                <img width="100%" src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->gambar }}"> <br>
                <b style="font-size: 20px;padding:5px;">
                    {{ $post->deskripsi_gambar }}
                </b>
            </div>
            <div class="card-footer" style="background-color: white;">
                <div class="d-flex">
                    @auth
                        @if ($post->Is_Like())
                            <button type="button" class="btn btn-light m-1"
                                onclick="LikePost({{ Auth::user()->id }}, {{ $post->User->id }}, {{ $post->id }})">
                                <svg id="like-postingan" class="text-love" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 1024 1024">
                                    <path fill="currentColor"
                                        d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7c0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4c47.6-20.3 78.3-66.8 78.3-118.4c0-12.6-1.8-25-5.4-37c16.8-22.2 26.1-49.4 26.1-77.7c0-12.6-1.8-25-5.4-37c16.8-22.2 26.1-49.4 26.1-77.7c-.2-12.6-2-25.1-5.6-37.1M184 852V568h81v284zm636.4-353l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7c9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43" />
                                </svg>
                                <b id="count-like-post">{{ $post->Count_Likes() }}</b>
                            </button>
                        @else
                            <button type="button" class="btn btn-light m-1"
                                onclick="LikePost({{ Auth::user()->id }}, {{ $post->User->id }}, {{ $post->id }})">
                                <svg id="like-postingan" class="text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 1024 1024">
                                    <path fill="currentColor"
                                        d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7c0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4c47.6-20.3 78.3-66.8 78.3-118.4c0-12.6-1.8-25-5.4-37c16.8-22.2 26.1-49.4 26.1-77.7c0-12.6-1.8-25-5.4-37c16.8-22.2 26.1-49.4 26.1-77.7c-.2-12.6-2-25.1-5.6-37.1M184 852V568h81v284zm636.4-353l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7c9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43" />
                                </svg>
                                <b id="count-like-post">{{ $post->Count_Likes() }}</b>
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-light m-1">
                            <svg id="like-postingan" class="text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 1024 1024">
                                <path fill="currentColor"
                                    d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7c0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 0 0 471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4c47.6-20.3 78.3-66.8 78.3-118.4c0-12.6-1.8-25-5.4-37c16.8-22.2 26.1-49.4 26.1-77.7c0-12.6-1.8-25-5.4-37c16.8-22.2 26.1-49.4 26.1-77.7c-.2-12.6-2-25.1-5.6-37.1M184 852V568h81v284zm636.4-353l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19l13.9 25.4a56.2 56.2 0 0 1 6.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0 1 42.2-32.3c7.6 0 15.1 2.2 21.1 6.7c9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43" />
                            </svg>
                        </button>
                    @endauth
                    <button type="button" class="btn btn-light m-1" data-bs-toggle="collapse"
                        data-bs-target="#collapse-comment">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M2 6a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-4.172a1 1 0 0 0-.707.293l-1.867 1.867C11.054 22.361 9 21.51 9 19.812A.812.812 0 0 0 8.188 19H5a3 3 0 0 1-3-3zm5 0a1 1 0 0 0 0 2h10a1 1 0 1 0 0-2zm0 4a1 1 0 1 0 0 2h10a1 1 0 1 0 0-2zm0 4a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="collapse" id="collapse-comment">
            <div class="my-3">
                <div class="">
                    @auth
                        <form id="FormComment"
                            action="{{ route('komentar.store', ['sender_id' => Auth::user()->id, 'recipient_id' => $post->User->id, 'post_id' => $post->id]) }}"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <textarea name="comment" id="main-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" onclick="StoreComment()" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    @else
                        <form id="FormComment"
                            action="{{ route('komentar.store', ['recipient_id' => $post->User->id, 'post_id' => $post->id]) }}"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    @endauth
                </div>
                <div id="main_comment"></div>
                @foreach ($post->Comments as $item)
                    @if ($item->parent_id == null)
                        <div class="my-3" style="border: 1px solid black;border-radius: 5px;">
                            <div class="card">
                                <div class="card-header">
                                    @guest
                                        <img src="{{ asset('profile-default.png') }}"
                                            style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                            alt="">
                                    @else
                                        @if (Auth::user()->foto_profil != null)
                                            <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                                                style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                alt="">
                                        @else
                                            <img src="{{ asset('profile-default.png') }}"
                                                style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                alt="">
                                        @endif
                                    @endguest
                                    <b>{{ $item->Sender->name }}</b>
                                </div>
                                <div class="card-body">
                                    {{ $item->komentar }}
                                </div>
                                <div class="card-footer d-flex">
                                    {{-- like --}}
                                    @auth
                                        <form id="FormLikeComment{{ $item->id }}"
                                            action="{{ route('like.comment', ['sender' => Auth::user()->id, 'recipient' => $item->Sender->id, 'comment' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit" onclick="LikeComment({{ $item->id }})"
                                                class="btn btn-light m-1">
                                                @if ($item->IsLike())
                                                    <svg id="svg_like{{ $item->id }}" class="text-love"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="1.5">
                                                            <path
                                                                d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                            <path stroke-linejoin="round" d="M7 20V9" />
                                                        </g>
                                                    </svg>
                                                @else
                                                    <svg id="svg_like{{ $item->id }}" class="text-secondary"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-width="1.5">
                                                            <path
                                                                d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                            <path stroke-linejoin="round" d="M7 20V9" />
                                                        </g>
                                                    </svg>
                                                @endif
                                                <b id="count_like_comment{{ $item->id }}">{{ $item->CountLikes() }}</b>
                                            </button>
                                        </form>
                                    @else
                                        <form
                                            action="{{ route('like.comment', ['recipient' => $item->Sender->id, 'comment' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="button" class="btn btn-light m-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-width="1.5">
                                                        <path
                                                            d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                        <path stroke-linejoin="round" d="M7 20V9" />
                                                    </g>
                                                </svg>
                                                <b id="count_like_comment{{ $item->id }}">{{ $item->CountLikes() }}</b>
                                            </button>
                                        </form>
                                    @endauth
                                    {{-- reply --}}
                                    <button type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-reply-comment{{ $item->id }}"
                                        class="btn btn-light m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 16 16">
                                            <path fill="currentColor"
                                                d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003A.5.5 0 0 0 13 5.503v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L11.293 5H8.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708zM10.5 11c1.86 0 3.505-.923 4.5-2.337V9.5a2.5 2.5 0 0 1-2.5 2.5H8.688l-3.063 2.68A.98.98 0 0 1 4 13.942V12h-.5A2.5 2.5 0 0 1 1 9.5v-5A2.5 2.5 0 0 1 3.5 2h2.757a5.5 5.5 0 0 0 4.243 9" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="collapse" id="collapse-reply-comment{{ $item->id }}">
                                    <div class="mx-5">
                                        <div class="my-2">
                                            @auth
                                                <form id="FormReplyComment{{ $item->id }}"
                                                    action="{{ route('komentar.store', ['sender_id' => Auth::user()->id, 'recipient_id' => $post->User->id, 'post_id' => $post->id, 'parent_id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                    </div>
                                                    <div class="mb-3 text-end">
                                                        <button type="submit"
                                                            onclick="StoreReplyComment({{ $item->id }})"
                                                            class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            @else
                                                <form id="FormReplyComment"
                                                    action="{{ route('komentar.store', ['recipient_id' => $post->User->id, 'post_id' => $post->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                    </div>
                                                    <div class="mb-3 text-end">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            @endauth
                                        </div>
                                        @foreach ($item->ReplyComment() as $reply)
                                            <div id="reply_comment{{ $reply->id }}"></div>
                                            <div class="my-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        @guest
                                                            <img src="{{ asset('profile-default.png') }}"
                                                                style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                                alt="">
                                                        @else
                                                            @if (Auth::user()->foto_profil != null)
                                                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                                                                    style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                                    alt="">
                                                            @else
                                                                <img src="{{ asset('profile-default.png') }}"
                                                                    style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                                    alt="">
                                                            @endif
                                                        @endguest
                                                        <b>{{ $reply->Sender->name }}</b>
                                                    </div>
                                                    <div class="card-body">
                                                        {{ $reply->komentar }}
                                                    </div>
                                                    <div class="card-footer d-flex">
                                                        {{-- like --}}
                                                        @auth
                                                            <form id="FormLikeComment{{ $reply->id }}"
                                                                action="{{ route('like.comment', ['sender' => Auth::user()->id, 'recipient' => $reply->Sender->id, 'comment' => $reply->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit"
                                                                    onclick="LikeComment({{ $reply->id }})"
                                                                    class="btn btn-light m-1">
                                                                    @if ($reply->IsLike())
                                                                        <svg id="svg_like{{ $reply->id }}"
                                                                            class="text-love"
                                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24">
                                                                            <g fill="none" stroke="currentColor"
                                                                                stroke-linecap="round" stroke-width="1.5">
                                                                                <path
                                                                                    d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                                <path stroke-linejoin="round" d="M7 20V9" />
                                                                            </g>
                                                                        </svg>
                                                                    @else
                                                                        <svg id="svg_like{{ $reply->id }}"
                                                                            class="text-secondary"
                                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24">
                                                                            <g fill="none" stroke="currentColor"
                                                                                stroke-linecap="round" stroke-width="1.5">
                                                                                <path
                                                                                    d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                                <path stroke-linejoin="round" d="M7 20V9" />
                                                                            </g>
                                                                        </svg>
                                                                    @endif
                                                                    <b
                                                                        id="count_like_comment{{ $reply->id }}">{{ $reply->CountLikes() }}</b>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('like.comment', ['recipient' => $reply->Sender->id, 'comment' => $reply->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="button" class="btn btn-light m-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24">
                                                                        <g fill="none" stroke="currentColor"
                                                                            stroke-linecap="round" stroke-width="1.5">
                                                                            <path
                                                                                d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                            <path stroke-linejoin="round" d="M7 20V9" />
                                                                        </g>
                                                                    </svg>
                                                                    <b
                                                                        id="count_like_comment{{ $reply->id }}">{{ $reply->CountLikes() }}</b>
                                                                </button>
                                                            </form>
                                                        @endauth
                                                        {{-- reply --}}
                                                        <button type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-reply-comment{{ $reply->id }}"
                                                            class="btn btn-light m-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 16 16">
                                                                <path fill="currentColor"
                                                                    d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003A.5.5 0 0 0 13 5.503v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L11.293 5H8.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708zM10.5 11c1.86 0 3.505-.923 4.5-2.337V9.5a2.5 2.5 0 0 1-2.5 2.5H8.688l-3.063 2.68A.98.98 0 0 1 4 13.942V12h-.5A2.5 2.5 0 0 1 1 9.5v-5A2.5 2.5 0 0 1 3.5 2h2.757a5.5 5.5 0 0 0 4.243 9" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="collapse" id="collapse-reply-comment{{ $reply->id }}">
                                                        @auth
                                                            <form id="FormReplyComment{{ $reply->id }}"
                                                                action="{{ route('komentar.store', ['sender_id' => Auth::user()->id, 'recipient_id' => $reply->Sender->id, 'post_id' => $post->id, 'parent_id' => $reply->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                                </div>
                                                                <div class="mb-3 text-end">
                                                                    <button type="submit"
                                                                        onclick="StoreReplyComment({{ $reply->id }})"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        @else
                                                            <form id="FormReplyComment"
                                                                action="{{ route('komentar.store', ['recipient_id' => $post->User->id, 'post_id' => $post->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                                </div>
                                                                <div class="mb-3 text-end">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach ($item->Reply2Comment() as $reply2)
                                            <div id="reply2_comment{{ $reply2->id }}"></div>
                                            <div class="my-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        @guest
                                                            <img src="{{ asset('profile-default.png') }}"
                                                                style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                                alt="">
                                                        @else
                                                            @if (Auth::user()->foto_profil != null)
                                                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                                                                    style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                                    alt="">
                                                            @else
                                                                <img src="{{ asset('profile-default.png') }}"
                                                                    style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                                    alt="">
                                                            @endif
                                                        @endguest
                                                        <b>{{ $reply2->Sender->name }}</b>
                                                    </div>
                                                    <div class="card-body">
                                                        {{ '@' . $reply2->Recipient->name }} {{ $reply2->komentar }}
                                                    </div>
                                                    <div class="card-footer d-flex">
                                                        {{-- like --}}
                                                        @auth
                                                            <form id="FormLikeComment{{ $reply2->id }}"
                                                                action="{{ route('like.comment', ['sender' => Auth::user()->id, 'recipient' => $reply2->Sender->id, 'comment' => $reply2->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit"
                                                                    onclick="LikeComment({{ $reply2->id }})"
                                                                    class="btn btn-light m-1">
                                                                    @if ($reply2->IsLike())
                                                                        <svg id="svg_like{{ $reply2->id }}"
                                                                            class="text-love"
                                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24">
                                                                            <g fill="none" stroke="currentColor"
                                                                                stroke-linecap="round" stroke-width="1.5">
                                                                                <path
                                                                                    d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                                <path stroke-linejoin="round" d="M7 20V9" />
                                                                            </g>
                                                                        </svg>
                                                                    @else
                                                                        <svg id="svg_like{{ $reply2->id }}"
                                                                            class="text-secondary"
                                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                                            height="24" viewBox="0 0 24 24">
                                                                            <g fill="none" stroke="currentColor"
                                                                                stroke-linecap="round" stroke-width="1.5">
                                                                                <path
                                                                                    d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                                <path stroke-linejoin="round" d="M7 20V9" />
                                                                            </g>
                                                                        </svg>
                                                                    @endif
                                                                    <b
                                                                        id="count_like_comment{{ $reply2->id }}">{{ $reply2->CountLikes() }}</b>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('like.comment', ['recipient' => $reply2->Sender->id, 'comment' => $reply2->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="button" class="btn btn-light m-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24">
                                                                        <g fill="none" stroke="currentColor"
                                                                            stroke-linecap="round" stroke-width="1.5">
                                                                            <path
                                                                                d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                            <path stroke-linejoin="round" d="M7 20V9" />
                                                                        </g>
                                                                    </svg>
                                                                    <b
                                                                        id="count_like_comment{{ $reply2->id }}">{{ $reply2->CountLikes() }}</b>
                                                                </button>
                                                            </form>
                                                        @endauth
                                                        {{-- reply --}}
                                                        <button type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-reply-comment{{ $reply2->id }}"
                                                            class="btn btn-light m-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 16 16">
                                                                <path fill="currentColor"
                                                                    d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003A.5.5 0 0 0 13 5.503v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L11.293 5H8.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708zM10.5 11c1.86 0 3.505-.923 4.5-2.337V9.5a2.5 2.5 0 0 1-2.5 2.5H8.688l-3.063 2.68A.98.98 0 0 1 4 13.942V12h-.5A2.5 2.5 0 0 1 1 9.5v-5A2.5 2.5 0 0 1 3.5 2h2.757a5.5 5.5 0 0 0 4.243 9" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="collapse" id="collapse-reply-comment{{ $reply2->id }}">
                                                        @auth
                                                            <form id="FormReply2Comment{{ $reply2->id }}"
                                                                action="{{ route('komentar.store', ['sender_id' => Auth::user()->id, 'recipient_id' => $reply2->Sender->id, 'post_id' => $post->id, 'parent_id' => $reply2->id, 'parent_main_id' => $item->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                                </div>
                                                                <div class="mb-3 text-end">
                                                                    <button type="submit"
                                                                        onclick="StoreReply2Comment({{ $reply2->id }})"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        @else
                                                            <form id="FormReplyComment"
                                                                action="{{ route('komentar.store', ['recipient_id' => $post->User->id, 'post_id' => $post->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                                </div>
                                                                <div class="mb-3 text-end">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="mt-3">
            <div class="row">
                @foreach ($posts as $item)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <a href="{{ route('show.post', $item->slug) }}">
                            <img width="100%" src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->gambar }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function LikePost(sender, recipient, id) {
            $.ajax({
                url: '/like-postingan/' + sender + '/' + recipient + '/' + id,
                method: 'POST',
                headers: {
                    'X-Csrf-Token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if ($("#like-postingan").hasClass('text-black')) {
                        $("#like-postingan").removeClass('text-black');
                        $("#like-postingan").addClass('text-love');
                        let new_count = parseInt($("#count-like-post").text()) + 1;
                        $("#count-like-post").html(new_count);
                    } else {
                        $("#like-postingan").removeClass('text-love');
                        $("#like-postingan").addClass('text-black');
                        let new_count = parseInt($("#count-like-post").text()) - 1;
                        $("#count-like-post").html(new_count);
                    }
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
        }
        @auth

        function LikeComment(id) {
            $("#FormLikeComment" + id).off("submit");
            $("#FormLikeComment" + id).submit(function(event) {
                event.preventDefault();
                let route = $(this).attr("action");
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    data: data,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if ($("#svg_like" + id).hasClass("text-secondary")) {
                            $("#svg_like" + id).removeClass("text-secondary");
                            $("#svg_like" + id).addClass("text-love");
                            let count = parseInt($("#count_like_comment" + id).text()) + 1;
                            $("#count_like_comment" + id).html(count);
                        } else {
                            $("#svg_like" + id).addClass("text-secondary");
                            $("#svg_like" + id).removeClass("text-love");
                            let count = parseInt($("#count_like_comment" + id).text()) - 1;
                            $("#count_like_comment" + id).html(count);
                        }
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            "title": "Error",
                            "message": xhr.responseText,
                            "position": "topCenter"
                        });
                    }
                });
            });
        }

        function StoreComment() {
            $("#FormComment").off("submit");
            $("#FormComment").submit(function(event) {
                event.preventDefault();
                let route = $(this).attr("action");
                let data = new FormData($(this)[0]);
                $.ajax({
                    url: route,
                    method: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("textarea").val("");
                        if (response.foto_profil != null) {
                            let foto = 'storage/'+response.foto_profil;
                        } else {
                            let foto = 'profile-default.png'
                        }
                        $("#main_comment").html(`
                    <div class="my-3">
                        <div class="card">
                            <div class="card-header">
                                <img src="{{ asset('${foto}') }}"
                                    style="width: 50px;height: 50px;border-radius: 50%;object-fit:cover;" alt="">
                                <b>{{ Auth::user()->name }}</b>
                            </div>
                            <div class="card-body">
                                ${response.komentar}
                            </div>
                            <div class="card-footer d-flex">
                                {{-- like --}}
                                    <form id="FormLikeComment${response.id}"
                                        action="/like-comment/{{ Auth::user()->id }}/${response.recipient_id}/${response.id}"
                                        method="post">
                                        @csrf
                                        <button type="submit" onclick="LikeComment(${response.id})"
                                            class="btn btn-light m-1">
                                                <svg id="svg_like${response.id}" class="text-secondary"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-width="1.5">
                                                        <path
                                                            d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                        <path stroke-linejoin="round" d="M7 20V9" />
                                                    </g>
                                                </svg>
                                                <b id="count_like_comment${response.id}">0</b>
                                        </button>
                                    </form>
                                {{-- reply --}}
                                <button type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-reply-comment${response.id}"
                                    class="btn btn-light m-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 16 16">
                                        <path fill="currentColor"
                                            d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003A.5.5 0 0 0 13 5.503v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L11.293 5H8.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708zM10.5 11c1.86 0 3.505-.923 4.5-2.337V9.5a2.5 2.5 0 0 1-2.5 2.5H8.688l-3.063 2.68A.98.98 0 0 1 4 13.942V12h-.5A2.5 2.5 0 0 1 1 9.5v-5A2.5 2.5 0 0 1 3.5 2h2.757a5.5 5.5 0 0 0 4.243 9" />
                                    </svg>
                                </button>
                            </div>
                            <div class="collapse" id="collapse-reply-comment${response.id}">
                                    <form id="FormReplyComment${response.id}"
                                        action="/komentar?sender_id={{ Auth::user()->id }}&recipient_id=${response.recipient_id}&post_id=${response.post_id}&parent_id=${response.id}"
                                        method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button type="submit" onclick="StoreReplyComment(${response.id})"
                                                class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                    <div id="reply_comment${response.id}"></div>
                            </div>
                        </div>
                    </div>
                        `);
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            "title": "Error",
                            "message": xhr.responseText,
                            "position": "topCenter"
                        });
                    }
                });
            });
        }

        function StoreReplyComment(id) {
            $("#FormReplyComment" + id).off("submit");
            $("#FormReplyComment" + id).submit(function(e) {
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
                        $("textarea").val("");
                        if (response.foto_profil != null) {
                            let foto = 'storage/'+response.foto_profil;
                        } else {
                            let foto = 'profile-default.png'
                        }
                        $("#reply_comment" + id).html(`
                                        <div id="reply2_comment${response.id}"></div>
                                        <div class="my-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <img src="{{ asset('${foto}') }}"
                                                        style="width: 50px;height: 50px;border-radius: 50%;object-fit:cover;"
                                                        alt="">
                                                    <b>{{ Auth::user()->name }}</b>
                                                </div>
                                                <div class="card-body">
                                                    @${response.recipient_name} ${response.komentar}
                                                </div>
                                                <div class="card-footer d-flex">
                                                    {{-- like --}}
                                                        <form id="FormLikeComment${response.id}"
                                                            action="/like-comment/{{ Auth::user()->id }}/${response.recipient_id}/${response.id}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" onclick="LikeComment(${response.id})"
                                                                class="btn btn-light m-1">
                                                                    <svg id="svg_like${response.id}"
                                                                        class="text-secondary"
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24">
                                                                        <g fill="none" stroke="currentColor"
                                                                            stroke-linecap="round" stroke-width="1.5">
                                                                            <path
                                                                                d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                            <path stroke-linejoin="round" d="M7 20V9" />
                                                                        </g>
                                                                    </svg>
                                                                    <b id="count_like_comment${response.id}">0</b>
                                                            </button>
                                                        </form>
                                                    {{-- reply --}}
                                                    <button type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-reply-comment${response.id}"
                                                        class="btn btn-light m-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 16 16">
                                                            <path fill="currentColor"
                                                                d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003A.5.5 0 0 0 13 5.503v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L11.293 5H8.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708zM10.5 11c1.86 0 3.505-.923 4.5-2.337V9.5a2.5 2.5 0 0 1-2.5 2.5H8.688l-3.063 2.68A.98.98 0 0 1 4 13.942V12h-.5A2.5 2.5 0 0 1 1 9.5v-5A2.5 2.5 0 0 1 3.5 2h2.757a5.5 5.5 0 0 0 4.243 9" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="collapse" id="collapse-reply-comment${response.id}">
                                                        <form id="FormReply2Comment${response.id}"
                                                            action="/komentar?sender_id={{ Auth::user()->id }}&recipient_id=${response.recipient_id}&post_id=${response.post_id}&parent_id=${response.id}&parent_main_id=${response.parent_id}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                            </div>
                                                            <div class="mb-3 text-end">
                                                                <button type="submit"
                                                                    onclick="StoreReply2Comment(${response.id})"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                        `);
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            "title": "Error",
                            "message": xhr.responseText,
                            "position": "topCenter"
                        });
                    }
                });
            });
        }

        function StoreReply2Comment(id) {
            $("#FormReply2Comment" + id).off("submit");
            $("#FormReply2Comment" + id).submit(function(e) {
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
                        $("textarea").val("");
                        if (response.foto_profil != null) {
                            let foto = 'storage/'+response.foto_profil;
                        } else {
                            let foto = 'profile-default.png'
                        }
                        $("#reply2_comment" + id).html(`
                                        <div id="reply2_comment${response.id}"></div>
                                        <div class="my-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <img src="{{ asset('${foto}') }}"
                                                        style="width: 50px;height: 50px;border-radius: 50%;object-fit:cover;"
                                                        alt="">
                                                    <b>{{ Auth::user()->name }}</b>
                                                </div>
                                                <div class="card-body">
                                                    @${response.recipient_name} ${response.komentar}
                                                </div>
                                                <div class="card-footer d-flex">
                                                    {{-- like --}}
                                                        <form id="FormLikeComment${response.id}"
                                                            action="/like-comment/{{ Auth::user()->id }}/${response.recipient_id}/${response.id}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" onclick="LikeComment(${response.id})"
                                                                class="btn btn-light m-1">
                                                                    <svg id="svg_like${response.id}"
                                                                        class="text-secondary"
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24">
                                                                        <g fill="none" stroke="currentColor"
                                                                            stroke-linecap="round" stroke-width="1.5">
                                                                            <path
                                                                                d="M16.472 20H4.1a.6.6 0 0 1-.6-.6V9.6a.6.6 0 0 1 .6-.6h2.768a2 2 0 0 0 1.715-.971l2.71-4.517a1.631 1.631 0 0 1 2.961 1.308l-1.022 3.408a.6.6 0 0 0 .574.772h4.576a2 2 0 0 1 1.929 2.526l-1.91 7A2 2 0 0 1 16.473 20Z" />
                                                                            <path stroke-linejoin="round" d="M7 20V9" />
                                                                        </g>
                                                                    </svg>
                                                                    <b id="count_like_comment${response.id}">0</b>
                                                            </button>
                                                        </form>
                                                    {{-- reply --}}
                                                    <button type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-reply-comment${response.id}"
                                                        class="btn btn-light m-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 16 16">
                                                            <path fill="currentColor"
                                                                d="M15 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003A.5.5 0 0 0 13 5.503v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L11.293 5H8.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708zM10.5 11c1.86 0 3.505-.923 4.5-2.337V9.5a2.5 2.5 0 0 1-2.5 2.5H8.688l-3.063 2.68A.98.98 0 0 1 4 13.942V12h-.5A2.5 2.5 0 0 1 1 9.5v-5A2.5 2.5 0 0 1 3.5 2h2.757a5.5 5.5 0 0 0 4.243 9" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="collapse" id="collapse-reply-comment${response.id}">
                                                        <form id="FormReply2Comment${response.id}"
                                                            action="/komentar?sender_id={{ Auth::user()->id }}&recipient_id=${response.recipient_id}&post_id=${response.post_id}&parent_id=${response.id}&parent_main_id=${response.parent_main_id}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <textarea name="comment" id="reply-comment" class="form-control" rows="3" placeholder="Masukkan komentar."></textarea>
                                                            </div>
                                                            <div class="mb-3 text-end">
                                                                <button type="submit"
                                                                    onclick="StoreReply2Comment(${response.id})"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                        `);
                    },
                    error: function(xhr, error, status) {
                        iziToast.destroy();
                        iziToast.error({
                            "title": "Error",
                            "message": xhr.responseText,
                            "position": "topCenter"
                        });
                    }
                });
            });
        }
        @endauth
    </script>
@endsection
