@extends('layouts.app')

@section('content')
    {{ Form::open([
        'url' => 'weather-text',
        'method' => 'put',
        'class' => 'form-horizontal',
    ]) }}

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            {!! Form::label('phone', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
                @if ($errors->has('phone'))
                    <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
            {!! Form::label('time', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::select('time', $times, $weatherText ? $weatherText->time : null, ['class' => 'form-control']) !!}
                @if ($errors->has('time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('time') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('timezone') ? ' has-error' : '' }}">
            {!! Form::label('timezone', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::select('timezone', $timezones, $user->timezone, ['class' => 'form-control']) !!}
                @if ($errors->has('timezone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('timezone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
            {!! Form::label('active', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::text('active', $weatherText ? $weatherText->active : null, ['class' => 'form-control']) !!}
                @if ($errors->has('active'))
                    <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                @endif
            </div>
        </div>
    {{ Form::close() }}
@endsection
