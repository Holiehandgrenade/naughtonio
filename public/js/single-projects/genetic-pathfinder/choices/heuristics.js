function getRandomHeuristic() {
	var list = [
		'city-walker',
		'euclidean',
	];

	return list[floor(random(0, list.length))];
}
