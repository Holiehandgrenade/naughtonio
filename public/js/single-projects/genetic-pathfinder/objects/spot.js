function Spot(i, j, isWall) {
	// location
	this.i = i;
	this.j = j;
	// algorithm variables
	this.f = 0; // total score of how good this spot may be
	this.g = 0; // how long it took me to get here
	this.h = 0; // guess how long it will take me til end
	// neighboring nodes
	this.neighbors = [];
	// the previous Spot to trace back path
	this.previous = null;
	// is this a wall?
	this.wall = false;
	if (isWall) {
		this.wall = true;
	}


	this.show = function (color) {
		fill(color);
		if (this.wall) {
			fill(0);
		}
		noStroke();
		rect(this.i * s, this.j * s, s - 1, s - 1);
	}

	this.addNeighbors = function (pathfinder) {
		addNeighbors(this, pathfinder);
	}

	this.isValid = function () {
		 return ! Pathfinder.closedSet.includes(this) && ! this.wall
	}
}