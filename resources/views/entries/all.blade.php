@extends('layouts.app')
@section('title', 'All entries')
@section('body')
    @foreach($entries as $entry)
        <img src="{{ $entry->url }}" alt="A custom t-shirt"/>
    @endforeach
@endsection
