@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.blog.articles-form :article="$article"/>
@endsection
