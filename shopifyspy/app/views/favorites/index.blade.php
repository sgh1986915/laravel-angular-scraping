@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
| My Favorites
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

@stop