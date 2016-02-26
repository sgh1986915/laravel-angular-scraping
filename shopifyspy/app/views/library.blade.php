@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.libraryTitle')}}
@stop

{{-- Content --}}
@section('content')

@include('layouts.search_input')

@stop
