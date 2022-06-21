@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
@if($action == 'create')
                <div class="card-header">Add a new car</div>
@else                
                <div class="card-header">Update information for {{ $vehicle->make . ' ' . $vehicle->model}}</div>
@endif
                <div class="card-body">
                    <form method="POST" action="/cars{{$action == 'update' ? '/'.$vehicle->id : ''}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="make" class="col-md-4 col-form-label text-md-end">Make</label>

                            <div class="col-md-6">
                                <input id="make" type="text" minlength='1' maxlength='100' class="form-control @error('make') is-invalid @enderror" name="make" 
                                value="{{$action=='create'?old('make'):$vehicle->make}}" required autofocus>

                                @error('make')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">Model</label>

                            <div class="col-md-6">
                                <input id="model" type="text" minlength='1' maxlength='100' class="form-control @error('model') is-invalid @enderror" name="model" 
                                value="{{$action=='create'?old('model'):$vehicle->model}}" required autofocus>

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="year" class="col-md-4 col-form-label text-md-end">Year</label>

                            <div class="col-md-6">
                                <input id="year" type="number" min='0' class="form-control @error('year') is-invalid @enderror" name="year" 
                                value="{{$action=='create'?old('year'):$vehicle->year}}" required autofocus>

                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="seats" class="col-md-4 col-form-label text-md-end">Seats</label>

                            <div class="col-md-6">
                                <input id="seats" type="number" min='1' max='100' class="form-control @error('seats') is-invalid @enderror" name="seats" 
                                value="{{$action=='create'?old('seats'):$vehicle->seats}}" required autofocus>

                                @error('seats')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="color" class="col-md-4 col-form-label text-md-end">Color</label>

                            <div class="col-md-6">
                                <input id="color" type="text" minlength='1' maxlength='50' class="form-control @error('color') is-invalid @enderror" name="color" 
                                value="{{$action=='create'?old('color'):$vehicle->color}}" required autofocus>

                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="vin" class="col-md-4 col-form-label text-md-end">Vehicle Identification Number</label>

                            <div class="col-md-6">
                                    <input id="vin" type="text" minlength='17' maxlength='17' class="form-control @error('vin') is-invalid @enderror" name="vin" 
                                value="{{$action=='create'?old('vin'):$vehicle->vin}}" style="text-transform:uppercase" required autofocus>
                                @error('vin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mileage" class="col-md-4 col-form-label text-md-end">Current Mileage</label>

                            <div class="col-md-6">
                                <input id="mileage" type="number" min='0' class="form-control @error('mileage') is-invalid @enderror" name="mileage" 
                                value="{{$action=='create'?old('mileage'):$vehicle->mileage}}" required autofocus>

                                @error('mileage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="service_int" class="col-md-4 col-form-label text-md-end">Service Interval</label>

                            <div class="col-md-6">
                                <input id="service_int" type="number" min='0' class="form-control @error('service_int') is-invalid @enderror" name="service_int" 
                                value="{{$action=='create'?old('service_int'):$vehicle->service_int}}" required autofocus>

                                @error('service_int')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="next_service" class="col-md-4 col-form-label text-md-end">Next Service</label>

                            <div class="col-md-6">
                                <input id="next_service" type="number" min='0' class="form-control @error('next_service') is-invalid @enderror" name="next_service" 
                                value="{{$action=='create'?old('next_service'):$vehicle->next_service}}" required autofocus>

                                @error('next_service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
@if($action == 'update')
                            <!--<input type='hidden' name='id' value='{{$vehicle->id}}' />-->
                            <button type="submit" class="btn btn-primary">Update</button>
@else
                            <button type="submit" class="btn btn-primary">Add</button>
@endif                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
