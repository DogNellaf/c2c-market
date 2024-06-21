@extends('layouts.admin')
@section('title', 'Панель администратора')
@section('admin_active', 'active')
@section('admin-users-active', 'active')
@section('card')
  <div class="row mt-3 mb-3">
    <div class="col">
      <div class="row">
        <div class="col">
          <h5 style="color: black;">Фильтрация</h5>
        </div>
      </div>
      <form method="GET" action="{{ route("admin.users.list") }}" class="row">
        <div class="col-3">    
          <label class="form-label mt-2" for="is_banned">Статус пользователя</label>
        </div>
        <div class="col-6">
          <select class="form-select" name="is_banned" id="is_banned">
          <option value="all"
              @if ($is_banned == "all")
                selected
              @endif
          >Все</option>
          <option value="true"
            @if ($is_banned == "true")
              selected
            @endif
          >Заблокированные</option>
          <option value="false"
            @if ($is_banned == "false")
              selected
            @endif
          >Незаблокированные</option>
          </select>
        </div>
        <div class="col">    
          <input class="form-control" type="submit" value="Выбрать"/>
        </div>
      </form>
    </div>
  </div>
  @if ($users->count() == 0)
    <div class="row">
      <div class="col">
        Пользователи не найдены
      </div>
    </div>
  @else
    <div class="row">
      <div class="col">
        <h5 style="color: black;">Пользователи</h5>
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
      </div>
    </div>
  @endif
@endsection