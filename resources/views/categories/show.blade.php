@extends('./layouts/app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<form method="POST" action="/ticketCategories/{{ $ticketCategory->id }}">
						@method('PATCH')
						@csrf

						<div class="input-group">
							<input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
							placeholder="Name" value="{{ old('name') ? old('name') : $ticketCategory->name }}">

							<div class="input-group-append">
								<button class="btn btn-outline-primary">Edit</button>

								<button class="btn btn-outline-danger" type="button" onclick="document.getElementById('delete').submit();">Delete</button>
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

					<form id="delete" class="d-none" method="POST" action="/ticketCategories/{{ $ticketCategory->id }}">
						@method('DELETE')
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection