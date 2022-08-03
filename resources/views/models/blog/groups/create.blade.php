@extends('lego::layouts.lego')

@section('content')
    <livewire:astrogoat.blog.groups-form :group="\Astrogoat\Blog\Models\Group::make()"/>
@endsection
