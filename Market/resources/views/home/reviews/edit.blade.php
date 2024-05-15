@extends('layouts.home')
@section('title', 'Редактировать отзыв')
@section('home-reviews_active', 'active')
@section('card')
	<form action="{{ route('home.reviews.edit.method', ['review' => $review]) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PATCH')
		<div class="mb-3">
			<label for="title" class="form-label">Заголовок</label>
			<input name="title" id="title" class="form-control @error("title") is-invalid @enderror" type="text" value="{{old('title', $review->title)}}"/>
			@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="mb-3">
			<label for="text" class="form-label">Текст</label>
			<textarea name="text" id="text" class="form-control @error("text") is-invalid @enderror" row="3">{{old('text', $review->text)}}</textarea>
			@error('text')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="mb-3">
			<label for="is_recommended" class="form-label">Рекомендую ли я?</label>
			<select name="is_recommended" id="is_recommended" class="form-select @error("is_recommended") is-invalid @enderror">	
				<option value="True" @if ($review->is_recommended) selected @endif>Да</option>
				<option value="False" @if (!$review->is_recommended) selected @endif>Нет</option>
			</select>
			@error('is_recommended')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="mb-3">
			<label for="rate" class="form-label">Оценка</label>
			<input name="rate" id="rate" class="form-control  @error("rate") is-invalid @enderror" type="number"  min="1" max="5" value="{{old('rate', $review->rate)}}"/>
			@error('rate')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<input type="submit" class="btn btn-primary" value="Сохранить">
	</form>
@endsection