@if (Auth::user()->image)
    <div class="container-avatar">
        <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" class="avatar"
            alt="profile picture">
    </div>
@elseif($user)
    <div class="container-avatar">
        <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar"
            alt="profile picture">
    </div>
@endif
