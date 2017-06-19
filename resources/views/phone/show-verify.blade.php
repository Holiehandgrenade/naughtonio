@extends('layouts.app')

@section('content')

    @if(session('code'))
        <div class="alert alert-danger" role="alert">
            {{ session('code') }}
        </div>
    @endif

    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    {{ Form::open([
        'url' => 'phone-verify',
        'method' => 'post',
        'class' => 'form-horizontal',
    ]) }}

        <div class="form-group">
            {!! Form::label('phone', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::text('phone', $phone, ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
            {!! Form::label('code', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
            <div class="col-md-6">
                {!! Form::submit('Submit', ['class' => 'form-control']) !!}
            </div>
        </div>

    {{ Form::close() }}
@endsection
