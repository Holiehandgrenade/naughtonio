@extends('layouts.app')

@section('content')

        <div class="container">
                <div style="height: 100%;">
                        {{--Selection Header--}}
                        <div style="margin-bottom: 40px;">
                                <character-inputs
                                        :characters="{{ $characters }}"
                                        selected-one="{{ session()->get('characterSelectedOne') }}"
                                        selected-two="{{ session()->get('characterSelectedTwo') }}"
                                >
                                </character-inputs>
                        </div>

                        {{--Output Body--}}
                        <div style="text-align: center; overflow: scroll; height: 70%;">
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
                        <div style="position: fixed; bottom: 30px; border: 1px solid; margin-top: 40px;" class="row col-xs-12">
                                <div class="col-xs-4">
                                        <a>About the algorithm</a>
                                </div>
                                <div class="col-xs-4 col-xs-offset-4">
                                        <a>Contributing to the library</a>
                                </div>
                        </div>
                </div>
        </div>

@endsection
