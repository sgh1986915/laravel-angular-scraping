@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.helloworld')}}
@stop

{{-- Content --}}
@section('content')

@foreach ($trendData as $row)

<div class="row well well-sm">
	<div class="row">
		<div class="col-xs-12">
			<a href="{{URL::to('search')}}#/{{str_replace(" ", "+", $row["info"]["heading"])}}"><h2>{{$row["info"]["heading"]}}</h2></a>
		</div>		
	</div>
	<div class="row">	
		<div class="col-xs-9">
			<p>{{$row["article"]["title"]}}</p>
			<p>{{$row["info"]["text"]}}</p>		
			<p>{{$row["article"]["description"]}}</p>
			<p><a target="_blank" href="{{$row["article"]["url"]}}">Full Story Here</a></p>
		</div>
		<div class="col-xs-3">
			<img class="col-xs-12" src="{{$row["article"]["thumbnail_url"]}}" />	
		</div>
	</div>
</div>

@endforeach

@stop