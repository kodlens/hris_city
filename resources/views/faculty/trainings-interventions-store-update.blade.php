@extends('layouts.faculty')

@section('content')
    @if($id > 0)
        <trainings-interventions-store-update
            prop-user='@json($user)'
            prop-id={{ $id }}
            prop-data='@json($data)'>
        </trainings-interventions-store-update>
    @else
        <trainings-interventions-store-update
            prop-user='@json($user)'
            prop-id={{ $id }}>
        </trainings-interventions-store-update>
    @endif
    
@endsection
