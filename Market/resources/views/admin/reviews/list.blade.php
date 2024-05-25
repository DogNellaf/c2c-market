@extends('layouts.admin')
@section('title', 'Отзывы')
@section('admin_active', 'active')
@section('admin-reviews-active', 'active')
@section('card')
  @if ($reviews->count() == 0)
    <div class="row">
      <div class="col">
        Отзывы не найдены
      </div>
    </div>
  @else
    @foreach ($reviews as $review)
      <div class="row mt-3">
        <div class="col">
          <span class="ends">
            Имя пользователя
            <br>
            <strong>{{ $user->name }}</strong>
          </span>
        </div>
        <div class="col">
          <span class="bid">
            Заголовок
            <br>
            <strong>{{$review->title}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="bid">
            Рекомендует?
            <br>
            <strong>{{$review->is_recommended ? "Да" : "Нет"}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Оценка
            <br>
            <strong>{{ $review->rate }}</strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Статус
            <br>
            <strong>
              @if ($review->status == "Created")
                Создана
              @elseif ($review->status == "Rejected")
                Отклонена
              @elseif ($review->status == "Hidden")
                Скрыта
              @elseif ($review->status == "Showed")
                Отображается
              @endif  
            </strong>
          </span>                  
        </div>
        <div class="col">
          <span class="ends">
            <a class="btn btn-info mt-3">Подробнее</a>
          </span>
        </div>
        <div class="col">
          @if ($review->status == "Created" || $review->status == "Rejected")
            <form method="POST" action="#">
                @method('patch')
                @csrf
                <input class="btn btn-success mt-3" type="submit" value="Одобрить"/>
            </form>
          @else
            <form method="POST" action="#">
                @method('patch')
                @csrf
                <input class="btn btn-danger mt-3" type="submit" value="Отклонить"/>
            </form>
          @endif  
        </div>
      </div>  
    @endforeach
    {{ $reviews->links('pagination::bootstrap-4') }}
  @endif
@endsection