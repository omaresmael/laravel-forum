<?php


namespace App;


trait RecordActivities
{

    protected static function bootRecordActivities(){
        foreach (static::eventsOccurrence() as $event)
        static::$event( function ($instance) use ($event){ // this function is called whenever an instance has an event (created,updated, etc..)....
            $instance->recordActivity($event); // this function record the events occurred to instance on the activity table
        });
}

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $event . '_' . strtolower((new \ReflectionClass($this))->getShortName()), //this reflectionClass somehow returns the model that associated to the event

        ]);
    }
    protected static function eventsOccurrence(){ // this returns the events that associated to the instance
        return ['created'];
    }
    public function activity(){
        return $this->morphMany(Activity::class,'subject');
    }


}
