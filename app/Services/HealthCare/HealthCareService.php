<?php
namespace App\Services\HealthCare;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HealthCareService
{
    public function filter_healthcare(Builder $builder , Request $request)
    {
            if($request->get('q'))
            {
                $q = preg_replace('/\s+/', ' ', $request->get("q"));

                $Terms = explode(' ', $q);

                $builder->select('*')
                    ->selectRaw('
                         CASE
                             WHEN `fname` LIKE ? THEN 1
                             ELSE 0
                         END +
                         CASE
                             WHEN `lname` LIKE ? THEN 1
                             ELSE 0
                         END AS matches', ['%' . $Terms[0] . '%', '%' . $Terms[0] . '%'])->where(function ($query) use ($Terms) {
                    foreach ($Terms as $term) {
                        $query->orWhere('name', 'like', '%' . $term . '%')
                            ->orWhere('fname', 'like', '%' . $term . '%')
                            ->orWhere('lname', 'like', '%' . $term . '%')
                            ->orWhere('titulation', 'like', '%' . $term . '%');
                    }
                })  ->orWhere('sex' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('address' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('description' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('tags' , 'like' , "%" . $request->get('q') . "%")
                    ->orWhere('diplomas' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('experience' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('languages' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('equipment' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('customers_result' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('payments' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('phones' , 'like' , "%" .$request->get('q') . "%")
                    ->orWhere('description' , 'like' , "%" .$request->get('q') . "%");
            }


            if (is_numeric($request->get('wilaya')) and $request->get('wilaya') != '*')
                $builder->whereHas('daira' , function (Builder $query ) use ($request)
                {
                    $query->where('wilaya_id' , $request->get('wilaya'));
                });

            if ($request->get("daira_id") and $request->get('daira_id') != '*')
                $builder->where('daira_id' , $request->get('daira_id'));

            if ($request->get("sex") and $request->get('sex') != '*')
                $builder->where('sex' , $request->get('sex'));

            if(is_numeric($request->get("type")))
                $builder->where('type' , $request->get("type"));


            if ($request->get("q"))
                return $builder->orderBy('matches', 'desc');
            else return  $builder;
    }
}
