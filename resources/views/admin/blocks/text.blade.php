@formField('wysiwyg', [
    'name' => 'html',
    'label' => '',
    'placeholder' => 'Text',
    'toolbarOptions' => [
        'bold',
        'italic',
        'underline',
        ['header' => [2, 3, false]],
        ['list' => 'bullet'],
        ['list' => 'ordered'],
        'link',
        'blockquote',
        'code-block',
        ['script' => 'super'],
        ['script' => 'sub'],
        ['indent' => '-1'],
        ['indent' => '+1'],
        'clean'
    ],
    'translated' => false,
])
