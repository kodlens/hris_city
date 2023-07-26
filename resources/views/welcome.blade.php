@extends('layouts.app')


@section('extracss')
    <style>
        
       
    </style>
@endsection
@section('content')

    <div class="welcome-container">
        <div class="columns is-centered w-margin-top">
            <div class="column">
                <div class="title-content is-flex is-flex-direction-column is-justify-content-center is-align-content-center">
                    <div class="welcome-title">LeaMS</div>
                    <p class="welcome-subtitle">A Multiplatform Employee Leave Management System for the LGU of Tangub City</p>
                </div>
            </div>

            <div class="column">
                <div class="box">
                    <div class="box-heading">Login Account</div>

                    <div class="box-body">
                        <login-component></login-component>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
