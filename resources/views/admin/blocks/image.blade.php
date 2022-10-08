@formField('medias', [
    'name' => 'image',  // role
    'label' => 'Image',
    'withVideoUrl' => false,
    'translated' => false,
])

@formField('radios', [
    'name' => 'float',
    'label' => 'Pull',
    'inline' => true,
    'default' => null,
    'options' => [
        ['value' => null, 'label' => 'No Text Wrap'],
        ['value' => 'left', 'label' => 'Left'],
        ['value' => 'right', 'label' => 'Right'],
    ]
])

@formField('input', [
    'name' => 'width',
    'label' => 'Width (%)',
    'default' => 100,
    'type' => 'number',
])
