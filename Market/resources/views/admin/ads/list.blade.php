@extends('layouts.admin')
@section('title', 'Модели')
@section('admin_active', 'active')
@section('admin-ads-active', 'active')
@section('card')
<div class="row mt-3 mb-3">
    <div class="col">
      <div class="row">
        <div class="col">
          <h5 style="color: black;">Фильтрация</h5>
        </div>
      </div>
      <form method="GET" action="{{ route("admin.ads.list") }}" class="row">
        <div class="col-3">    
          <label class="form-label mt-2" for="status">Статус объявления</label>
        </div>
        <div class="col-6">
          <select class="form-select" name="status" id="status">
            <option value="All"
              @if ($status == "All")
                selected
              @endif
            >Все</option>
            <option value="Created"
              @if ($status == "Created")
                selected
              @endif
            >Ждут одобрения</option>
            <option value="Rejected"
              @if ($status == "Rejected")
                selected
              @endif
            >Отклоненные</option>
            <option value="Hidden"
              @if ($status == "Hidden")
                selected
              @endif
            >Скрытые</option>
            <option value="Showed"
              @if ($status == "Showed")
                selected
              @endif
            >Отображаемые</option>
          </select>
        </div>
        <div class="col">    
          <input class="form-control" type="submit" value="Выбрать"/>
        </div>
      </form>
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
        <div class="col">
          @if ($ad->status == "Created" || $ad->status == "Rejected")
            <form method="POST" action="{{ route('admin.ads.approve', ['ad' => $ad]) }}">
                @method('patch')
                @csrf
                <input class="btn btn-success mt-2" type="submit" value="Одобрить"/>
            </form>
          @else
            <form method="POST" action="{{ route('admin.ads.reject', ['ad' => $ad]) }}">
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