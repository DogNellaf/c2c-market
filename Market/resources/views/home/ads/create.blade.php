@extends('layouts.home')
@section('title', 'Добавить модель')
@section('home-own_active', 'active')
@section('card')
	<form action="{{ route('home.ads.create.method') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
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
			<input name="price" id="price" class="form-control @error("price") is-invalid @enderror" type="number" value="{{old('price', $user->price)}}"/>
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
			<label for="model" class="form-label">Модель</label>
			<input type="file" class="form-control @error("model") is-invalid @enderror" id="model" name="model" accept=".fbx,.stl,.obj,.dae,.3ds,.iges,.step,.vrml,.x3d,.bland,.amf,.3mf">
			@error('model')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror
		</div>
		<div class="mb-3">
			<label for="photo" class="form-label">Фото модели</label>
			<input type="file" class="form-control @error("photo") is-invalid @enderror" id="photo" name="photo" accept=".png,.jpg,.webp">
			@error('photo')
				<span class="invalid-feedback" role="alert">
					<strong>Файл имеет слишком большой размер и не может быть загружен.</strong>
				</span>
            @enderror
		</div>
		<input type="submit" class="btn btn-primary" value="Добавить">
	</form>
@endsection