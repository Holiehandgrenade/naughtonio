@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if($errors->has('code'))
            <div class="alert alert-danger col-sm-offset-2 col-sm-8" role="alert">
                {{ $errors->first('code') }}
            </div>
        @endif

        <h4 class="text-center">
            This service requires a phone number
        </h4>

        {{ Form::open([
            'url' => 'phone',
            'method' => 'post',
            'class' => 'form-horizontal col-sm-8 col-sm-offset-2',
        ]) }}


            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {!! Form::label('phone', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">

                    <input
                            id="phone"
                            name="phone"
                            type="number"
                            class="form-control"
                            value="{{ session('phone') }}"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    />

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                <div class="col-sm-offset-2 col-sm-3">
                    {!! Form::submit('Submit', ['class' => 'form-control btn btn-primary']) !!}
                </div>
            </div>

        {{ Form::close() }}
    </div>
@endsection
