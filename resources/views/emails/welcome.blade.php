@extends('emails.layouts.app')

@section('content')
    <p><b> Hi {{ $name }}</b></p>
    <h4>Thank you for banking with us!</h4>
    <p>Your verification process is completed. Now {{ $name }} is able to log in to the account and it will be
        update after the 1700 hours.</p>
    <p>Here’s your credentials to log in to account.</p>
    <p>Link - <a href="{{ route('login') }}">{{ route('login') }}</a></p>
    <p>User Name -<a href="{{ $email }}"> {{ $email }} </a> </p>
    <p>Password - <a href="{{ $password }}"> {{ $password }} </a> </p>
    <p>This is an automated mail so in case you have any questions for us let us know at nsbfmc@nsb.lk or feel free to
        contact us on +94112425010.</p>
@endsection
