@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.blog.tags-form :tag="\Astrogoat\Blog\Models\Tag::make()"/>
@endsection
