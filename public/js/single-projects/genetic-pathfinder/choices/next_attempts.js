function getRandomNextAttempt() {
	var list = [
		'back-of-list',
		'front-of-list',
		'smallest-f-front',
		'smallest-f-back',
	];
	return list[floor(random(0, list.length))];
} 