<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Transaction;
use DB;
use App\User;
use App\ApiKey;
use App\Libraries\Res;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class SandboxController extends Controller
{
	public function home()
	{

	}

	public function getPlayerInfo(Request $request)
	{
		try {

			$validator = Validator::make($request->all(), [
				'api_key' => 'required',
				'user_id' => 'required'
			]);

			if ($validator->fails()) {
				throw new ValidationException($validator, Response::HTTP_BAD_REQUEST, $validator->errors());
			}

			$checkApiKey = ApiKey::where('api_key', $request->api_key)->count();

			if (!$checkApiKey) {
				return Res::fail(Response::HTTP_FORBIDDEN, 'wrong token parameters!');
			}

			$getPlayerInfo = User::select('id', 'name', 'email', 'created_at')->find($request->user_id);

			if ($getPlayerInfo) {
				return Res::success(Response::HTTP_OK, 'get player info', $getPlayerInfo);
			} else {
				return Res::fail(Response::HTTP_NOT_FOUND, 'user not found!');
			}

		} catch (ValidationException $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		} catch (Exception $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		}
	}

	public function withdraw(Request $request)
	{
		try {

			$validator = Validator::make($request->all(), [
				'api_key' => 'required',
				'user_id' => 'required',
				'amount' => 'required',
			]);

			if ($validator->fails()) {
				throw new ValidationException($validator, Response::HTTP_BAD_REQUEST, $validator->errors());
			}

			$checkApiKey = ApiKey::where('api_key', $request->api_key)->count();

			if (!$checkApiKey) {
				return Res::fail(Response::HTTP_FORBIDDEN, 'wrong token parameters!');
			}

			$withdraw = Balance::insert([
				'user_id' => $request->user_id,
				'amount' => $request->amount,
			]);

			$getPlayerInfo = User::select('id', 'name', 'email', 'created_at')->find($request->user_id);

			return Res::success(Response::HTTP_OK, 'withdraw is successfully', $getPlayerInfo);

		} catch (ValidationException $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		} catch (Exception $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		}
	}

	public function withdrawDeposit(Request $request)
	{
		try {

			$validator = Validator::make($request->all(), [
				'api_key' => 'required',
				'user_id' => 'required',
				'amount' => 'required',
			]);

			if ($validator->fails()) {
				throw new ValidationException($validator, Response::HTTP_BAD_REQUEST, $validator->errors());
			}

			$checkApiKey = ApiKey::where('api_key', $request->api_key)->count();

			if (!$checkApiKey) {
				return Res::fail(Response::HTTP_FORBIDDEN, 'wrong token parameters!');
			}

			$withdrawDeposit = Balance::insert([
				'user_id' => $request->user_id,
				'amount' => $request->amount,
			]);

			$getPlayerInfo = User::select('id', 'name', 'email', 'created_at')->find($request->user_id);

			return Res::success(Response::HTTP_OK, 'withdraw deposit is successfully', $getPlayerInfo);

		} catch (ValidationException $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		} catch (Exception $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		}
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|string
	 */
	public function rollbackTransaction(Request $request)
	{
		try {

			$validator = Validator::make($request->all(), [
				'api_key' => 'required',
				'user_id' => 'required',
				'transaction_id' => 'required'
			]);

			if ($validator->fails()) {
				throw new ValidationException($validator, Response::HTTP_BAD_REQUEST, $validator->errors());
			}

			$checkApiKey = ApiKey::where('api_key', $request->api_key)->count();

			if (!$checkApiKey) {
				return Res::fail(Response::HTTP_FORBIDDEN, 'wrong token parameters!');
			}

			$rollbackTransaction = Balance::where([
				'user_id' => $request->user_id,
				'transaction_id' => $request->transaction_id
			])->delete();

			if (!$rollbackTransaction) {
				return Res::fail(Response::HTTP_BAD_REQUEST, 'Transaction Not Found');
			}

			$getPlayerInfo = User::select('id', 'name', 'email', 'created_at')->find($request->user_id);

			return Res::success(Response::HTTP_OK, 'rollback is successfully', $getPlayerInfo);


		} catch (ValidationException $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		} catch (Exception $e) {
			return Res::fail($e->getCode(), $e->getMessage());
		}
	}
}
