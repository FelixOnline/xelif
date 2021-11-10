@props(['teams'])
@once
    @push('head-css')
        <style>
            table.leaderboard-table {
                border: 1px solid;
                width: 100%;
                font-size: 1.5em;
                background-color: #e7e0ce;
            }
        </style>
    @endpush
@endonce
<table class="leaderboard-table">
    @foreach($teams as $i => $team)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$team->name}}</td>
            <td>{{$team->points}}</td>
        </tr>
    @endforeach
</table>