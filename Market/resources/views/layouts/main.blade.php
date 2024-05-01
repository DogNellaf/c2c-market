@extends('layouts.app')
@section('content')
  <div class="page-heading normal-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>@yield('page_title')</h2>
          <div class="buttons">
            <div class="main-button">
              <a href="{{ route('main.ads.list') }}">Посмотреть модели</a>
            </div>
            <div class="border-button">
              <a href="{{ route('home.ads.create.page') }}">Добавьте свою модель</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @yield('page')
@endsection('content')