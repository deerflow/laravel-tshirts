@extends('layouts.app')

@section('title', 'Build your t-shirt')

@section('body')
    <form method="POST" action="{{ route('combination.result') }}">
        @csrf
        <h2>Choose a T-shirt</h2>
        <div class="row">
            @foreach($tshirts as $tshirt)
                <div class="col-3">
                    <label class="d-flex" for="tshirt-{{ $tshirt->id }}">
                        <input
                            class="invisible-radio"
                            type="radio"
                            name="tshirt"
                            value="{{ $tshirt->id }}"
                            id="tshirt-{{ $tshirt->id }}"
                        />
                        <div class="card card-radio" style="width: 18rem;">
                            <img src="{{ $tshirt->url }}" class="card-img-top" alt="{{ $tshirt->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tshirt->name }}</h5>
                            </div>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>
        <h2>Choose an image</h2>
        <div class="row">
            @foreach($images as $image)
                <div class="col-3">
                    <label class="d-flex" for="image-{{ $image->id }}">
                        <input
                            class="invisible-radio"
                            type="radio"
                            name="image"
                            value="{{ $image->id }}"
                            id="image-{{ $image->id }}"
                        />
                        <div class="card card-radio" style="width: 18rem;">
                            <img src="{{ $image->url }}" class="card-img-top" alt="{{ $image->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $image->name }}</h5>
                            </div>
                        </div>
                    </label>
                </div>
            @endforeach
        </div>
        <div class="my-4">
            <button class="btn btn-primary" type="submit">Generate t-shirt</button>
        </div>
    </form>
@endsection
