@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
@if($action == 'create')
                <div class="card-header">Add a new boat</div>
@else                
                <div class="card-header">Update information for {{ $vehicle->make . ' ' . $vehicle->model}}</div>
@endif
                <div class="card-body">
                    <form method="POST" action="/boats{{$action == 'update' ? '/'.$vehicle->id : ''}}">
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
                            <label for="length" class="col-md-4 col-form-label text-md-end">Length</label>

                            <div class="col-md-6">
                                <input id="length" type="number" min='10' max='200' class="form-control @error('length') is-invalid @enderror" name="length" 
                                value="{{$action=='create'?old('length'):$vehicle->length}}" required autofocus>

                                @error('length')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="width" class="col-md-4 col-form-label text-md-end">Width</label>

                            <div class="col-md-6">
                                <input id="width" type="number" min='10' max='100' class="form-control @error('width') is-invalid @enderror" name="width" 
                                value="{{$action=='create'?old('width'):$vehicle->width}}" required autofocus>

                                @error('width')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hin" class="col-md-4 col-form-label text-md-end">Hull Identification Number</label>

                            <div class="col-md-6">
                                    <input id="hin" type="text" minlength='12' maxlength='12' class="form-control @error('hin') is-invalid @enderror" name="hin" 
                                value="{{$action=='create'?old('hin'):$vehicle->hin}}" style="text-transform:uppercase" required autofocus>
                                    @error('hin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hours" class="col-md-4 col-form-label text-md-end">Current Hours</label>

                            <div class="col-md-6">
                                <input id="hours" type="number" min='0' class="form-control @error('hours') is-invalid @enderror" name="hours" 
                                value="{{$action=='create'?old('hours'):$vehicle->hours}}" required autofocus>

                                @error('hours')
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
