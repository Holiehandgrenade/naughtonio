function Spot(i, j) {
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
	if (random(1 ) < wallLikelihood) {
		this.wall = true;
	}


	this.show = function (color) {
		fill(color);
		if (this.wall) {
			fill(0);
		}
		noStroke();
		rect(this.i * w, this.j * h, w - 1, h - 1);
	}

	this.addNeighbors = function () {
		var i = this.i;
		var j = this.j;

		if (i < cols - 1) {
			this.neighbors.push(grid[i + 1][j]);	
		}
		if (i > 0) {
			this.neighbors.push(grid[i - 1][j]);
		}
		if (j < rows - 1) {
			this.neighbors.push(grid[i][j + 1]);	
		}
		if (j > 0) {
			this.neighbors.push(grid[i][j - 1]);	
		}
	}
}