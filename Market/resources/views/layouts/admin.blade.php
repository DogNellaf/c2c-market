@extends('layouts.app')
@section('home_active', 'active')
@section('content')
  <div class="home">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card text-center">
            @if ($user->is_admin === 0)
              <div class="card-body">
                <p>Вы не являетесь администратором.</p>
              </div>
            @else
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link @yield('admin-ads-active')" href="{{ route('admin.ads.list') }}">Модели</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('admin-reviews-active')" href="{{ route('admin.reviews.list') }}">Отзывы</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('admin-orders-active')" href="{{ route('admin.orders.list') }}">Заказы</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @yield('admin-users-active')" href="{{ route('admin.users.list') }}">Пользователи</a>
                  </li>                          
                </ul>
              </div>
              <div class="card-body">
                @yield('card')
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection