@extends('layouts.app')

@section('content')
    <x-books.form :book="$book" />
@endsection 