@extends('layouts.home')
@section('title', 'Личный кабинет')
@section('home-own_active', 'active')
@section('card')
    <div class="row">
        <div class="col-9"></div>
        <div class="col text-right">
            <a class="btn btn-primary create" href="{{ route('home.ads.create.page') }}">Создать</a>
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
            <div class="row own-ads">
                <div class="col">
                    <span class="bid">
                        Название<br><strong>{{$ad->title}}</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        Цена<br><strong>{{$ad->price}} Руб.</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="ends">
                        Средняя оценка<br><strong>{{ '-' }}</strong>
                    </span>
                </div>
                <div class="col">
                    <a class="btn btn-info detail" href="{{ route('home.ads.edit.page', ['ad' => $ad]) }}">Подробнее</a>
                </div>
            </div>  
        @endforeach
    @endif
@endsection