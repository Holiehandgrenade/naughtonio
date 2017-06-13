function getRandomAddNeighbor() {
	var list = [
		'prefer-vertical',
		'prefer-horizontal',
		'prefer-bottom-right',
		'prefer-right-bottom',
		'prefer-calculated-diagonal',
	];

	return list[floor(random(0, list.length))];
}