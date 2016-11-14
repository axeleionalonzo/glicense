<?php namespace App;


use Illuminate\Database\Eloquent\Model;

class License extends Model {

	protected $table = 'tsqgeointel_activation';
	protected $primaryKey = 'act_id';

	protected $fillable = [
		'act_code',
		'organization',
		'status',
		'device_code',
		'project',
		'act_date'
	];
	public $timestamps = false;
	
}