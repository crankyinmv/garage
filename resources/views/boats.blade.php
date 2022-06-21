@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@if (session()->has('err'))
    <div class='col-md-10 alert-warning text-center'>{{ session('err') }}</div>
@endif
    <div class='col-md-10'>
            <h3>Boats</h2>
        <table class="table table-striped">
        <caption>Boats</caption>
        <thead>
        <tr>
            <th scope='col'>Owner</th>
            <th scope='col'>Make/Model</th>
            <th scope='col'>Year</th>
            <th scope='col'>Length</th>
            <th scope='col'>Width</th>
            <th scope='col'>Hull ID</th>
            <th scope='col'>Hours</th>
            <th scope='col'>Service Interval</th>
            <th scope='col'>Next Service</th>
            <th scope='col'></th>
        </tr>
        </thead>
        <tbody>
@foreach ($boats as $boat)
        <tr>
            <th scope='row'>{{$boat->name}}</th>
            <td><a href='/boats/{{$boat->id}}'>{{$boat->make}} {{$boat->model}}</a></td>
            <td>{{$boat->year}}</td>
            <td>{{$boat->seats}}</td>
            <td>{{$boat->length}}</td>
            <td>{{$boat->width}}</td>
            <td>{{$boat->hin}}</td>
            <td>{{$boat->hours}}</td>
            <td>{{$boat->service_int}}</td>
            <td>{{$boat->next_service}}</td>
            <td>
                <form method='post' action='/boats/delete/{{$boat->id}}' onsubmit="return confirm('Remove this {{$boat->make}} {{$boat->model}}?')" >@csrf
                <button type="submit" id='remove_{{$boat->id}}' class="btn btn-outline-danger btn-small">Remove</button>
                </form>
            </td>
        </tr>
@endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
