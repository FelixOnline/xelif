@extends('layouts.core')

@section('html-title')
    @parent / {{ $section->title }}
@endsection

@section('body')
    <section class="sec-review sec-{{ $section->id }}">
        <hr/>
        <header>
            <h1>{{ $section->title }}</h1>
            <p class="editors"><span>Section Editor:</span>
                <x-name-list :writers="$section->writers"/>
            </p>
            <p class="email">
                e: <a href="mailto:{{ $section->email }}">{{ $section->email }}</a>
            </p>
            <p class="description">{{ $section->description }}</p>
        </header>

        <section class="additional-articles">
            @foreach ($articles as $tease)
                <x-tease :article="$tease" image="true" :section="false" :byline="true"/>
            @endforeach
        </section>

        <section class="pagination">
            <x-pagination :pageable="$section" :page="$page" :numPages="$numPages"/>
        </section>
    </section>
@endsection
