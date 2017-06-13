// used to declare some variables to the global scope

function init() {
	window.bestFitnessEver = 9999;
	window.grid = [];
	window.start, window.end; // start and end Spots
	window.s; // relative spacing of Spots in grid
}


function initializeScreen() {
	createCanvas(windowHeight, windowHeight);
	var el = document.getElementById('side-container');

	el.style = 'position:fixed; border: 1px solid; right: 0;' +
				'height:'+windowHeight+'px; width:'+(windowWidth - windowHeight)+'px;' +
				'';
}

function initializeGrid() {
	goodGrid = getRandomGrid();
	grid = [];
	// relative spacing of grid
	s = windowHeight / side;

	// make grid of Spots
	for (var i = 0; i < side; i++) {
		grid[i] = [];
	}
	for (var i = 0; i < side; i++) {
		for(var j = 0; j < side; j++) {
			grid[i][j] = new Spot(i, j, goodGrid[i][j]);
		}
	}

	// set start point and end point
	start = grid[0][0];
	end = grid[side-1][side-1];
	// make sure start and end are never obstacles
	start.wall = false;
	end.wall = false;

	drawGrid();
}