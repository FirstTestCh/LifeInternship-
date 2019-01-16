@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Новый тикет</h3></div>

                <div class="card-body">
                    <div class="container">
                        {{-- <h1> Новый тикет </h1> --}}
                        <form action="" method="post">
                          <div class="form-group">
                              @csrf
                              <label for="full-name">ФИО:</label>
                              <input type="text" class="form-control"  name="full-name" id=""><br>
                              <label for="email">Email:</label>
                              <input type="email" class="form-control"  name="email" id=""><br>
                              <label for="category">Категория</label>
                              <select name="category" class="form-control">
                                  @foreach( $categories as $category ):
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="from-group">
                              <label for="description">Сообщение:</label>
                              <textarea class="form-control" id="description" rows="3"></textarea>
                              <div class="form-group">
                                <label for="exampleFormControlFile1">Файлы для прикрепления:</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
                              </div>
                          
                          </div>
                          <button class="btn btn-primary" type="submit" name="submit">Создать Тикет</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection


