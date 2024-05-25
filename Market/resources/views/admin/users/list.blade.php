@extends('layouts.admin')
@section('title', 'Панель администратора')
@section('admin_active', 'active')
@section('admin-users-active', 'active')
@section('card')
  @if ($users->count() == 0)
    <div class="row">
      <div class="col">
        Пользователи не найдены
      </div>
    </div>
  @else
    @foreach ($users as $temp_user)
      <div class="row mt-3">
        <div class="col">
          <span class="bid">
            Логин
            <br>
            <strong>{{$temp_user->name}}</strong>
          </spa>
        </div>
        <div class="col">
          <span class="bid">
            Электронная почта
            <br>
            <strong>{{$temp_user->email}}</strong>
          </span>
        </div>
        <div class="col">
          <span class="bid">
            Время регистрации
            <br>
            <strong>{{$temp_user->created_at}}</strong>
          </span>
        </div>
        <div class="col">
          @if ($temp_user->is_banned == 1)
            <form method="POST" action="{{ route('admin.users.unban.method', ['user' => $temp_user]) }}">
              @method('patch')
              @csrf
              <input class="btn btn-success mt-2" type="submit" value="Разблокировать"/>
            </form>
          @else
            <form method="POST" action="{{ route('admin.users.ban.method', ['user' => $temp_user]) }}">
              @method('patch')
              @csrf
              <input class="btn btn-danger mt-2" type="submit" value="Заблокировать"/>
            </form>
          @endif  
        </div>
      </div>  
    @endforeach
    {{ $users->links('pagination::bootstrap-4') }}
  @endif
@endsection