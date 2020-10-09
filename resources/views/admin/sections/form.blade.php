@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'description',
        'label' => 'Description',
        'maxlength' => 200
    ])

    @formField('input', [
        'name' => 'email',
        'label' => 'Editor E-mail Address',
        'maxlength' => 100
    ])

    @formField('checkbox', [
        'name' => 'current',
        'label' => 'Current',
    ])

    @formField('checkbox', [
        'name' => 'featured',
        'label' => 'Featured',
    ])

    @formField('color', [
        'name' => 'colour',
        'label' => 'Section Colour',
    ])

    @formField('browser', [
        'moduleName' => 'writers',
        'name' => 'writers',
        'label' => 'Section Editors',
        'max' => 10,
    ])
@stop
