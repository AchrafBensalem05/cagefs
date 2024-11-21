<?php
namespace  App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait HealthCareTrait
{
    private function schedule_format(Request $request)
    {
        $schedule = [];
        foreach($request->get('opening_hours') as $key => $item)
            if (array_key_exists('checked' , $item))
                $schedule[$key] = [($item['start'] ?? '00:00') . '-' . ($item['end'] ?? '23:59')];
        return json_encode($schedule);
    }
}
