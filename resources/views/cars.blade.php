@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
@if (session()->has('err'))
    <div class='col-md-10 alert-warning text-center'>{{ session('err') }}</div>
@endif
    <div class='col-md-10'>
            <h3>Cars</h2>
        <table class="table table-striped">
        <caption>Cars</caption>
        <thead>
        <tr>
            <th scope='col'>Owner</th>
            <th scope='col'>Make/Model</th>
            <th scope='col'>Year</th>
            <th scope='col'>Seats</th>
            <th scope='col'>Color</th>
            <th scope='col'>Vehicle ID</th>
            <th scope='col'>Mileage</th>
            <th scope='col'>Service Interval</th>
            <th scope='col'>Next Service</th>
            <th scope='col'></th>
        </tr>
        </thead>
        <tbody>
@foreach ($cars as $car)
        <tr>
            <th scope='row'>{{$car->name}}</th>
            <td><a href='/cars/{{$car->id}}'>{{$car->make}} {{$car->model}}</a></td>
            <td>{{$car->year}}</td>
            <td>{{$car->seats}}</td>
            <td>{{$car->color}}</td>
            <td>{{$car->vin}}</td>
            <td>{{$car->mileage}}</td>
            <td>{{$car->service_int}}</td>
            <td>{{$car->next_service}}</td>
            <td>
                <form method='post' action='/cars/delete/{{$car->id}}' onsubmit="return confirm('Remove this {{$car->make}} {{$car->model}}?')" >@csrf
                <button type="submit" id='remove_{{$car->id}}' class="btn btn-outline-danger btn-small">Remove</button>
                </form>
            </td>
</tr>
@endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
