@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="contenedor-2">
                    <div class="content-image">
                        <img src="{{ route('image.public', ['filename' => $image->image_path]) }}" alt="">
                    </div>
                    <div class="data">
                        <div class="user-info">
                            <div class="image-profile">
                                @if ( $image->user->image)
                                    
                                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar"
                                alt="">
                                @endif
                            </div>
                            <div class="info">
                                <p>{{ $image->user->name . ' ' . $image->user->surname }}</p>
                                <span>{{ $image->description }}</span>
                            </div>
                        </div>

                        <div class="image-comments" style="width: 100%; height: 100%; overflow-y: scroll;">
                            <div class="content-comment">
                                @if (count($image->comments) >= 1)
                                    @foreach ($image->comments as $comment)
                                        <div class="comentario-general">
                                            <div class="contenedor-perfiles">
                                                @isset($comment->user->image)
                                                    <img src="{{ route('user.avatar', ['filename' => $comment->user->image]) }}"
                                                        class="avatar" alt="profile">
                                                @else
                                                    <img src="{{ asset('img/null-profile.png') }}" class="avatar"
                                                        alt="profile">
                                                @endisset
                                            </div>

                                            <div class="contenedor-comentarios">
                                                <span class="nickname">{{ $comment->user->nick }}</span>
                                                <span>{{ $comment->content }}</span>
                                                @can('delete', $comment)
                                                    <span>
                                                        <a class="btn btn-danger btn-sm" href="#"
                                                            onclick="event.preventDefault();
                                                                            document.getElementById('delete-comment').submit();">Eliminar
                                                        </a>
                                                    </span>
                                                @endcan
                                                @if ($comment->created_at != null)
                                                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                                                @endif
                                            </div>
                                            @can('delete', $comment)
                                                <form id="delete-comment" class="d-none"
                                                    action="{{ route('delete.comment', $comment) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                </form>
                                            @endcan

                                        </div>
                                    @endforeach
                                @else
                                    <div class="no-comment">
                                        <p>AÚN NO HAY COMENTARIOS</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- comprobar si el usuario identificado le dio like a la publicacion (INICIO) --}}
                        <?php $user_like = false; ?>
                        @foreach ($image->likes as $like)
                            @if ($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        <div class="image-likes">
                            <div class="image-heart">
                                @if ($user_like)
                                    <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="on"
                                        name="like" alt="like">
                                @else
                                    <img src="{{ asset('img/heart-black.png') }}" data-id="{{ $image->id }}"
                                        class="off" name="like" alt="dislike">
                                @endif
                            </div>
                            <div class="image-comment">
                                <img src="{{ asset('img/comment.png') }}" alt="comment">
                            </div>
                        </div>
                        <div class="comment">
                            <form action="{{ route('save.comment', $image) }}" method="POST">
                                @csrf
                                <textarea name="content" id="content" cols="30"
                                    class="form-control @error('content') is-invalid @enderror" rows="10"
                                    placeholder="Escribe un comentario"></textarea>
                                <input type="submit" class="btn btn-primary" value="Publicar">
                            </form>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
