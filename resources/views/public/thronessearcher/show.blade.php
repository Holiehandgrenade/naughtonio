@extends('layouts.app')

@section('content')

        <div class="container">
                <div
                        style="padding:15px;"
                >
                        <character-inputs
                                :characters="{{ $characters }}"
                                selected-one="{{ session()->get('characterSelectedOne') }}"
                                selected-two="{{ session()->get('characterSelectedTwo') }}"
                        >
                        </character-inputs>

                        <div style="text-align: center;">
                                @if(session()->has('path'))
                                        @if( ! session()->get('path'))
                                                <p>no path found</p>
                                        @else
                                                @foreach(session()->get('path') as $character => $relation)
                                                        <p class="thrones-searcher-character">
                                                                {{$character}}
                                                        </p>
                                                        <p class="thrones-searcher-relationship">
                                                                {{ $relation }}
                                                        </p>
                                                @endforeach
                                        @endif
                                @endif
                        </div>
                </div>
        </div>

@endsection
