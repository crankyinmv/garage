@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@if (session()->has('err'))
    <div class='col-md-10 alert-warning text-center'>{{ session('err') }}</div>
@endif
    <div class='col-md-10'>
            <h3>Trucks</h2>
        <table class="table table-striped">
        <caption>Trucks</caption>
        <thead>
        <tr>
            <th scope='col'>Owner</th>
            <th scope='col'>Make/Model</th>
            <th scope='col'>Year</th>
            <th scope='col'>Seats</th>
            <th scope='col'>Bed Length</th>
            <th scope='col'>Color</th>
            <th scope='col'>Vehicle ID</th>
            <th scope='col'>Mileage</th>
            <th scope='col'>Service Interval</th>
            <th scope='col'>Next Service</th>
            <th scope='col'></th>
        </tr>
        </thead>
        <tbody>
@foreach ($trucks as $truck)
        <tr>
            <th scope='row'>{{$truck->name}}</th>
            <td><a href='/trucks/{{$truck->id}}'>{{$truck->make}} {{$truck->model}}</a></td>
            <td>{{$truck->year}}</td>
            <td>{{$truck->seats}}</td>
            <td>{{$truck->bed_length}}</td>
            <td>{{$truck->color}}</td>
            <td>{{$truck->vin}}</td>
            <td>{{$truck->mileage}}</td>
            <td>{{$truck->service_int}}</td>
            <td>{{$truck->next_service}}</td>
            <td>
                <form method='post' action='/trucks/delete/{{$truck->id}}' onsubmit="return confirm('Remove this {{$truck->make}} {{$truck->model}}?')" >@csrf
                <button type="submit" id='remove_{{$truck->id}}' class="btn btn-outline-danger btn-small">Remove</button>
                </form>
            </td>
</tr>
@endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
