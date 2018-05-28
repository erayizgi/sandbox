<?php
/**
 * Created by PhpStorm.
 * User: cebozkurt
 * Date: 28.05.2018
 * Time: 12:14
 */

namespace App\Libraries;

use Illuminate\Http\Request;

class Res
{
	public static function success($code = 200, $message = 'Request is successfull!', $data = null)
	{
		$response = [
			'result' => true,
			'code' => $code,
			'message' => $message,
			'data' => $data
		];

		return response()->json($response, $code);
	}

	public static function fail($code = 404, $message = 'Not found!', $data = null)
	{
		$response = [
			'result' => false,
			'code' => $code,
			'message' => $message,
			'data' => $data
		];
		return response()->json($response, $code);
	}

	public static function error($desc = null, $code = null, $http = null){
		$response = [
			'result' => false,
			'err_desc' => $desc,
			'err_code' => $code
		];

		return response()->json($response, $http);
	}
}
