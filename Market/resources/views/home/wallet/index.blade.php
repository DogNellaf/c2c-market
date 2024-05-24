@extends('layouts.home')
@section('title', 'Кошелек')
@section('home-wallet_active', 'active')
@section('card')
  <div class="row mt-4 mb-4">
    <div class="col">
      <div class="form-group row">
        <div class="col-sm-2">
          <label for="balance" class="col-form-label">Баланс</label>
        </div>
        <div class="col">
          <div class="row">
            <div class="col-9">
              <input readonly type="number" class="form-control" id="balance" value="{{ $user->get_wallet_balance() }}"/>
            </div>
            <div class="col-3">
              <a href="{{ route('home.wallet.add.page') }}" class="btn btn-info">Пополнить</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4 mb-4">
    <div class="col">
      @if ($transactions->count() == 0)
        Пополнения и списания не найдены
      @else
        <div class="row mt-3">
          <div class="col">
            <span class="bid">
              Тип
            </span>
          </div>
          <div class="col">
            <span class="bid">
              Сумма
            </span>
          </div>
        </div>  
        @foreach ($transactions as $transaction)
          <div class="row mt-3">
            <div class="col">
              <span class="bid">
                <strong>
                  @if ($transaction->type == "Income")
                    Пополнение
                  @else
                    Списание
                  @endif
                </strong>
              </span>
            </div>
            <div class="col">
              <span class="bid">
                <strong>{{$transaction->value}}</strong>
              </span>
            </div>
          </div>  
        @endforeach
        {{ $transactions->links('pagination::bootstrap-4') }}
      @endif
    </div>
  </div>
@endsection