@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.blog.categories-form :category="\Astrogoat\Blog\Models\Category::make()"/>
@endsection
