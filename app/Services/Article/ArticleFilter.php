<?php

namespace App\Services\Article;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ArticleFilter
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
            $builder->where('title' , 'like' , "%" . $request->get('q') . "%")
                ->orWhere('content' , 'like' , "%" .$request->get('q') . "%");

        if (in_array('wilaya' , $filters))
            if(is_numeric($request->get('wilaya')) and $request->get('wilaya') != '*')
                $builder->whereHas('daira_rel' , function (Builder $query ) use ($request)
                {
                    $query->where('wilaya' , $request->get('wilaya'));
                });
        if (in_array('emergency' , $filters))
            if($request->get('emergency') != '*' and  $request->get('emergency'))
                $builder->where('emergency' , $request->get('emergency'));

        if (in_array('medication_type' , $filters))
            if($request->get('medication_type') != '*' and  $request->get('medication_type'))
                $builder->where('medication_type' , $request->get('medication_type'));

        if (in_array('section' , $filters))
            if($request->get('section') != '*' and  $request->get('section'))
                $builder->where('section' , $request->get('section'));

        if (in_array('area' , $filters))
            if($request->get('area') != '*' and  $request->get('area'))
                $builder->where('area' , $request->get('area'));


        if (in_array('blood' , $filters))
            if($request->get('blood') and $request->get('blood') != '*')
                $builder->where('blood' , $request->get('blood'));

        if (in_array('language' , $filters))
            if($request->get('language') and $request->get('language') != '*')
                $builder->where('language' , $request->get('language'));

        if (in_array('wilaya_id' , $filters))
            if(is_numeric($request->get('wilaya_id')) and $request->get('wilaya_id') != '*')
                $builder->whereHas('daira_rel' , function (Builder $query ) use ($request)
                {
                    $query->where('wilaya' , $request->get('wilaya_id'));
                });

        if (in_array('daira_id' , $filters))
            if ($request->get("daira_id") and $request->get('daira_id') != '*')
                $builder->where('daira' , $request->get('daira_id'));

        return $builder;
    }

}
