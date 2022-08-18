@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <livewire:astrogoat.blog.categories-form :category="$category"/>
@endsection
