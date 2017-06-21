@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissable col-sm-8 col-sm-offset-2" role="alert">
                <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif


        {{ Form::open([
            'url' => 'weather-text',
            'method' => 'patch',
            'class' => 'form-horizontal col-sm-8 col-sm-offset-2',
        ]) }}

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {!! Form::label('phone', null, ['class' => 'col-sm-2 control-label'], false) !!}

                <div class="col-sm-9">
                    {!! Form::text('phone', $user->phone, ['class' => 'form-control', 'readonly']) !!}
                    @if ($errors->has('phone'))
                        <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                {!! Form::label('zip', null, ['class' => 'col-sm-2 control-label'], false) !!}

                <div class="col-sm-9">
                    {!! Form::text('zip', $user->zip, ['class' => 'form-control', 'readonly']) !!}
                    @if ($errors->has('zip'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                {!! Form::label('time', null, ['class' => 'col-sm-2 control-label'], false) !!}

                <div class="col-sm-9">
                    {!! Form::select('time', $times, $weatherText ? $weatherText->time : null, ['class' => 'form-control']) !!}
                    @if ($errors->has('time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('timezone') ? ' has-error' : '' }}">
                {!! Form::label('timezone', null, ['class' => 'col-sm-2 control-label'], false) !!}

                <div class="col-sm-9">
                    {!! Form::select('timezone', $timezones, $user->timezone, ['class' => 'form-control']) !!}
                    @if ($errors->has('timezone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('timezone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                {!! Form::label('active', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">
                    {!! Form::checkbox('active', '1', $weatherText ? $weatherText->active : true) !!}
                    @if ($errors->has('active'))
                        <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <div class="col-sm-offset-2 col-sm-3">
                    {!! Form::submit('Save', ['class' => 'form-control btn btn-primary']) !!}
                </div>
            </div>
        {{ Form::close() }}
    </div>
@endsection
