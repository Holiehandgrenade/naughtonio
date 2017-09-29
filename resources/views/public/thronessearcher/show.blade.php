@extends('layouts.app')

@section('content')
    <form action="/song-of-ice-and-fire-connector" method="post">
        <input list="characters" name="character">
        <datalist id="characters">
            @foreach($characters as $characterId => $characterName)
                <option value="{{ $characterName }}">adsfdsa</option>
            @endforeach
        </datalist>
        <input type="submit">
    </form>
@endsection
