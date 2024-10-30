<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;
use App\Models\Event;

class EventTypeController extends Controller
{
    public function listEvents(EventType $type){
        $events=$type->events;
        return response()->json(['message'=>null,'data'=>$events],200);
    }
}
