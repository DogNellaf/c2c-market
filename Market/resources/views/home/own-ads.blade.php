@extends('layouts.home')
@section('title', 'Личный кабинет')
@section('home-own_active', 'active')
@section('card')
    <div class="row">
        <div class="col-8"></div>
        <div class="col text-right">
            <a class="btn btn-info" href="{{ route('ad-create') }}">Добавить модель</a>
        </div>
    </div>
    @if ($ads->count() == 0)
        <div class="row">
            <div class="col">
                Модели не найдены
            </div>
        </div>
    @else
        @foreach ($ads as $ad)
            <div class="row">
                <div class="col">
                    <h4>{{$ad->title}}</h4>
                </div>
                <div class="col">
                    <span class="bid">
                        Цена<br><strong>{{$ad->price}} Руб.</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="ends">
                        Средняя оценка<br><strong>4.5</strong>
                    </span>
                </div>
                <div class="col">
                    <a href="{{ route('ad-detail', ['ad' => $ad]) }}">Подробнее</a>
                </div>
            </div>  
        @endforeach
    @endif
@endsection