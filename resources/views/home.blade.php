@extends('layouts.app')

@section('content')
    @include('tickets')
@endsection

@section('script')
    <script src="{{ asset('js/update.js') }}" defer></script>
@endsection
