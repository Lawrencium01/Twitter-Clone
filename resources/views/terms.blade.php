@extends('layout.app')
@section('title','Terms')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia totam tenetur dolorum quaerat. Ipsum impedit sapiente minus quidem explicabo asperiores officiis quasi dolore sunt ipsam, quae illo iure, vel eligendi?
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')   
        </div>
    </div>
@endsection
    
