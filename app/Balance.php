<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
	use SoftDeletes;

	protected $table = "balance";
	protected $fillable = ['amount', 'transaction_id', 'created_at', 'updated_at', 'deleted_at'];
}
