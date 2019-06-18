@extends('master')
@section('title','create new event')
@section('content')
    <div class="container">
        <h3><p>{{ __('ADD NEW EVENT') }}</p></h3>
        @if(isset($mess))
            <p class="alert alert-success">{!! $mess !!}</p>
        @endif
        @if(isset($errors))
            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{$error}}</p>
            @endforeach
        @endif
        <form action="{!! Route('storeEvent') !!}" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label>{{ __('Name') }}</label>
            <input type="text" name="name" value="{!! $event->name !!}" class="form-control">

            <label>{{ __('Promotion price') }}</label>
            <input type="text" name="promotion_price" value="{!! $event->promotion_price !!}" class="form-control">

            <label>{{ __('End promotion') }}</label>
            <input type="text" name="end_promotion" value="{!! $event->end_promotion !!}" class="form-control">

            <br>
            <input class="btn btn-success" value="ADD" type="submit" name="btnsubmit">
            <a class="btn btn-danger" href="{!! Route('indexHome') !!}">{{ __('EXIT') }}</a>
        </form>
    </div>
@endsection
