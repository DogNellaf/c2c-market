@extends('layouts.app')
@section('home_active', 'active')
@section('content')
<div class="home">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    @if ($user->is_banned == 1)
                        <div class="card-body">
                            <p>Вы были забанены!</p>
                        </div>
                    @else
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('home') }}">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{ route('home-own') }}">Мои модели</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{ route('home-bought') }}">Купленные модели</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{ route('home-reviews') }}">Мои отзывы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{ route('home-stats') }}">Статистика</a>
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