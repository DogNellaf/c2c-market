@extends('layouts.home')
@section('title', 'Добавить модель')
@section('home-own_active', 'active')
@section('card')
	<form action="{{ route('ad-create') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="txtTitle" class="form-label">Название</label>
			<input name="title" id="txtTitle" class="form-control">
		</div>
		<div class="mb-3">
			<label for="txtDescription" class="form-label">Описания</label>
			<textarea name="description" id="txtDescription" class="form-control" row="3"></textarea>
		</div>
		<div class="mb-3">
			<label for="txtPrice" class="form-label">Цена</label>
			<textarea name="price" id="txtPrice" class="form-control" row="3"></textarea>
		</div>
		<div class="mb-3">
			<label for="txtVideoLink" class="form-label">Видео</label>
			<textarea name="video_link" id="txtVideoLink" class="form-control" row="3"></textarea>
		</div>
		<div class="mb-3">
			<label for="txtModel_link" class="form-label">Модель</label>
			<textarea name="model_link" id="txtModel_link" class="form-control" row="3"></textarea>
		</div>
		<input type="submit" class="btn btn-primary" value="Добавить">
	</form>
@endsection