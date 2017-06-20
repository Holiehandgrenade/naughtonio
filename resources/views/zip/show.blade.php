@extends('layouts.app')

@section('content')
    {{ Form::open([
        'url' => 'zip',
        'method' => 'post',
        'class' => 'form-horizontal',
    ]) }}

        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
            {!! Form::label('zip', null, ['class' => 'col-md-4 control-label'], false) !!}

            <div class="col-md-6">
                {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                @if ($errors->has('zip'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zip') }}</strong>
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
