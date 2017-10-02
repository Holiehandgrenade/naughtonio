@extends('layouts.app')

@section('content')
        <character-inputs
            :characters="{{ $characters }}"
        >
        </character-inputs>


        @if(session()->has('path'))
                {{ dd(session()->get('path')) }}
        @endif
@endsection
