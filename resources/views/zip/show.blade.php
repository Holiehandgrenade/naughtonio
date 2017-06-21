@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{ Form::open([
            'url' => 'zip',
            'method' => 'post',
            'class' => 'form-horizontal col-sm-8 col-sm-offset-2',
        ]) }}

            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                {!! Form::label('zip', null, ['class' => 'col-sm-2 control-label'], false) !!}
                <div class="col-sm-9">
                    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('zip'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zip') }}</strong>
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
