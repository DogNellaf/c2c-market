@extends('layouts.home')
@section('title', 'Купленные модели')
@section('home-bought_active', 'active')
@section('card')
    @if ($ads->count() == 0)
        <div class="row">
            <div class="col">
                У вас нет купленных моделей
            </div>
        </div>
    @else
        @foreach ($ads as $ad)
            <div class="row own-ads">
                <div class="col">
                    <span class="bid">
                        Название<br><strong>{{$ad->title}}</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        Цена покупки<br><strong>{{$ad->price}} Руб.</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        <img id="avatar_img" src="{{ $ad->photo_url }}"/>
                    </span>
                </div>
                <div class="col">
                    <br>
                    <a class="btn btn-info" href="{{ $ad->model_url }}" download>Скачать</a>
                </div>
            </div>  
        @endforeach
    @endif
@endsection