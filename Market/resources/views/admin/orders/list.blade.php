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
            Заголовок объявления
            <br>
            <strong>{{$order->ad->title}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="bid">
            Имя пользователя
            <br>
            <strong>{{$order->user->name}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Сумма заказа
            <br>
            <strong>{{$order->price}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="ends">
            Статус
            <br>
            <strong>
              @if ($order->status == "Created")
                Создан
              @elseif ($order->status == "Paid")
                Оплачен
              @elseif ($order->status == "Rejected")
                Отклонен
              @endif  
            </strong>
          </span>                  
        </div>
      </div>  
    @endforeach
    {{ $orders->links('pagination::bootstrap-4') }}
  @endif
@endsection