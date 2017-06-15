@extends('layouts.app')

@section('content')
    {{ Form::open([
        'url' => 'weather-text',
        'method' => 'put'
    ]) }}

    {{ Form::text('phone', $user->phone) }}

    {{ Form::close() }}


    <div>Phone </div>
    <div>Time </div>
    <div>Timezone </div>
    <div>Active </div>
@endsection
