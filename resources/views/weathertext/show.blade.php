@extends('layouts.app')

@section('content')
    {{--{{ Form::open([--}}
        {{--'url' => 'weather-text',--}}
        {{--'method' => 'put',--}}
        {{--'class' => 'form-horizontal',--}}
    {{--]) }}--}}

    {{--{{ Form::text('phone', $user->phone) }}--}}

    {{--{{ Form::close() }}--}}


    {{--<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">--}}
        {{--{!! Form::label('first_name', 'First Name <span class="beanstalk-required"></span>', ['class' => 'col-md-4 control-label'], false) !!}--}}

        {{--<div class="col-md-6">--}}
            {{--{!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}--}}
            {{--@if ($errors->has('first_name'))--}}
                {{--<span class="help-block">--}}
                {{--<strong>{{ $errors->first('first_name') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}


    <div>Phone </div>
    <div>Time </div>
    <div>Timezone </div>
    <div>Active </div>
@endsection
