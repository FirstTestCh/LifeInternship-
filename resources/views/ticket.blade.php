@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between text-primary">
                <div>{{ $ticket->full_name }}</div>
                <div class="text-secondary">{{ $ticket->created_at }}</div>
            </div>
            <div class="card-body">
                <ul>
                    <li>Автор: {{ $ticket->user->name }}</li>
                    <li>Email: {{$ticket->email}}</li>
                    <li>Номер: {{$ticket->phone_num}}</li>
                    @if ($ticket->file) 
                        <li>{{$ticket->file}}</li>
                    @endif
                    <li>Категория: {{$ticket->category->name}}</li>
                    <li class="{{ $ticket->statusColor() }}">Статус: {{$ticket->status->name}}</li>
                    @if ($ticket->admin_id)
                        <li>Админ: {{ $ticket->admin->name }}</li>
                    @endif
                </ul>
                <p>Описание</p>
                <p>{{$ticket->description}}</p>
                @if ($ticket->file_path)
                    <a target="_blank" rel="noopener noreferrer" href={{ route('ticket.attachment', ['hash' => $ticket->hash]) }}>
                        <button class="my-2">Прикрепленный файл</button>
                    </a>
                @endif
                @if (Auth::check() && Auth::user()->isAdmin())
                   <form method="post" action="/ticket/{{$ticket->hash}}/process">
                        @csrf
                        <input type="submit" value="В обработке">
                    </form>
                @endif
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">Написать комментарий</div>

            <div class="card-body">
                <form method="POST" action="/ticket/{{ $ticket->hash }}">
                    @csrf
                    
                    <textarea class="form-control mb-3" name="content" placeholder="Комментарий"></textarea>

                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary">Написать</button>

                        @if (Auth::check() && Auth::user()->isAdmin())
                            <div class="form-group form-check mb-0 h-100">
                                <input type="checkbox" name="admin_only" class="form-check-input" id="check">

                                <label class="form-check-label" for="check">Только для админов</label>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        @foreach ($ticket->comments as $comment)
            <div class="card mb-4 {{ $comment->admin_only ? 'border-secondary' : '' }}">
                <div class="card-header d-flex justify-content-between">
                    <div>{{ $comment->user->name }}</div>

                    <div class="text-secondary">{{ $comment->created_at }}</div>
                </div>

                <div class="card-body">{{ $comment->content }}</div>
            </div>
        @endforeach
    </div>
</div>
@endsection
