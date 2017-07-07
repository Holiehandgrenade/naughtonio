@extends('layouts.app')

@section('content')

    <failed-phone-verification
        :verification="{{ $phoneVerification }}"
    >
    </failed-phone-verification>

    <div class="container-fluid">
        @if(session('code'))
            <div class="alert alert-danger col-sm-8 col-sm-offset-2" role="alert">
                {{ session('code') }}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success col-sm-8 col-sm-offset-2" role="alert">
                {{ session('message') }}
            </div>
        @endif

        {{ Form::open([
            'url' => 'phone-verify',
            'method' => 'post',
            'class' => 'form-horizontal col-sm-8 col-sm-offset-2',
        ]) }}

            <div class="form-group">
                {!! Form::label('phone', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone', $phoneVerification->pending_phone, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>

            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                {!! Form::label('code', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">
                    <numeric-input
                            id="code"
                            type="tel"
                            name="code"
                            class="form-control"
                    >
                    </numeric-input>

                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
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
