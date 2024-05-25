@extends('layouts.admin')
@section('title', 'Заказы')
@section('admin_active', 'active')
@section('admin-orders-active', 'active')
@section('card')
  @if ($orders->count() == 0)
    <div class="row">
      <div class="col">
        Заказы не найдены
      </div>
    </div>
  @else
    @foreach ($orders as $order)
      <div class="row mt-3">
        <div class="col">
          <span class="bid">
            Заголовок
            <br>
            <strong>{{$order->title}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="bid">
            Рекомендует?
            <br>
            <strong>{{$order->is_recommended}} Руб.</strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Оценка
            <br>
            <strong>
            
            </strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Статус
            <br>
            <strong>
              @if ($order->status == "Created")
                Создана
              @elseif ($order->status == "Rejected")
                Отклонена
              @elseif ($order->status == "Hidden")
                Скрыта
              @elseif ($order->status == "Showed")
                Отображается
              @endif  
            </strong>
          </span>                  
        </div>
        <div class="col">
          @if ($order->status == "Created" || $order->status == "Rejected")
            <form method="POST" action="#">
                @method('patch')
                @csrf
                <input class="btn btn-success mt-2" type="submit" value="Одобрить"/>
            </form>
          @else
            <form method="POST" action="#">
                @method('patch')
                @csrf
                <input class="btn btn-danger mt-2" type="submit" value="Отклонить"/>
            </form>
          @endif  
        </div>
      </div>  
    @endforeach
    {{ $orders->links('pagination::bootstrap-4') }}
  @endif
@endsection