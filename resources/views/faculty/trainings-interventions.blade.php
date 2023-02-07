@extends('layouts.faculty')

@section('content')
    <trainings-interventions
        prop-user='@json($user)'>
    </trainings-interventions>
@endsection
