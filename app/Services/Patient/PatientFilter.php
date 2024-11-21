<?php

namespace App\Services\Patient;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class PatientFilter
{
    /*
    * applying data filters by request fields on queries
    * filters parameter accepts array of  [client , type , company , ended_at ]
    * */
    public static  function filters(Array $filters ,Builder $builder , Request $request)
    {
        if (in_array('created_at' , $filters))
        {
            if ($request->get("created_at"))
            {
                $times  =  explode("-", $request->get("created_at"));
                $from   =  Carbon::parse($times[0])->toDateTimeString();
                $to     =  Carbon::parse($times[1])->toDateTimeString();
                $builder->whereDate('created_at','<=',$to)
                    ->whereDate('created_at','>=',$from);
            }
        }

        if($request->get('q'))
            $builder->where('name' , 'like' , "%" . $request->get('q') . "%")
                ->orWhere('fname' , 'like' , "%" .$request->get('q') . "%")
                ->orWhere('lname' , 'like' , "%" .$request->get('q') . "%");

        if (in_array('wilaya' , $filters))
            if(is_numeric($request->get('wilaya')) and $request->get('wilaya') != '*')
                $builder->whereHas('daira' , function (Builder $query ) use ($request)
                {
                    $query->where('wilaya_id' , $request->get('wilaya'));
                });

        if (in_array('wilaya_id' , $filters))
            if(is_numeric($request->get('wilaya_id')) and $request->get('wilaya_id') != '*')
                $builder->whereHas('daira' , function (Builder $query ) use ($request)
                {
                    $query->where('wilaya_id' , $request->get('wilaya_id'));
                });

        if (in_array('daira_id' , $filters))
            if ($request->get("daira_id") and $request->get('daira_id') != '*')
                $builder->where('daira_id' , $request->get('daira_id'));

        return $builder;
    }

}
