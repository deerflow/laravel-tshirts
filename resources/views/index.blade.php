@extends('layouts.app')

@section('title', 'Build your t-shirt')

@section('body')
    <form method="POST" action="{{ route('historic.new') }}" enctype="multipart/form-data">
        @csrf
        <h2 class="pt-2">Choose a T-shirt</h2>
        <div class="row my-4">
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
        <h2 class="pt-2">Choose an image</h2>
        <div class="row my-4">
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
                            <img src="{{ $image->url }}" class="card-img-top img-fluid" alt="{{ $image->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $image->name }}</h5>
                            </div>
                        </div>
                    </label>
                </div>
            @endforeach
            <div class="col-6">
                <label class="d-flex" for="user-image-card" style="height: fit-content">
                    <input
                        class="invisible-radio"
                        type="radio"
                        name="image"
                        value="user-image"
                        id="user-image-card"
                    />
                    <div class="card card-radio" style="width: 36rem;">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <label for="user-image" class="card-title text-center mb-4 mt-2"
                                       style="font-size: 1.5rem; font-weight: 500">Or
                                    upload your own
                                    :</label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="file" class="form-control mb-4" style="width: fit-content"
                                       id="user-image" name="user-image">
                            </div>
                        </div>
                    </div>
                </label>
            </div>
            <div class="my-4">
                <button class="btn btn-primary" type="submit">Generate t-shirt</button>
            </div>
        </div>
    </form>
@endsection
