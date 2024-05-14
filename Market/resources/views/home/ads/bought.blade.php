@extends('layouts.home')
@section('title', 'Купленные модели')
@section('home-bought_active', 'active')
@section('card')
    @if ($orders->count() == 0)
        <div class="row">
            <div class="col">
                У вас нет купленных моделей
            </div>
        </div>
    @else
        @foreach ($orders as $order)
            <div class="row">
                <div class="col">
                    <span class="bid">
                        Название<br><strong>{{$order->ad->title}}</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        Цена покупки<br><strong>{{$order->price}} руб.</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        <img id="avatar_img" src="{{ asset($order->ad->photo_link) }}" style="width: 90px; height: 70px;"/>
                    </span>
                </div>
                <div class="col">
                    <a class="btn btn-info mt-4" href="{{ asset($order->ad->model_link) }}" download>Скачать</a>
                </div>
            </div>  
        @endforeach
    @endif
@endsection