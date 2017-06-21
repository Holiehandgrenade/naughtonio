@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if($errors->has('code'))
            <div class="alert alert-danger col-sm-offset-2 col-sm-8" role="alert">
                {{ $errors->first('code') }}
            </div>
        @endif

        {{ Form::open([
            'url' => 'phone',
            'method' => 'post',
            'class' => 'form-horizontal col-sm-8 col-sm-offset-2',
        ]) }}

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {!! Form::label('phone', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone', session('phone'), ['class' => 'form-control']) !!}
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
