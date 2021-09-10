@formField('input', [
'name' => 'title',
'label' => 'Title',
'note' => 'E.g. "Of Mice and Men"',
])

@formField('input', [
'name' => 'author',
'label' => 'Author',
])

@formField('input', [
'name' => 'publisher',
'label' => 'Publisher (Optional)',
])

@formField('radios', [
'name' => 'stars',
'label' => 'Stars',
'inline' => true,
'options' => [
['value' => 1, 'label' => '1'],
['value' => 2, 'label' => '2'],
['value' => 3, 'label' => '3'],
['value' => 4, 'label' => '4'],
['value' => 5, 'label' => '5'],
]
])
