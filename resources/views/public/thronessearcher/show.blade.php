@extends('layouts.app')

@section('content')
        <character-inputs
            :characters="{{ $characters }}"
        >
        </character-inputs>
@endsection
