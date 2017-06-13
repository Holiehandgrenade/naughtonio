var cols, rows;
var grid = [];
var openSet = [], closedSet = []; // unchecked and checked Spots
var start, end; // start and end Spots
var w, h; // relative spacing of Spots in grid
var path; // optimal path through
var done = false; // algorithm is done
var current; // current Spot i am on
var wallLikelihood; // the chance that any given Spot is an obstacle
var started = false; // wait for user input
var heuristicWeight;

function setup() {
	createCanvas(windowHeight, windowHeight);

	colInput = createInput(40); colInput.position(width + 10, 65);
	p = createP('Grid Size'); p.position(width + 150, 50);

	wallInput = createInput(.3); wallInput.position(width + 10, 85);
	p = createP('Obstacle Likelihood'); p.position(width + 150, 70);

	heuristicInput = createInput(1.5); heuristicInput.position(width + 10, 105);
	p = createP('Heuristic Weight'); p.position(width + 150, 90);

	button = createButton('Begin');
	button.position(width + 10, 125);
	button.mousePressed(start);
}

function start() {
	if (started) {
		wipe();
	}

	cols = colInput.value();
	rows = colInput.value();

	wallLikelihood = wallInput.value();

	heuristicWeight = heuristicInput.value();

	if (cols <= 0) {
		return;
	}

	if(cols >= 75) {
		var c = confirm('Too large a grid may make your CPU very unhappy');
		if( ! c) {
			return;
		}
	}

	// relative spacing of grid
	w = width / cols;
	h = height / rows;

	// make grid of Spots
	for (var i = 0; i < cols; i++) {
		grid[i] = [];
	}
	for (var i = 0; i < cols; i++) {
		for(var j = 0; j < rows; j++) {
			grid[i][j] = new Spot(i, j);
		}
	}
	// add neighbors to each Spot
	for (var i = 0; i < cols; i++) {
		for(var j = 0; j < rows; j++) {
			grid[i][j].addNeighbors();
		}
	}

	// set start point and end point
	start = grid[0][0];
	end = grid[cols-1][rows-1];
	// make sure start and end are never obstacles
	start.wall = false;
	end.wall = false;

	// start evaluating at start
	openSet.push(start);

	started = true;
}

function draw() {
	if( ! started) {
		return;
	}

	drawArrays();

	if (done) {
		path = findThePath();
		drawThePath();
		noLoop();
		return;
	}

	if (openSet.length > 0) {
		done = tryAgain();
	} else {
		// no solution
		done = true;
	}
}



function tryAgain() {
	// determine best node to try. loop backwards as if to say "keep on the path you're on"
	// in the case of a tie
	var winner = openSet.length - 1;
	for (var i = openSet.length - 1; i > 0; i--) {
		if(openSet[i].f < openSet[winner].f) {
			winner = i;
		}
	}

	current = openSet[winner];

	path = findThePath();
	drawThePath();
	
	// done!
	if (current == end) {
		return true;
	}

	// update sets
	closedSet.push(current);
	removeFromArray(openSet, current);

	// check neighbors g scores for best next guess
	var neighbors = current.neighbors;
	for (var i = 0; i < neighbors.length; i++) {
		var neighbor = neighbors[i];

		// if neighbor is not already closed and it's not a wall obstacle
		if( ! closedSet.includes(neighbor) && ! neighbor.wall) {
			var tempG = current.g + 1;

			if (openSet.includes(neighbor)) {
				// if potential g is better, update neighbor g score
				if (tempG < neighbor.g) {
					neighbor.g = tempG;
				}
			} else {
				// if not in openSet, set g scor and push neighbor
				neighbor.g = tempG;
				openSet.push(neighbor);
			}

			// caluclate heuristic
			neighbor.h = heuristic(neighbor, end);
			// update neighbor value of, how long it 
			neighbor.f = neighbor.g + neighbor.h;
			// discribe how we got to the neighbor to trace back later
			neighbor.previous = current;
		}
	}
}

function findThePath () {
	path = [];
	// start at current node (should be the end)
	var temp = current;
	path.push(temp);
	// while there's a Spot back in line
	while (temp.previous) {
		// push previous Spot on and step backwards
		path.push(temp.previous);
		temp = temp.previous;
	}

	return path;
}

function drawThePath() {
	for (var i = 0; i < path.length; i++) {
		path[i].show(color(0, 0, 255));
	}
}






function removeFromArray(arr, el) {
	for (var i = arr.length - 1; i >= 0; i--) {
		if (arr[i] == el) {
			arr.splice(i, 1);
		}
	}
}



function drawArrays () {
	// draw background grid
	for (var i = 0; i < cols; i++) {
		for(var j = 0; j < rows; j++) {
			grid[i][j].show(255);
		}
	}

	// draw closed set
	for (var i = 0; i < closedSet.length; i++) {
		closedSet[i].show(color(255, 0, 0));
	}

	// draw open set
	for (var i = 0; i < openSet.length; i++) {
		openSet[i].show(color(0, 255, 0));
	}
}


function wipe () {
	background(255);
	grid = [];
	openSet = [], closedSet = []; // unchecked and checked Spots
	path = []; // optimal path through
	done = false; // algorithm is done
	started = false; // wait for user input

	loop();
}



function heuristic(a, b) {
	return (abs(a.i - b.i) + abs(a.j - b.j)) * heuristicWeight;
}

