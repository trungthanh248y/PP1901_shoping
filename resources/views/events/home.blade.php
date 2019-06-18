@extends('master')
@section('title','Manage Event')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1>{{ __('List Event') }}</h1>
            </div>
            <hr>
            <div class="col-6">
                <a class="btn btn-success" href="{{Route('addEvent')}}">{{ __('ADD') }}</a>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Promotion price') }}</th>
                    <th scope="col">{{ __('End promotion')}}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <th scope="row">{!! $event->id !!}</th>
                        <td>{!! $event->name !!}</td>
                        <td>{!! $event->promotion_price !!}</td>
                        <td>{!! $event->end_promotion !!}</td>
                        <td>
                            <a class="btn btn-info" href="{!! Route('editEvent',$event->id) !!}">{{ __('Edit') }}</a>
                            <form action="{!! Route('deleteEvent') !!}" method="post">
                                <input type="hidden" name="event_id" value="{!! $event->id !!}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="{{ __('Delete') }}" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
