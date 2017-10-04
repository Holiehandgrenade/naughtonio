@extends('layouts.app')

@section('content')
        <character-inputs
                :characters="{{ $characters }}"
                selected-one="{{ session()->get('characterSelectedOne') }}"
                selected-two="{{ session()->get('characterSelectedTwo') }}"
        >
        </character-inputs>

        @if(session()->has('path'))
                @foreach(session()->get('path') as $character => $relation)
                        {{$character}} : {{ $relation }} <br>
                @endforeach
        @endif
@endsection
