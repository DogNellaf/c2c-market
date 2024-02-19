@extends('layouts.app')
@section('title', 'Информация о модели')
@section('content')
	<h1>{{$ad->title}}</h1>
	<p>{{$ad->description}}</p>
	<p>{{$ad->price}}</p>
	<p>{{$ad->video_link}}</p>
	<p>{{$ad->model_link}}</p>
@endsection('content')