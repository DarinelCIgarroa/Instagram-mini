<div class="card public-image">
    <div class="card-header">
        @if ($image->user->image)
            <div class="container-avatar">
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar"
                    alt="profile picture">
            </div>
        @endif
        <div class="data-user">
            <a href="{{ route('user.profile', $image->user->id) }}">
                <p>{{ $image->user->name }}</p>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.public', ['filename' => $image->image_path]) }}"
                alt="{{ $image->image_path }}">
        </div>
    </div>
    <div class="likes">
        {{-- comprobar si el usuario identificado le dio like a la publicacion (INICIO) --}}
        <?php $user_like = false; ?>
        @foreach ($image->likes as $like)
            @if ($like->user->id == Auth::user()->id)
                <?php $user_like = true; ?>
            @endif
        @endforeach
        {{-- Comprobar si el usuario identificado le dio like a la publicacion (CIERRE) --}}
        <div class="comment-like">
            <div class="likes-heart">
                @if ($user_like)
                <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="on" name="like"
                alt="like">
                @else
                    <img src="{{ asset('img/heart-black.png') }}" data-id="{{ $image->id }}" class="off" name="like"
                        alt="dislike">
                @endif
            </div>
            <div class="comment-icon">
                <a href="{{ route('comment.show', $image) }}"><img src="{{ asset('img/comentary.png') }}" alt="Comentario"></a>
            </div>
        </div>
        
        <div class="likes-people">
            <div class="profile-likes">
                @foreach ($image->likes->take(1) as $like)
                    @if (count($image->likes) >= 1)
                        <span>
                           @include('includes.avatar-comment')
                            Le gusta a {{ $like->user->nick }}
                            @if (count($image->likes) >= 2) y
                                {{ count($image->likes) - 1 }} personas más
                        </span>
                    @endif
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="description">
        <a href=""><span class="nickname">{{ '@' . $image->user->nick }}</span></a>
        <span class="description-image">{{ $image->description }}</span>
    </div>
    <div class="comments">
        @if (count($image->comments))
            <p><a href="{{ route('comment.show', $image) }}" class="count-comments">Ver los
                    {{ count($image->comments) }} comentarios</a>
            </p>
            @foreach ($image->comments->take(2) as $comment)
                <span class="nickname">{{ '@' . $comment->user->nick }}</span>
                <span class="comments-publication">{{ $comment->content }}</span>
                <br>
            @endforeach
        @else
            <a href="{{ route('comment.show', $image) }}" class="count-comments">
                Aun no hay comentarios
            </a>
        @endif
    </div>
    <div class="date">
        {{ $image->created_at->diffForHumans() }}
    </div>
</div>
