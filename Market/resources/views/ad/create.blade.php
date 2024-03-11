@extends('layouts.home')
@section('title', 'Добавить модель')
@section('home-own_active', 'active')
@section('card')
	<form action="{{ route('ad-create') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="title" class="form-label">Название</label>
			<input name="title" id="title" class="form-control @error("title") is-invalid @enderror" type="text" value="{{old('title', $user->title)}}"/>
			@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Описания</label>
			<textarea name="description" id="description" class="form-control @error("description") is-invalid @enderror" row="3">{{old('description', $user->description)}}</textarea>
			@error('description')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror
		</div>
		<div class="mb-3">
			<label for="price" class="form-label">Цена</label>
			<input name="price" id="price" class="form-control  @error("price") is-invalid @enderror" type="number" value="{{old('price', $user->price)}}"/>
			@error('price')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror
		</div>
		<div class="mb-3">
			<label for="video_link" class="form-label">Видео</label>
			<input name="video_link" id="video_link" class="form-control  @error("video_link") is-invalid @enderror" type="text" value="{{old('video_link', $user->video_link)}}"/>
			@error('video_link')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror
		</div>
		<div class="mb-3">
			<label for="model_link" class="form-label">Модель</label>
			<input type="file" class="form-control @error("model_link") is-invalid @enderror" id="model_link" name="model_link" accept=".fbx,.stl,.obj,.dae,.3ds,.iges,.step,.vrml,.x3d,.bland,.amf,.3mf">
			@error('model_link')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror
		</div>
		<input type="submit" class="btn btn-primary" value="Добавить">
	</form>
@endsection