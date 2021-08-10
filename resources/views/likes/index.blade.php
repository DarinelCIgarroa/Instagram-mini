@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($likes as $like)
                    @include('includes.image',['image'=>$like->image])
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $likes->links() !!}
    </div>
@endsection
