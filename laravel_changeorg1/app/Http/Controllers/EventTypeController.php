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
    public function storeType(Request $request){
        $event=new EventType();
        $event=EventType::Create([
            'description'=>$request->get('description'),
        ]);
        return response()->json(['message'=>"Tipo de evento creado",'data'=>$event],200);
    }
}
