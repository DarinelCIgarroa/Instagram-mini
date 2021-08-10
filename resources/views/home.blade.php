@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($images as $image)
                    @include('includes.image',['image' => $image])
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $images->links() !!}
    </div>
@endsection
