<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cars;

use App\Traits\ValidationTrait;

class CarsController extends Controller
{
	use ValidationTrait;
	
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* List vehicles.  Regular users can see their own vehicle, while "admin" users can see everything. */
		if($admin)
			$cars = Cars::join('users', 'cars.user_id','=','users.id')->select('cars.*', 'users.name')->get();
		else
			$cars = Cars::join('users', 'cars.user_id','=','users.id')->where('users.id','=',$uid)->select('cars.*', 'users.name')->get();

		return view('cars', ['cars'=>$cars]);
	}

	public function show($carId=null)
	{
		/* Show the update (or create) form for the given car.  Need a valid id, plus proper authorization (admin or owner). */
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		if($carId == 'create')
			$carId = null;
		if($carId)
		{
			$car = Cars::join('users', 'cars.user_id','=','users.id')->where('cars.id','=',$carId)->select('cars.*', 'users.name')->first();
			if(!$car || (!$admin && $car->user_id !== $uid))
			{
				session()->flash('err', "You can't update that vehicle's information.");
				return redirect()->route('cars.index');
			}
		}
		else
			$car = new Cars();
		return view('carShow', ['vehicle'=>$car, 'action'=>($carId ? 'update' : 'create')]);
	}

	public function update(Request $request, $carId)
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* Before we do anything, make sure the vehicle is accessible. */
		$car = Cars::where('id','=',$carId)->first();
		if(!$car || (!$admin && $car->user_id != $uid))
		{
			session()->flash('err', "You can't update that vehicle's information.");
			return redirect()->route('cars.index');
		}

		/* Validation. */
		$validated = CarsController::validateVehicle($request, 'car', $carId);

		/* DB stuff. */
		$car->make=$request->make;
		$car->model=$request->model;
		$car->year=$request->year;
		$car->seats=$request->seats;
		$car->color=$request->color;
		$car->vin=$request->vin;
		$car->mileage=$request->mileage;
		$car->service_int=$request->service_int;
		$car->next_service=$request->next_service;
		$car->save();		

		return redirect('/cars');
	}

	public function create(Request $request)
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* Admins are not allowed to create vehicles for now. */
		if($admin)
		{
			session()->flash('err', "You can't update that vehicle's information.");
			return redirect()->route('cars.index');
		}

		/* Validation. */
		$validated = CarsController::validateVehicle($request, 'car');

		/* DB stuff. */
		$car = new Cars();
		$car->make=$request->make;
		$car->model=$request->model;
		$car->year=$request->year;
		$car->seats=$request->seats;
		$car->color=$request->color;
		$car->vin=$request->vin;
		$car->mileage=$request->mileage;
		$car->service_int=$request->service_int;
		$car->next_service=$request->next_service;
		$car->user_id = $uid;
		$car->save();		

		return redirect('/cars');
	}

	public function delete($carId)
	{
		/* Before we do anything, make sure the vehicle is accessible.  Regular users can't remove each other's vehicles. */
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;
		$car = Cars::where('id','=',$carId)->first();
		if(!$car || (!$admin && $car->user_id != $uid))
		{
			session()->flash('err', "You can't delete that vehicle.");
			return redirect()->route('cars.index');
		}

		/* DB stuff. */
		$car->delete();

		return redirect('/cars');
	}
}
