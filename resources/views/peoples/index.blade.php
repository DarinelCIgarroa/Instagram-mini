@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Nuestros Socios</h1>
                <p class="lead my-3">
                    Aquí encontraras a todos nuestros socios registrados, juntos hacemos de esta red social algo mejor.
                    En el pasado eras lo que tenías.
                    Ahora eres lo que compartes.
                </p>
                {{-- <p class="lead mb-0"><a href="#" class="text-white fw-bold">Descubrir...</a></p> --}}
            </div>
        </div>
        <div class="col-md-12 data-people">
            @foreach ($users as $user)
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative content-profile">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">Vendedor</strong>
                        <h3 class="mb-0">{{ $user->name }}</h3>
                        <div class="mb-1 text-muted">{{ $user->created_at->diffForHumans() }}</div>
                        <p class="mb-auto">{{ $user->description }}</p>
                        <a href="{{ route('user.profile', $user->id) }}" class="stretched-link">Ir al perfil...</a>
                    </div>
                    <div class="col-auto d-none d-lg-block avatar-data">
                        @if ($user->image)
                            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar"
                                alt="profile picture">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
