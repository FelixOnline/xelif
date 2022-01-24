@formField('input', [
'name' => 'title',
'label' => 'Title',
'note' => 'E.g. "Citizen Kane"',
])

@formField('input', [
'name' => 'director',
'label' => 'Director',
])

@formField('input', [
'name' => 'year',
'label' => 'Year',
])

@formField('input', [
'name' => 'starring',
'label' => 'Starring (Optional)',
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
