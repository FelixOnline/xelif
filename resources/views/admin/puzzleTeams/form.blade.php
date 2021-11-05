@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
    'name' => 'points',
    'label' => 'Points',
    'type' => 'number'
    ])
@stop
