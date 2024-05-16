@extends('layouts.main')
@section('title', 'Переадресация')
@section('page_title', 'Переадресуем в платежную систему...')
@section('page')
<script>
  window.location.replace("{{ route('main.ads.buy.confirm', ['ad' => $ad]) }}");
</script>
@endsection('page')