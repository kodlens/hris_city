@extends('layouts.user')

@section('content')
    <employee-profile prop-user-id='{{ $id }}'></employee-profile>
@endsection
