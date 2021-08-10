@if($like->user->image)
    <img src="{{ route('user.avatar', ['filename' => $like->user->image]) }}" alt="">
@endif 