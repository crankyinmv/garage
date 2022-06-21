<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trucks;

use App\Traits\ValidationTrait;

class TrucksController  extends Controller
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
			$trucks = Trucks::join('users', 'trucks.user_id','=','users.id')->select('trucks.*', 'users.name')->get();
		else
			$trucks = Trucks::join('users', 'trucks.user_id','=','users.id')->where('users.id','=',$uid)->select('trucks.*', 'users.name')->get();

		return view('trucks', ['trucks'=>$trucks]);
	}

	public function show($truckId=null)
	{
		/* Show the update (or create) form for the given truck.  Need a valid id, plus proper authorization (admin or owner). */
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		if($truckId == 'create')
			$truckId = null;
		if($truckId)
		{
			$truck = Trucks::join('users', 'trucks.user_id','=','users.id')->where('trucks.id','=',$truckId)->select('trucks.*', 'users.name')->first();
			if(!$truck || (!$admin && $truck->user_id !== $uid))
			{
				session()->flash('err', "You can't update that vehicle's information.");
				return redirect()->route('trucks.index');
			}
		}
		else
			$truck = new Trucks();
		return view('truckShow', ['vehicle'=>$truck, 'action'=>($truckId ? 'update' : 'create')]);
	}

	public function update(Request $request, $truckId)
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* Before we do anything, make sure the vehicle is accessible. */
		$truck = Trucks::where('id','=',$truckId)->first();
		if(!$truck || (!$admin && $truck->user_id != $uid))
		{
			session()->flash('err', "You can't update that vehicle's information.");
			return redirect()->route('trucks.index');
		}

		/* Validation. */
		$validated = TrucksController::validateVehicle($request, 'truck', $truckId);

		/* DB stuff. */
		$truck->make=$request->make;
		$truck->model=$request->model;
		$truck->year=$request->year;
		$truck->seats=$request->seats;
		$truck->color=$request->color;
		$truck->vin=$request->vin;
		$truck->mileage=$request->mileage;
		$truck->service_int=$request->service_int;
		$truck->next_service=$request->next_service;
		$truck->bed_length=$request->bed_length;
		$truck->save();		

		return redirect('/trucks');
	}

	public function create(Request $request)
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* Admins are not allowed to create vehicles for now. */
		if($admin)
		{
			session()->flash('err', "You can't update that vehicle's information.");
			return redirect()->route('trucks.index');
		}

		/* Validation. */
		$validated = TrucksController::validateVehicle($request, 'truck');

		/* DB stuff. */
		$truck = new Trucks();
		$truck->make=$request->make;
		$truck->model=$request->model;
		$truck->year=$request->year;
		$truck->seats=$request->seats;
		$truck->color=$request->color;
		$truck->vin=$request->vin;
		$truck->mileage=$request->mileage;
		$truck->service_int=$request->service_int;
		$truck->next_service=$request->next_service;
		$truck->user_id = $uid;
		$truck->bed_length=$request->bed_length;
		$truck->save();		

		return redirect('/trucks');
	}

	public function delete($truckId)
	{
		/* Before we do anything, make sure the vehicle is accessible.  Regular users can't remove each other's vehicles. */
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;
		$truck = Trucks::where('id','=',$truckId)->first();
		if(!$truck || (!$admin && $truck->user_id != $uid))
		{
			session()->flash('err', "You can't delete that vehicle.");
			return redirect()->route('trucks.index');
		}

		/* DB stuff. */
		$truck->delete();

		return redirect('/trucks');
	}
}
