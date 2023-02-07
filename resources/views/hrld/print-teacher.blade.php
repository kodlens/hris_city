@extends('layouts.print-layout')

@section('content')
    <print-teacher prop-data='@json($data)'></print-teacher>
@endsection


