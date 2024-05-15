@extends('layouts.home')
@section('title', 'Отзывы')
@section('home-reviews_active', 'active')
@section('card')
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col text-right">
            <a class="btn btn-primary create" href="{{ route('home.reviews.create.page') }}">Создать</a>
        </div>
    </div>
    @if ($reviews->count() == 0)
        <div class="row">
            <div class="col">
                Вы еще не оставляли отзывы
            </div>
        </div>
    @else
        @foreach ($reviews as $review)
            <div class="row">
                <div class="col">
                    <span class="bid">
                        Заголовок<br><strong>{{$review->title}}</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        Рекомендовал ли я?<br><strong>{{$review->is_recommended == 1 ? 'Да' : 'Нет'}}</strong>
                    </span>
                </div>
                <div class="col">
                    <span class="bid">
                        Оценка (от 1 до 5):<br><strong>{{$review->rate}}</strong>
                    </span>
                </div>
                <div class="col">
                    <a class="btn btn-info mt-2" href="{{ route('home.reviews.edit.page', ['review' => $review]) }}">Подробнее</a>
                </div>
            </div>  
        @endforeach
		{{ $reviews->links('pagination::bootstrap-4') }}
    @endif
@endsection