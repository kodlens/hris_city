@extends('layouts.user')

@section('content')
    <employee-dashboard prop-user='@json($user)'></employee-dashboard>
@endsection
