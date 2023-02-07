@extends('layouts.app-employer')

@section('content')
    <employer-job-post :prop-job-types='@json($jobtypes)' :prop-categories='@json($categories)'
        prop-company-id="{{ $companyId }}" prop-qualifications='@json($qualifications)'>
    </employer-job-post>
@endsection
