@extends('layouts.home')
@section('title', 'Пополнить кошелек')
@section('home-wallet_active', 'active')
@section('card')
  <div class="row mt-4 mb-4">
    <div class="col">
      <div class="form-group row">
        <div class="col-3 mt-2">
          <label for="balance" class="col-form-label">Сумма пополнения</label>
        </div>
        <div class="col-9">
          <form action="{{ route('home.wallet.add.method') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-8">
                <input type="number" class="form-control @error("value") is-invalid @enderror" id="value" name="value" min="1" step="0.01" value="{{ old('value', 1000) }}"/>
                @error('value')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-3">
                <input type="submit" class="btn btn-info" value="Пополнить"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection