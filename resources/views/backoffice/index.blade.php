@extends('layouts.app')

@section('title', 'Back Office')

@section('body')
    <h1 class="mb-4">Back Office</h1>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <h2>T-shirts</h2>
        <div class="row my-4">
            @foreach($tshirts as $tshirt)
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $tshirt->url }}" class="card-img-top" alt="{{ $tshirt->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tshirt->name }}</h5>
                            <a href="#" class="btn btn-primary">Modifier</a>
                            <a href="#" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-3">
                <h3>Add a t-shirt</h3>
                <div class="my-3">
                    <label class="form-label" for="tshirt-name">T-shirt name</label>
                    <input class="form-control" type="text" id="tshirt-name" name="tshirt-name"/>
                </div>
                <div class="my-3">
                    <label class="form-label" for="add-tshirt">Upload file</label>
                    <input class="form-control" type="file" id="add-tshirt" name="tshirt-file"/>
                </div>
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
                            <a href="#" class="btn btn-primary">Modifier</a>
                            <a href="#" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-3">
                <h3>Add an image</h3>
                <div class="my-3">
                    <label class="form-label" for="image-name">Image name</label>
                    <input class="form-control" type="text" id="image-name" name="image-name"/>
                </div>
                <div class="my-3">
                    <label class="form-label" for="add-image">Upload file</label>
                    <input class="form-control" type="file" id="add-image" name="image-file"/>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Save uploaded items</button>
    </form>
@endsection
