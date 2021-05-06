@extends('layouts.app')

@section('title', 'Back Office')

@section('body')
    <h1 class="mb-4">Back Office</h1>
    <h2>T-shirts</h2>
    <div class="row my-4">
        @foreach($tshirts as $tshirt)
            <div class="col-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $tshirt->url }}" class="card-img-top" alt="{{ $tshirt->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tshirt->name }}</h5>
                        <div class="d-flex">
                            <form method="POST" class="me-1">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-primary">Modifier</button>
                            </form>
                            <form method="POST" action="{{ route('tshirt.remove', ['id' => $tshirt->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-3">
            <h3>Add a t-shirt</h3>
            <form method="POST" enctype="multipart/form-data" action="{{ route('tshirt.new') }}">
                @csrf
                <div class="my-3">
                    <label class="form-label" for="tshirt-name">T-shirt name</label>
                    <input class="form-control" type="text" id="tshirt-name" name="tshirt-name"/>
                </div>
                <div class="my-3">
                    <label class="form-label" for="add-tshirt">Upload file</label>
                    <input class="form-control" type="file" id="add-tshirt" name="tshirt-file"/>
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" type="submit">Save t-shirt</button>
                </div>
            </form>
        </div>
    </div>
    <h2>Images</h2>
    <div class="row my-4">
        @foreach($images as $image)
            <div class="col-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $image->url }}" class="card-img-top" alt="{{ $image->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->name }}</h5>
                        <div class="d-flex">
                            <form method="POST" class="me-1">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </form>
                            <form method="POST" action="{{ route('image.remove', ['id' => $image->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-3">
            <h3>Add an image</h3>
            <form method="POST" enctype="multipart/form-data" action="{{ route('image.new') }}">
                @csrf
                <div class="my-3">
                    <label class="form-label" for="image-name">Image name</label>
                    <input class="form-control" type="text" id="image-name" name="image-name"/>
                </div>
                <div class="my-3">
                    <label class="form-label" for="add-image">Upload file</label>
                    <input class="form-control" type="file" id="add-image" name="image-file"/>
                </div>
                <div class="my-4">
                    <button class="btn btn-primary" type="submit">Save image</button>
                </div>
            </form>
        </div>
    </div>
@endsection
