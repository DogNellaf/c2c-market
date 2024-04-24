@extends('layouts.app')
@section('title', 'Редактор отзывов')
@section('content')
<a href="{{ route('reviews.create.page')}}">Добавить отзыв</a>
<table class="table table-striped table-borderless">
	<thead>
		<tr>
			<th>Название</th>
			<th>Текст</th>
			<th>Рекомендуется</th>
			<th>Оценка</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($reviews as $review)
		<tr>
			<th><h4>{{$review->title}}</h4></th>
			<th>{{$review->text}}</th>
			<th>{{$review->is_recommended}}</th>
			<th>{{$review->rate}}</th>
			<td>
				<a href="{{ route('reviews.edit.page', ['review' => $review]) }}">Редактировать</a>
			</td>
			<td>
				<form action="{{ route('reviews.delete.method', ['review' => $review]) }}" method="post">
					@csrf
					@method('DELETE')
					<input type="submit" value="Удалить">
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{ $reviews->links('pagination::bootstrap-4') }}
@endsection('content')