function iterate() {
	determineNextAttempt(); // decision point

	findTheCurrentPath();
	drawTheCurrentPath();
	
	// done!
	if (current == end) {
		return true;
	}

	updateSets();

	// check neighbors g scores for best next guess
	var neighbors = current.neighbors;
	for (var i = 0; i < neighbors.length; i++) {
		var neighbor = neighbors[i];

		// if neighbor is not already closed and it's not a wall obstacle
		if(neighbor.isValid()) {
			var tempG = calculateGScore(); // decision point

			if (Pathfinder.openSet.includes(neighbor)) {
				// if current g score is better than neighbor's
				// previous, update neighbor
				if (tempG < neighbor.g) {
					neighbor.g = tempG;
				}
			} else {
				// if not in Pathfinder.openSet, set g scor and push neighbor
				neighbor.g = tempG;
				Pathfinder.openSet.push(neighbor);
			}

			// caluclate heuristic
			neighbor.h = heuristic(neighbor); // decision point
			// update neighbor value of, how long it 
			neighbor.f = neighbor.g + neighbor.h;
			// discribe how we got to the neighbor to trace back later
			neighbor.previous = current;
		}
	}
}