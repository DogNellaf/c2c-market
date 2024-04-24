@extends('layouts.app')
@section('title', 'Панель администратора')
@section('admin_active', 'active')
@section('content')
<div class="admin">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body justify-content-center">
						<div class='col-3'>
							<a href="{{ route('admin.ads.editor') }}" class="button">Модели</a>
						</div>
						<div class='col-3'>
							<a href="{{ route('admin.reviews.editor') }}" class="button">Отзывы</a>
						</div>						
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')