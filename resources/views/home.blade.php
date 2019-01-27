@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="/search/ticket">
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-3">
                                <label for="categorySelect">Категория</label>

                                <select class="form-control" id="categorySelect" name="category">
                                    <option value="" selected>Выбрать</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="categorySelect">Статус</label>

                                <select class="form-control" id="categorySelect" name="status">
                                    <option value="" selected>Выбрать</option>

                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                        {{ old('status') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="categorySelect">Поиск</label>

                                <input class="form-control" type="text" name="query" placeholder="Поиск"
                                value="{{ old('query') ? old('query') : '' }}">
                            </div>

                            <div class="form-group col-md-3">
                                <button class="btn btn-primary w-100">Искать</button>
                            </div>
                        </div>
                    </form>

                    <div id="tickets">
                        @if ($tickets->count() > 0)
                            @foreach ($tickets as $ticket)
                                <div class="card {{ $loop->last ? '' : 'mb-3' }}">
                                    <div class="card-header d-flex justify-content-between text-primary">
                                        <div class="text-secondary">{{ $ticket->created_at }}</div>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            <li>Имя: {{ $ticket->full_name }}</li>
                                            <li>Email: {{$ticket->email}}</li>
                                            <li>Номер: {{$ticket->phone_num}}</li>
                                            <li>Категория: {{$ticket->category->name}}</li>
                                            <li class="{{ $ticket->statusColor() }}">Статус: {{$ticket->status->name}}</li>
                                            @if ($ticket->admin_id)
                                                <li>Админ: {{ $ticket->admin->name }}</li>
                                            @endif
                                        </ul>
                                        <p>Описание</p>
                                        <p>{{$ticket->description}}</p>
                                        <a class="btn btn-primary" href="/ticket/{{$ticket->hash}}">Посмотреть</a>
                                    </div>
                                </div>
                            @endforeach 
                        @else
                            <div>Пусто :(</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
{{-- </div> --}}
<script src="{{ asset('js/update.js') }}" defer></script>
@endsection
