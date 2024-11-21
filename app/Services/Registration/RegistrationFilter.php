<?php

namespace App\Services\Registration;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class RegistrationFilter
{
    /*
    * applying data filters by request fields on queries
    * filters parameter accepts array of  [client , type , company , ended_at ]
    * */
    public static  function filters(Array $filters ,Builder $query , Request $request)
    {
        if (in_array('started_at' , $filters))
        {
            if ($request->get("started_at"))
            {
                $times  =  explode("-", $request->get("started_at"));
                $from   =  Carbon::parse($times[0])->toDateTimeString();
                $to     =  Carbon::parse($times[1])->toDateTimeString();
                $query->whereDate('started_at','<=',$to)
                    ->whereDate('started_at','>=',$from);
            }
        }
        return $query;
    }

}
