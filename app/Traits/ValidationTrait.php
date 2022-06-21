<?php
namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

trait ValidationTrait
{
	private static function validateVehicle($request, $type, $vid=null)
	{
		$tables = ['car'=>'cars', 'truck'=>'trucks', 'boat'=>'boats'];
		$table = $tables[$type];

		$validation = 
		[
			'make'=>'required|min:1|max:100',
			'model'=>'required|min:1|max:100',
			'year'=>'required|numeric',
			'service_int'=>'required|numeric|min:1',
			'next_service'=>'required|numeric|min:1',
		];

		if(isset($request->vin))
		{
			// To get proper VIN uniqueness, force the user input to uppercase.
			$requestData = $request->all();
			$requestData['vin'] = strtoupper($requestData['vin']);
			$request->replace($requestData);
			if($vid)
				$validation['vin'] = 
					['required','size:17','regex:/^[0-9ABCDEFGHJKLMNPRSTUVWXYZ]+$/',Rule::unique($table)->ignore($vid)];
			else
				$validation['vin'] = 
					['required','size:17','regex:/^[0-9ABCDEFGHJKLMNPRSTUVWXYZ]+$/',"unique:$table"];
/*
			if($type == 'truck')
			{
				if($vid)
					$validation['vin'] = 
						['required','size:17','regex:/^[0-9ABCDEFGHJKLMNPRSTUVWXYZ]+$/',Rule::unique('trucks')->ignore($vid)];
				else
					$validation['vin'] = 
						['required','size:17','regex:/^[0-9ABCDEFGHJKLMNPRSTUVWXYZ]+$/','unique:trucks'];
			}
			else
			{
				if($vid)
					$validation['vin'] = 
						['required','size:17','regex:/^[0-9ABCDEFGHJKLMNPRSTUVWXYZ]+$/',Rule::unique('cars')->ignore($vid)];
				else
					$validation['vin'] = 
						['required','size:17','regex:/^[0-9ABCDEFGHJKLMNPRSTUVWXYZ]+$/','unique:cars'];
			}
		*/
		}

		/* Vehicle-type specific. */
		if($type == 'truck')
			$validation['bed_length'] = 'required|numeric|min:1';
		if($type == 'boat')
		{
			$validation['length']='required|numeric|min:10|max:200';
			$validation['width']='required|numeric|min:10|max:100';
			$validation['hours']='required|numeric|min:0';

			/* Do something similar with the HIN as the cars and trucks do with the VIN. */
			$requestData = $request->all();
			$requestData['hin'] = strtoupper($requestData['hin']);
			$request->replace($requestData);
			if($vid)
				$validation['hin'] = 
					['required','size:12','regex:/^[0-9A-Z]+$/',Rule::unique($table)->ignore($vid)];
			else
				$validation['hin'] = 
					['required','size:12','regex:/^[0-9A-Z]+$/',"unique:$table"];
		}
		else
		{
			$validation['seats']='required|numeric|min:1|max:100';
			$validation['color']='required|min:1|max:50';
			$validation['mileage']='required|numeric|min:0';
		}

		return Validator::make($request->all(), $validation)->validate();
	}
}
