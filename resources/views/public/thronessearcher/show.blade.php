@extends('layouts.app')

@section('content')

        <div class="container">
                <div style="height: 100%;">
                        {{--Selection Header--}}
                        <h4 style="text-align: center;">Select two Song of Ice and Fire characters to find how they're connected</h4>
                        <div style="margin-bottom: 40px;">
                                <character-inputs
                                        :characters="{{ $characters }}"
                                        selected-one="{{ session()->get('characterSelectedOne') }}"
                                        selected-two="{{ session()->get('characterSelectedTwo') }}"
                                >
                                </character-inputs>
                        </div>

                        {{--Output Body--}}
                        <div style="text-align: center;">
                                @if(session()->has('path'))
                                        @if( ! session()->get('path'))
                                                <p>No path found</p>
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

                        {{--Footer--}}
                        <div></div>
                </div>
        </div>

@endsection
