@extends('layouts.app')

@section('content')
@livewire('plugin-page', ['plugin' => $plugin])
@endsection
