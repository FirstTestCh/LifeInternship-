@extends('./layouts/app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card mb-4">
				<div class="card-header">Категории</div>
				<div class="list-group list-group-flush">
					@foreach ($categories as $category)
						<a class="list-group-item" href="/ticketCategories/{{ $category->id }}">{{ $category->name }}</a>
					@endforeach
				</div>
			</div>

			<div class="card">
				<div class="card-header">Новая категория</div>

				<div class="card-body">
					<form method="POST" action="/ticketCategories">
						@csrf

						<div class="input-group">
							<input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
							placeholder="Название" value="{{ old('name') ? old('name') : '' }}">

							<div class="input-group-append">
								<button class="btn btn-outline-success">Создать</button>
							</div>
						</div>
					</form>

					@if ($errors->any())
						<div class="alert alert-danger m-0 mt-3">
							@foreach ($errors->all() as $error)
								<div>{{ $error }}</div>
							@endforeach
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection