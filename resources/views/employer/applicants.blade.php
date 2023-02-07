@extends('layouts.app-employer')

@section('content')
    <applicants prop-job-post-id='{{ $job_post_id }}'></applicants>
@endsection
