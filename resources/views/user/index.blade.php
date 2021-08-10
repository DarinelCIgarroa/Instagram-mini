@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="profile-information">
                <div class="content-information">
                    <div class="img-profile">
                        @include('includes.avatar')
                    </div>
                    <div class="general-data">
                        <div class="name">
                            @if ($user)
                                <h2>{{ $user->name . ' ' . $user->surname }}</h2>
                            @else
                                <h2>{{ Auth::user()->name . ' ' . Auth::user()->surname }}</h2>
                            @endif
                        </div>
                        <div class="publication">
                            <span class="count">{{ $publications }}</span>
                            <span>publicacion(es)</span>
                        </div>
                        <div class="profile-data">
                            @if($user)
                                <p class="nick">{{ $user->nick }}</p>
                                <p class="date">Se unio {{ $user->created_at->diffForHumans() }}</p> 
                            @else
                                <p class="nick">{{ Auth::user()->nick }}</p>
                                <p class="date">Se unio {{ Auth::user()->created_at->diffForHumans() }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="content-galery">
                    @isset($images)
                        @foreach ($images as $image)
                            <div class="card">
                                <a href="{{ route('comment.show', $image) }}">
                                    <img src="{{ route('image.public', ['filename' => $image->image_path]) }}"
                                        class="card-img-top img-responsive" alt="{{ $image->image_path }}">
                                </a>
                                <div class="card-body">
                                    <p class="card-text">{{ $image->created_at->diffForHumans() }}</p>
                                    @can('delete', $image)
                                    <div class="content-button">
                                       
                                        <button type="button" class="btn btn-light" data-nombre="{{ $image->image_path }}" data-description="{{ $image->description }}" data-imageId="{{ $image->id }}"
                                            data-toggle="modal" data-target="#edit">
                                            <img src="{{ asset('img/edit.png') }}" alt="editar">
                                        </button>
                                        <button type="button" class="btn btn-light" data-catid="{{ $image->id }}"
                                            data-toggle="modal" data-target="#delete">
                                            <img src="{{ asset('img/delete.png') }}" alt="editar">
                                        </button>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Editar --}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('image.update', 'test') }}" method="post">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="image_id" id="image_id" value="">

                        <img src="{{ route('image.public', 'image_path') }}"
                            class="card-img-top img-responsive" id="image_path" alt="image_path">

                        <div class="mb-3">
                            <label for="image_path" class="col-form-label">Imagen:</label>
                            <input type="text" id="image_path" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="description">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Eliminar-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('image.destroy', 'test') }}" method="post">
                    @csrf @method('delete')
                    <div class="modal-body">
                        <p>¿Estas seguro de eliminar esta publicación?</p>
                        <input type="hidden" name="image_id" id="cat_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,
                            Cancelar</button>
                        <button type="submit" class="btn btn-primary">Sí, eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $images->links() !!}
    </div>
@endsection
