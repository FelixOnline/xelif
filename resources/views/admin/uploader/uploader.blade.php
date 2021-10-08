@extends('twill::layouts.free')

@section('customPageContent')
    <a17-fieldset title="Upload Word Document (Experimental)">
        <form action="{{ $saveUrl }}" novalidate method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('twill::partials.form._select', ['name'=>'issue', 'label'=>'Issue', 'options'=>$issues, 'form_fields'=>''])
            <a17-textfield name="headline" label="Headline"></a17-textfield>
            {{--            FIXME: this should be unpacked but it doesn't work somehow --}}
            @include('twill::partials.form._select', ['name'=>'section', 'label'=>'Section', 'options'=>$sections, 'form_fields'=>''])
            <a17-inputframe label="Select .docx file">
                <input type="file" name="word-file" accept=".docx">
            </a17-inputframe>
            <br>
            <a17-button variant="validate" type="submit">Submit</a17-button>
        </form>
    </a17-fieldset>
@stop