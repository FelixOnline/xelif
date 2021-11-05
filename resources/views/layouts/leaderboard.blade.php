@extends('layouts.core')

@section('html-title')
    Felix Puzzles Leaderboard
@endsection

@section('body')
    <table>
        @foreach($teams as $team)
            <tr>
                <th>{{$team->name}}</th>
                <th>{{$team->points}}</th>
            </tr>
        @endforeach
    </table>
@endsection
