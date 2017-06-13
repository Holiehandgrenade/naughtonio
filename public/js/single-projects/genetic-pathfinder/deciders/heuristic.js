var heur = 0;

function heuristic(a) {
	switch(Pathfinder.dna.genes.heuristic) {
		case 'city-walker':
			cityWalker(a);
		case 'euclidean':
			euclidean(a);
	}

	return heur * Pathfinder.dna.genes.heuristicWeight;
}

// difference vertically and horizontally
function cityWalker(a) {
	heur = (abs(a.i - end.i) + abs(a.j - end.j));
}

// euclidean distance. i.e. draws a circle around end point
function euclidean(a) {
	heur = dist(a.i, a.j, end.i, end.j);
}
