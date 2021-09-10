@extends('twill::layouts.settings')

@section('contentFields')

    @formField('input', [
    'name' => 'title-text',
    'label' => 'Title Tag',
    'maxlength' => '20',
    ])

    @formField('input', [
    'name' => 'meta-description',
    'label' => 'Meta Description',
    'maxlength' => '100',
    ])

    @formField('color', [
    'name' => 'meta-theme-colour',
    'label' => 'Meta Theme Colour',
    ])

    @formField('input', [
    'name' => 'issn',
    'label' => 'ISSN',
    'maxlength' => '9',
    ])

    @formField('input', [
    'name' => 'tagline',
    'label' => 'Tagline',
    'maxlength' => '100',
    ])

    @formField('input', [
    'name' => 'motto',
    'label' => 'Motto',
    'maxlength' => '30',
    ])

    @formField('input', [
    'name' => 'masthead-title',
    'label' => 'Title (Masthead)',
    'maxlength' => '20',
    ])

    @formField('input', [
    'name' => 'minihead-title',
    'label' => 'Title (Minihead)',
    'maxlength' => '20',
    ])

    @formField('input', [
    'name' => 'address',
    'label' => 'Address',
    'maxlength' => '100',
    ])

    @formField('input', [
    'name' => 'postcode',
    'label' => 'Postcode',
    'maxlength' => '8',
    ])

    @formField('input', [
    'name' => 'telephone',
    'label' => 'Telephone',
    'maxlength' => '15',
    ])

    @formField('input', [
    'name' => 'copyright',
    'label' => 'Copyright',
    'maxlength' => '30',
    ])

    @formField('input', [
    'name' => 'maxAttention',
    'type' => 'number',
    'label' => 'Max article attention style length',
    'default' => 40,
    'note' => 'Opening sentence emphasis will stop at the last word in this character limit',
    ])

    @formField('input', [
    'name' => 'attentionPunctuationSplit',
    'label' => 'Article attention punctuation splits',
    'default' => '?!,.;:"',
    'note' => 'Opening sentence emphasis will stop at any of these characters',
    ])

    @formField('input', [
    'name' => 'instagram',
    'label' => 'Instagram Account',
    'default' => 'felix_imperial',
    'note' => 'Just the name of the account, no URL',
    ])

    @formField('input', [
    'name' => 'twitter',
    'label' => 'Twitter Handle',
    'default' => 'feliximperial',
    'note' => 'Do not include the @',
    ])

    @formField('input', [
    'name' => 'facebook',
    'label' => 'Facebook Page',
    'default' => 'FelixImperial',
    'note' => 'Just the name of the page, no URL',
    ])

    @formField('input', [
    'name' => 'email',
    'label' => 'E-Mail Account',
    'default' => 'felix@ic.ac.uk'
    ])

    @formField('radios', [
    'name' => 'disable-menu-underline',
    'label' => 'Disable main menu underlines?',
    'default' => 0,
    'inline' => true,
    'options' => [
    ['value' => 0,
    'label' => 'No they look sweet'],
    ['value' => 1,
    'label' => 'Turn that shit off'],
    ]
    ])

    @formField('radios', [
    'name' => 'one-index-featured',
    'label' => 'Zero-index the Featured Stories list?',
    'default' => 0,
    'inline' => true,
    'options' => [
    ['value' => 1,
    'label' => 'Noooo make it start at 1, MATLAB is great'],
    ['value' => 0,
    'label' => 'Haha zero index go brrrrr'],
    ]
    ])

    @formField('input', [
    'name' => 'full-nav-cols',
    'label' => 'Main menu columns (desktop only)',
    'default' => 6,
    'type' => 'number',
    'note' => 'You probably want to make this an integer factor of the number of categories!',
    ])
@stop
