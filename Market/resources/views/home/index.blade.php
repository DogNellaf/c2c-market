@extends('layouts.home')
@section('title', 'Личный кабинет')
@section('home-index_active', 'active')
@section('card')
    <form method="POST" action="{{ route('home.index.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="inputName" class="col-form-label">Логин</label>
            </div>
            <div class="col">
                <input type="text" class="form-control @error("name") is-invalid @enderror" id="inputName" name="name" value="{{old('name', $user->name)}}" placeholder="Введите логин">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="inputEmail" class="col-form-label">Email</label>
            </div>
            <div class="col">
                <input type="email" class="form-control @error("email") is-invalid @enderror" id="inputEmail" name="email" value="{{old('email', $user->email)}}" placeholder="Введите email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong> 
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="inputPassword" class="col-form-label">Пароль</label>
            </div>
            <div class="col">
                <input type="password" class="form-control @error("password") is-invalid @enderror" id="inputPassword" name="password" placeholder="Введите новый пароль">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="avatar" class="col-form-label">Аватар</label>
            </div>
            <div class="col">
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/png">
            </div>
            <div class="col-sm-2">
                <img id="avatar_img" src="{{$user->avatar_url}}"/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
