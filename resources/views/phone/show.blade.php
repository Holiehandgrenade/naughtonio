@extends('layouts.app')

@section('content')

    @if(session('code'))
        <div class="alert alert-danger" role="alert">
            {{ session('code') }}
        </div>
    @endif

    {{ Form::open([
        'url' => 'phone',
        'method' => 'post',
        'class' => 'form-horizontal',
    ]) }}

        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            {!! Form::label('phone', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::text('phone', session('phone') ? session('phone') : null, ['class' => 'form-control']) !!}
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
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
