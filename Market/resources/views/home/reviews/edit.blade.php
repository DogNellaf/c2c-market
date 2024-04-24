@extends('layouts.app')

@section('title', 'Добавление отзыва')

@section('content')
<form action="{{ route('reviews.edit.method') }}" method="POST">
	@csrf
	@method('PATCH')
	<div class="mb-3">
		<label for="txtTitle" class="form-label">Название</label>
		<input name="title" id="txtTitle" class="form-control" value="{{ $review->title }}">
	</div>
	<div class="mb-3">
		<label for="txtText" class="form-label">Текст</label>
		<textarea name="text" id="txtText" class="form-control" row="3">{{ $review->text }}</textarea>
	</div>
	<div class="mb-3">
		<label for="txtRecommended" class="form-label">Рекомендуется</label>
		<input type="checkbox" name="is_recommended" id="txtRecommended" class="form-control" value="{{ $review->is_recommended }}"/>
	</div>
	<div class="mb-3">
		<label for="txtRate" class="form-label">Оценка</label>
		<input type="number" name="rate" id="txtRate" class="form-control" value="{{ $review->rate }}"/>
	</div>
	<input type="submit" class="btn btn-primary" value="Добавить">
</form>
@endsection('content')