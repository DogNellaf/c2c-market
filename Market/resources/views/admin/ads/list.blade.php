@extends('layouts.admin')
@section('title', 'Панель администратора')
@section('admin_active', 'active')
@section('admin-ads-active', 'active')
@section('card')
  @if ($ads->count() == 0)
    <div class="row">
      <div class="col">
        Модели не найдены
      </div>
    </div>
  @else
    @foreach ($ads as $ad)
      <div class="row mt-3">
        <div class="col">
          <span class="bid">
            Название
            <br>
            <strong>{{$ad->title}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="bid">
            Цена
            <br>
            <strong>{{$ad->price}} Руб.</strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Оценка
            <br>
            <strong>
            {{ $ad->get_average_rating() == -1 ? "Нет" : $ad->get_average_rating() }}
            </strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Статус
            <br>
            <strong>
              @if ($ad->status == "Created")
                Создана
              @elseif ($ad->status == "Rejected")
                Отклонена
              @elseif ($ad->status == "Hidden")
                Скрыта
              @elseif ($ad->status == "Showed")
                Отображается
              @endif  
            </strong>
          </span>                  
        </div>
        <!-- <div class="col">
          <a class="btn btn-primary mt-2" href="{{ route('admin.ads.edit.page', ['ad' => $ad]) }}">Изменить</a>
        </div> -->
        <div class="col">
          @if ($ad->status == "Created" || $ad->status == "Rejected")
            <form method="POST" action="{{ route('admin.ads.approve.method', ['ad' => $ad]) }}">
                @method('patch')
                @csrf
                <input class="btn btn-success mt-2" type="submit" value="Одобрить"/>
            </form>
          @else
            <form method="POST" action="{{ route('admin.ads.reject.method', ['ad' => $ad]) }}">
                @method('patch')
                @csrf
                <input class="btn btn-danger mt-2" type="submit" value="Отклонить"/>
            </form>
          @endif  
        </div>
      </div>  
    @endforeach
    {{ $ads->links('pagination::bootstrap-4') }}
  @endif
@endsection