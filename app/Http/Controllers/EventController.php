<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.home', compact('events'));
    }

    public function create()
    {

        return view('events.add', compact('events'));
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->name = $request->get('name');
        $event->promotion_price = $request->get('promotion_price');
        $event->end_promotion = $request->get('end_promotion');
        $mess = "";
        if ($event->save()) {
            $mess = "Success add new";
        }

        return view('events.add', compact('event'))->with('mess', $mess);
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->name = $request->get('name');
        $event->promotion_price = $request->get('promotion_price');
        $event->end_promotion = $request->get('end_promotion');
        $mess = "";
        if ($event->save()) {
            $mess = "Success edit";
        }

        return view('events.edit', compact('event'))->with('mess', $mess);
    }

    public function delete(Request $request)
    {
        $event = Event::find($request->get('event_id'));
        $event->delete();
        return redirect('indexHome')->with('mes_del', 'Delete success');
    }
}
