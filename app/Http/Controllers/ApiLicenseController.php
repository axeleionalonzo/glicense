<?php namespace App\Http\Controllers;

use App\License as ActCode;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class ApiLicenseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$licenses = ActCode::all();
		return response()->json($licenses);
	}

	/**
	 * Rules for validation
	 *
	 * @return Response
	 */
	private static function rules($id=0, $merge=[])
	{
		// we used array merge so that we can add additional rules when needed
		return array_merge(
        [
            'act_code'			=> 'required|unique:tsqgeointel_activation,act_code' . ($id ? ",$id" : ''),
            'organization'		=> 'required',
            'status'			=> 'required|boolean',
            'device_code'		=> 'required|unique:tsqgeointel_activation,device_code' . ($id ? ",$id" : ''),
            'project'			=> 'required',
            'act_date'			=> 'required'
        ], 
        $merge);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $validator = Validator::make(Request::all(), ApiLicenseController::rules());

        if ($validator->fails()) {
			return response()->json(array(
				'success'	=> false,
				'status'	=> $validator->messages()
				));
        } else {

			$license = ActCode::create(Request::all());
			return response()->json(array(
				'success'	=> true,
				'license'	=> $license,
				'status'	=> $validator->messages()
				));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{	
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $validator = Validator::make(Request::all(), ApiLicenseController::rules($id));

        if ($validator->fails()) {
			return response()->json(array(
				'success'	=> false,
				'status'	=> $validator->messages()
				));
        } else {

			$license = ActCode::find($id);
            $license->act_code		= Request::get('act_code');
            $license->organization	= Request::get('organization');
            $license->status		= Request::get('status');
            $license->device_code	= Request::get('device_code');
            $license->project		= Request::get('project');
            $license->act_date		= Request::get('act_date');
			$license->save();

			return response()->json(array(
				'success'	=> true,
				'license'	=> $license,
				'status'	=> $validator->messages()
				));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ActCode::destroy($id);
		return response()->json(array('success' => true));
	}

}
