@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.blog.articles-form :article="\Astrogoat\Blog\Models\Article::make()"/>
@endsection
