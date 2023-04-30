<?php

namespace App\Libraries;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class ActivityLog extends Model
{
    protected $primaryKey = 'activity_log_id';
    protected $table="activity_log";

    public function store($request)
    {
        $rem_ip=$_SERVER["REMOTE_ADDR"];
        $server_ip=$_SERVER["SERVER_NAME"];
        $log_ip="HOSTED:[".$server_ip."] ACCESSED:[".$rem_ip.']';
        $act_log = new ActivityLog;
		$act_log->log_user			= Auth::id();
		$act_log->route_name		= $request->route()->getName();
		$act_log->log_link			= $request->fullUrl();
		$act_log->log_params		= substr(json_encode($request->input()),0,4000);
        $act_log->log_type          = 'ACCESS';
        $act_log->log_from          = config('app.name', 'KD');
		$act_log->log_ip			= $log_ip;
        $act_log->save();
    }
}
