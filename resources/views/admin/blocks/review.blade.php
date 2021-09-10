@formField('input', [
'name' => 'what',
'label' => 'What',
'note' => 'E.g. "Musical"'
])

@formField('input', [
'name' => 'title',
'label' => 'Title',
'note' => 'E.g. "Wast Side Story"',
])

@formField('input', [
'name' => 'where',
'label' => 'Where',
])

@formField('input', [
'name' => 'when',
'label' => 'When',
])

@formField('input', [
'name' => 'cost',
'label' => 'Cost',
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
