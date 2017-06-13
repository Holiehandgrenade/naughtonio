// Neighbors that get pushed onto the list first 
// have higher priority if openSet is checked forwards

var tempSpot;

function addNeighbors(spot, pathfinder) {
	tempSpot = spot;
	
	switch (pathfinder.dna.genes.neighborPreference) {
		case 'prefer-vertical':
			preferVertical();
			break;
		case 'prefer-horizontal':
			preferHorizontal();
			break;
		case 'prefer-bottom-right':
			preferBottomRight();
			break;
		case 'prefer-right-bottom':
			preferRightBottom();
			break;
		case 'prefer-calculated-diagonal':
			preferCalculatedDiagonal();
			break;
	}
}


function preferVertical() {
	pushDown();
	pushUp();
	pushRight();
	pushLeft();
}

function preferHorizontal() {
	pushRight();
	pushLeft();
	pushDown();
	pushUp();
}

function preferRightBottom() {
	pushRight();
	pushDown();
	pushLeft();
	pushUp();
}

function preferBottomRight() {
	pushDown();
	pushRight();
	pushUp();
	pushLeft();
}

function preferCalculatedDiagonal() {
	if (tempSpot.i > tempSpot.j) {
		preferVertical();
	} else {
		preferHorizontal();
	}
}



function pushRight() {
	if (tempSpot.i < side - 1) {
		tempSpot.neighbors.push(grid[tempSpot.i + 1][tempSpot.j]);	
	}
}

function pushLeft() {
	if (tempSpot.i > 0) {
		tempSpot.neighbors.push(grid[tempSpot.i - 1][tempSpot.j]);
	}
}

function pushDown() {
	if (tempSpot.j < side - 1) {
		tempSpot.neighbors.push(grid[tempSpot.i][tempSpot.j + 1]);	
	}
}

function pushUp() {
	if (tempSpot.j > 0) {
		tempSpot.neighbors.push(grid[tempSpot.i][tempSpot.j - 1]);	
	}
}