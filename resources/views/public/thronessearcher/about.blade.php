@extends('layouts.app')

@section('content')

    <div class="container">
        <p>Inspired by <a href="https://oracleofbacon.org/">The Oracle of Bacon,</a> this program uses a
            <a href="http://www.redblobgames.com/pathfinding/a-star/introduction.html#breadth-first-search">Breadth First Search</a>
             algorithm to find any possible paths between two given characters in the world of A Song of Ice and Fire.
        </p>

        <p>The connections between characters are currently defined by if they are at least one of the following:
            <ol>
                <li>Married</li>
                <li>Share a common house allegiance</li>
            </ol>

            Out of interest of separate paths, I randomize some of the connections. This means you won't always see the
            shortest path, but you may get new and interesting paths each successive search.
        </p>

        <p>The data source of characters is graciously hosted on GitHub by user Joakimskoog and if you'd like to contribute,
            <a href="https://github.com/joakimskoog/AnApiOfIceAndFire/blob/master/CONTRIBUTING.md">you can find the instructions on how to do so here</a>.
        </p>

        <a href="{{ route('ice-and-fire-form') }}">Return to Search</a>
    </div>

@endsection
