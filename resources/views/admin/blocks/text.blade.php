@formField('wysiwyg', [
    'name' => 'html',
    'label' => '',
    'placeholder' => 'Text',
    'toolbarOptions' => [
        'bold',
        'italic',
        ['header' => [2, 3, false]],
        ['list' => 'bullet'],
        ['list' => 'ordered'],
        'link',
        'clean'
    ],
    'editSource' => true,
    'translated' => false,
])
