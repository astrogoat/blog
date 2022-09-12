@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.blog.categories-form :category="$category"/>
@endsection
