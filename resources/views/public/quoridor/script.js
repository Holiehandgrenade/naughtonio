var width, height, board;
var boardSize; // side length
var gap; // space in between tiles (for walls)
var backgroundColor = 'rgba(120, 100, 20, 0.25)';

function setup () {
	// basic canvas settings
	width = windowWidth, height = windowHeight;
	boardSize = height - 20;
	gap = boardSize / 80;
	createCanvas(width, height);
	background(backgroundColor);

	// create and draw board. set player to 1
	board = new Board(boardSize);
	board.initialize();
	board.show();

	var p1 = new Player('rgba(29, 76, 138, 0.25)', board.getSpotByNum(5), 1); p1.initialize();
	var p2 = new Player('rgba(138, 29 , 76, 0.25)', board.getSpotByNum(77), 2); p2.initialize();

	board.setActivePlayer(p1);
	board.setInactivePlayer(p2);
	board.updateTexts();
}


function draw () {

}



function mouseClicked () {

	board.eachSpot(function (spot) {
		var newSpot = spot.checkCollision();
		
		// collision detected
		if(newSpot){
			if(board.activePlayer.canMoveTo(newSpot)) {
				
				// log this action
				board.addAction({
					type: 'move',
					oldSpot: board.activePlayer.spot,
					newSpot: newSpot,
					player: board.activePlayer
				});

				// if there's a new spot that the board.activePlayer can move to, move to it
				board.activePlayer.moveTo(newSpot);

				board.newTurn();
			}
		}
	});

	if(board.activePlayer.hasTiles()) {
		board.eachVertex(function (vertex) {
			var newVertex = vertex.checkCollision();

			// collision detected
			if(newVertex){

				// there is no highlighted vertex, make this one highlighted
				if( ! board.highlightedVertex) {
					newVertex.highlight();
					board.highlightedVertex = newVertex;
					return;
				}

				// reclicking vertex removes it
				if(newVertex.sameAsHighlighted()) {
					board.resetHighlightedVertex();
					return;
				}

				// if this vertex is legal to draw
				if(newVertex.isLegal()) {
					// make a wall
					var wall = new Wall(board.activePlayer.color, gap, board.highlightedVertex, newVertex);
					
					// checks to see if the wall is valid
					if(wall.isLegal()) {
						// draw wall
						wall.show();

						// add to global array of walls
						board.addWall(wall);

						// use a wall tile
						board.activePlayer.useTile();
						
						// log this action
						board.addAction({
							type: 'wall',
							wall: wall,
							player: board.activePlayer
						});

						// start new turn
						board.newTurn();
					}
				}
			}
		});
	}


	board.checkUndoCollision();
}


