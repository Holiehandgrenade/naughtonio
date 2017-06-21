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

        <form
                method="POST"
                action="/phone"
                class="form-horizontal col-sm-offset-2 col-sm-8"
        >
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {!! Form::label('phone', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">
                    <input
                            id="phone"
                            name="phone"
                            type="tel"
                            class="form-control"
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
        </form>
    </div>
@endsection
