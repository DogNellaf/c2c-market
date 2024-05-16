@extends('layouts.home')
@section('title', 'Личный кабинет')
@section('home-own_active', 'active')
@section('card')
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
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
            <div class="row">
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
                        Оценка<br><strong>
                        {{  $ad->get_average_rating() == "" ? "Нет": $ad->get_average_rating() }}
                        </strong>
                    </span>
                </div>
                <div class="col">
                    <a class="btn btn-info mt-3" href="{{ route('home.ads.edit.page', ['ad' => $ad]) }}">Подробнее</a>
                </div>
                <div class="col">
                    @if ($ad->status == "Created")
                        Ожидайте подтверждения администратором
                    @elseif ($ad->status == "Rejected")
                        Ваша модель была отклонена, пожалуйста, отредактируйте в соответствии с <a href="{{ route('main.rules') }}">требованиями</a>.
                    @elseif ($ad->status == "Hidden")
                        <form method="POST" action="{{ route('home.ads.show.method', ['ad' => $ad]) }}">
                            @method('patch')
                            @csrf
                            <input class="btn btn-primary mt-3" type="submit" value="Отобразить"/>
                        </form>
                    @elseif ($ad->status == "Showed")
                        <form method="POST" action="{{ route('home.ads.hide.method', ['ad' => $ad]) }}">
                            @method('patch')
                            @csrf
                            <input class="btn btn-warning mt-3" type="submit" value="Скрыть"/>
                        </form>
                    @endif                    
                </div>
            </div>  
        @endforeach
        {{ $ads->links('pagination::bootstrap-4') }}
    @endif
@endsection