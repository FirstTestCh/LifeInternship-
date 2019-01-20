@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Новый тикет</h3></div>
                
                <div class="card-body">
                    <div class="container">
                    <form action="{{ route('ticket.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="form-row">
                              <div class="form-group col-lg">
                                  <label for="full-name">ФИО:</label>
                              <input type="text" class="form-control {{ $errors->has('full-name') ? ' is-invalid' : '' }}"  name="full-name" id="" value="{{old('full-name')}}">
                                  <div class="form-text text-danger">{{$errors->first('full-name')}}</div>    
                              </div>
                              
                              <div class="form-group col-lg">
                                  <label for="email">Email:</label>
                                  <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  name="email" value = "{{old('email')}}">    
                                  <div class="form-text text-danger">{{$errors->first('email')}}</div>    
                              </div>

                              <div class="form-group col-lg">
                                    <label for="phone">Номер:</label>
                                    <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"  name="phone" id="" value="{{old('phone')}}">    
                                    <div class="form-text text-danger">{{$errors->first('phone')}}</div>    
                                </div>
                          </div>
                          
                          
                          <div class="form-group">
                              <label for="category">Категория</label>
                              <select name="category" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}">
                                  @foreach( $categories as $category ):
                                    <option value="{{ $category->id }}" {{ (old("category") == $category->id ? "selected":"") }}>{{ $category->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          
                          <div class="from-group">
                              <label for="description">Описание:</label>
                              <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" rows="3">{{old('description')}}</textarea>
                              <div class="form-text text-danger">{{$errors->first('description')}}</div>    
                          </div>

                          <div class="form-group">  
                            <label for="exampleFormControlFile1">Файлы для прикрепления:</label>
                            <input type="file" class="form-control-file" name="attachment" id="exampleFormControlFile1">
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


