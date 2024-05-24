@extends('layouts.home')
@section('title', 'Добавить модель')
@section('home-own_active', 'active')
@section('card')
  <form action="{{ route('home.ads.edit.method', ['ad' => $ad]) }}" method="POST">
	@csrf
	@method('PATCH')
	<div class="mb-3">
	  <label for="title" class="form-label">Название</label>
	  <input name="title" id="title" class="form-control @error("title") is-invalid @enderror" type="text" value="{{old('title', $ad->title)}}"/>
	  @error('title')
		<span class="invalid-feedback" role="alert">
		  <strong>{{ $message }}</strong>
		</span>
	  @enderror
	</div>
	<div class="mb-3">
	  <label for="description" class="form-label">Описания</label>
	  <textarea name="description" id="description" class="form-control @error("description") is-invalid @enderror" row="3">{{old('description', $ad->description)}}</textarea>
	  @error('description')
		<span class="invalid-feedback" role="alert">
		  <strong>{{ $message }}</strong>
		</span>
	  @enderror
	</div>
	<div class="mb-3">
	  <label for="price" class="form-label">Цена</label>
	  <input name="price" id="price" step="0.01" class="form-control @error("price") is-invalid @enderror" type="number" value="{{old('price', $ad->price)}}"/>
	  @error('price')
		<span class="invalid-feedback" role="alert">
		  <strong>{{ $message }}</strong>
		</span>
	  @enderror
	</div>
	<div class="mb-3">
	  <label for="video_link" class="form-label">Видео</label>
	  <input name="video_link" id="video_link" class="form-control  @error("video_link") is-invalid @enderror" type="url" placeholder="https://example.com" pattern="https://.*" value="{{old('video_link', $ad->video_link)}}"/>
	</div>
	<input type="submit" class="btn btn-primary" value="Сохранить">
  </form>
@endsection