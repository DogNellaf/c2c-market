@extends('layouts.home')
@section('title', 'Добавить отзыв')
@section('home-reviews', 'active')
@section('card')
  @if ($orders->count() == 0)
	<div class="row">
      <div class="col">
        Нет модели, на которую можно было бы оставить отзыв
      </div>
    </div>
  @else
	<form action="{{ route('home.reviews.create.method') }}" method="POST" enctype="multipart/form-data">
	  @csrf
	  <div class="mb-3">
		<label for="ad_id" class="form-label">Модель</label>
		<select class="form-select" name="ad_id">
		  @foreach ($orders as $order)
			<option value="{{ $order->ad_id }}">{{ $order->ad->title }}</option>
		  @endforeach
		</select>
		@error('ad_id')
		  <span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		  </span>
		@enderror
	  </div>
	  <div class="mb-3">
		<label for="title" class="form-label">Заголовок</label>
		<input name="title" id="title" class="form-control @error("title") is-invalid @enderror" type="text" value="{{old('title')}}"/>
		@error('title')
		  <span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		  </span>
		@enderror
	  </div>
	  <div class="mb-3">
		<label for="text" class="form-label">Текст</label>
		<textarea name="text" id="text" class="form-control @error("text") is-invalid @enderror" row="3">{{old('text')}}</textarea>
		@error('text')
		  <span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		  </span>
		@enderror
	  </div>
	  <div class="mb-3">
		<label for="is_recommended" class="form-label">Рекомендую ли я?</label>
		<select name="is_recommended" id="is_recommended" class="form-select @error("is_recommended") is-invalid @enderror">
		  <option value="True">Да</option>
		  <option value="False">Нет</option>
		</select>
		@error('is_recommended')
		  <span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		  </span>
		@enderror
	  </div>
	  <div class="mb-3">
	  	<label for="rate" class="form-label">Оценка</label>
		<input name="rate" id="rate" class="form-control  @error("rate") is-invalid @enderror" type="number" min="1" max="5" value="{{old('rate', 5)}}"/>
		@error('rate')
		  <span class="invalid-feedback" role="alert">
			<strong>{{ $message }}</strong>
		  </span>
		@enderror
	  </div>
	  <input type="submit" class="btn btn-primary" value="Добавить"/>
	</form>
  @endif
@endsection