@extends('layout.app')
@section('title','Register')
@section('content')
<div class="row justify-content-center">
    @include('shared.success-message')
    <div class="col-12 col-sm-8 col-md-6">
        <form class="form mt-5" action="/store" method="post">
            @csrf
            <h3 class="text-center text-dark">Register</h3>
            <div class="form-group">
                <label for="name" class="text-dark">Name</label><br>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
            </div>
            @error('name')
                <p class="d-block fs-6 text-danger mt-2">{{$message}}</p>
            @enderror
            <div class="form-group mt-3">
                <label for="email" class="text-dark">Email:</label><br>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
            </div>
            @error('email')
                <p class="d-block fs-6 text-danger mt-2">{{$message}}</p>
            @enderror
            <div class="form-group mt-3">
                <label for="password" class="text-dark">Password:</label><br>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            @error('password')
                <p class="d-block fs-6 text-danger mt-2">{{$message}}</p>
            @enderror
            <div class="form-group mt-3">
                <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            @error('password_confirmation')
                <p class="d-block fs-6 text-danger mt-2">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="remember-me" class="text-dark"></label><br>
                <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
            </div>
            <div class="text-right mt-2">
                <a href="/login" class="text-dark">Login here</a>
            </div>
        </form>
    </div>
</div>
@endsection