@extends('twill::layouts.form')

@section('contentFields')
    @formField('select', [
    'name' => 'issue_id',
    'label' => 'Issue',
    'options' => $issues,
    ])

    @formField('input', [
    'name' => 'headline',
    'label' => 'Headline',
    'maxlength' => 75,
    'required' => true,
    ])

    @formField('input', [
    'name' => 'lede',
    'label' => 'Lede',
    'maxlength' => 150,
    'required' => true,
    'type' => 'textarea',
    'rows' => 2,
    ])

    @formField('select', [
    'unpack' => true,
    'name' => 'section_id',
    'label' => 'Section',
    'options' => $sections,
    ])

    @formField('browser', [
    'moduleName' => 'writers',
    'name' => 'writers',
    'label' => 'Authors',
    'max' => 5,
    ])

    @formField('medias', [
    'name' => 'main',
    'label' => 'Main Image',
    ])

    @formField('block_editor', [
    'blocks' => ['text', 'quotation', 'sidebar', 'image', 'review', 'book-review']
    ])
@stop
