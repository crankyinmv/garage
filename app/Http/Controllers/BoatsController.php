<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Boats;

use App\Traits\ValidationTrait;

class BoatsController extends Controller
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
			$boats = Boats::join('users', 'boats.user_id','=','users.id')->select('boats.*', 'users.name')->get();
		else
			$boats = Boats::join('users', 'boats.user_id','=','users.id')->where('users.id','=',$uid)->select('boats.*', 'users.name')->get();

		return view('boats', ['boats'=>$boats]);
	}

	public function show($boatId=null)
	{
		/* Show the update (or create) form for the given boat.  Need a valid id, plus proper authorization (admin or owner). */
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		if($boatId == 'create')
			$boatId = null;
		if($boatId)
		{
			$boat = Boats::join('users', 'boats.user_id','=','users.id')->where('boats.id','=',$boatId)->select('boats.*', 'users.name')->first();
			if(!$boat || (!$admin && $boat->user_id !== $uid))
			{
				session()->flash('err', "You can't update that vehicle's information.");
				return redirect()->route('boats.index');
			}
		}
		else
			$boat = new Boats();
		return view('boatShow', ['vehicle'=>$boat, 'action'=>($boatId ? 'update' : 'create')]);
	}

	public function update(Request $request, $boatId)
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* Before we do anything, make sure the vehicle is accessible. */
		$boat = Boats::where('id','=',$boatId)->first();
		if(!$boat || (!$admin && $boat->user_id != $uid))
		{
			session()->flash('err', "You can't update that vehicle's information.");
			return redirect()->route('boats.index');
		}

		/* Validation. */
		$validated = BoatsController::validateVehicle($request, 'boat', $boatId);

		/* DB stuff. */
		$boat->make=$request->make;
		$boat->model=$request->model;
		$boat->year=$request->year;
		$boat->length=$request->length;
		$boat->width=$request->width;
		$boat->hin=$request->hin;
		$boat->hours=$request->hours;
		$boat->service_int=$request->service_int;
		$boat->next_service=$request->next_service;
		$boat->save();		

		return redirect('/boats');
	}

	public function create(Request $request)
	{
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;

		/* Admins are not allowed to create vehicles for now. */
		if($admin)
		{
			session()->flash('err', "You can't update that vehicle's information.");
			return redirect()->route('boats.index');
		}

		/* Validation. */
		$validated = BoatsController::validateVehicle($request, 'boat');

		/* DB stuff. */
		$boat = new Boats();
		$boat->make=$request->make;
		$boat->model=$request->model;
		$boat->year=$request->year;
		$boat->length=$request->length;
		$boat->width=$request->width;
		$boat->hin=$request->hin;
		$boat->hours=$request->hours;
		$boat->service_int=$request->service_int;
		$boat->next_service=$request->next_service;
		$boat->user_id = $uid;
		$boat->save();		

		return redirect('/boats');
	}

	public function delete($boatId)
	{
		/* Before we do anything, make sure the vehicle is accessible.  Regular users can't remove each other's vehicles. */
		$uid = \Auth::user()->id;
		$admin = \Auth::user()->admin;
		$boat = Boats::where('id','=',$boatId)->first();
		if(!$boat || (!$admin && $boat->user_id != $uid))
		{
			session()->flash('err', "You can't delete that vehicle.");
			return redirect()->route('boats.index');
		}

		/* DB stuff. */
		$boat->delete();

		return redirect('/boats');
	}
}
