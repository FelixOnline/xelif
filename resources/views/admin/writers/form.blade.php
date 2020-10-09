@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'role',
        'label' => 'Role',
        'maxlength' => 100,
        'required' => true,
    ])

    @formField('input', [
        'name' => 'bio',
        'label' => 'Bio',
        'maxlength' => 250,
        'type' => 'textarea',
        'rows' => 3,
    ])

    @formField('checkbox', [
        'name' => 'current',
        'label' => 'Current',
    ])
@stop
