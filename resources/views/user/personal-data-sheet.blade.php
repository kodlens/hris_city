@extends('layouts.user')

@section('content')
    <personal-data-sheet prop-civils='@json($civils)'
        prop-citizenships='@json($citizenships)'
        prop-data='@json($user)'>
    </personal-data-sheet>
@endsection
