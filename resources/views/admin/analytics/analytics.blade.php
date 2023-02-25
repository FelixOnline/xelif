@extends('twill::layouts.free')

@push('extra_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
@endpush
@push('extra_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#analytics-table').DataTable(
                {"order": [[3, 'desc']]}
            );
        });
    </script>
@endpush
@section('customPageContent')
    <a17-fieldset title="Article views of the past 7 days">
        <table id="analytics-table">
            <thead>
            <tr>
                <th>Issue</th>
                <th>Article</th>
                <th>Section</th>
                <th>Views</th>
                <th>CSV Export</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    @if ($article->issue)
                        <td>{{ $article->issue->issue }}</td>
                    @else
                        <td>No Issue</td>
                    @endif
                    <td><a href="{{$article->link()}}">{{ $article->headline }}</a></td>
                    <td>{{ $article->section->title }}</td>
                    <td>{{ $article->view_count }}</td>
                    <td><a href="{{ route("admin.analytics.articleView", ["id" => $article->id]) }}">Export</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </a17-fieldset>
@stop
