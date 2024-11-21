<?php

namespace App\Observers;

use App\Models\HealthcareEntity;

class HealthcareObserver
{
    /**
     * Handle the HealthcareEntity "created" event.
     */
    public function created(HealthcareEntity $healthcareEntity): void
    {
        if(request()->file('avatar'))
            $healthcareEntity->addMedia(request()->file('avatar'))->toMediaCollection('avatar');
        if(request()->file('thumbnail'))
            $healthcareEntity->addMedia(request()->file('thumbnail'))->toMediaCollection('thumbnail');
        if(request()->file('background'))
            $healthcareEntity->addMedia(request()->file('background'))->toMediaCollection('background');
        if (!empty(request()->get("services")))
            $healthcareEntity->services()->sync(request()->get('services'));
    }

    /**
     * Handle the HealthcareEntity "updated" event.
     */
    public function updated(HealthcareEntity $healthcareEntity): void
    {
        if (!empty(request()->get("services")))
            $healthcareEntity->services()->sync(request()->get('services'));
    }

    /**
     * Handle the HealthcareEntity "deleted" event.
     */
    public function deleted(HealthcareEntity $healthcareEntity): void
    {
        //
    }

    /**
     * Handle the HealthcareEntity "restored" event.
     */
    public function restored(HealthcareEntity $healthcareEntity): void
    {
        //
    }

    /**
     * Handle the HealthcareEntity "force deleted" event.
     */
    public function forceDeleted(HealthcareEntity $healthcareEntity): void
    {
        //
    }
}
