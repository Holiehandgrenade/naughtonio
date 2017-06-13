function Board (size) {
	this.board = [];
	this.walls = [];
	this.players = [];
	this.actions = [];
	this.wallVertices = [];
	this.highlightedVertex = null;
	this.activePlayer;
	this.inactivePlayer;
	this.title;

	var offsetX = width / 3.5;
	var offsetY = boardSize / 9;
	var spotSize = size / 10 - gap;


	// builds a 9 x 9 grid of Spots
	this.initialize = function () {

		// create spots
		for(var i = 0; i < 9; i++) {
			this.board[i] = [];
			for(var j = 0; j < 9; j++) {
				var pos = createVector(j * size / 10 + offsetX, i * size / 10 + offsetY);
				this.board[i][j] = new Spot(pos, spotSize, i, j);
			}
		}

		// create wall verticies
		for(var i = 0; i < 10; i++) {
			this.wallVertices[i] = [];
			for(var j = 0; j < 10; j++) {
				var pos = createVector(
					j * (spotSize + gap) + offsetX - spotSize / 2 - gap / 2.1, 
					i * (spotSize + gap) + offsetY - spotSize / 2 - gap / 2.1
				);
				this.wallVertices[i][j] = new WallVertex(pos, gap, i, j);
			}
		}

		// draw undo button
		fill(51);
		rect(10, height - 100, 100, 50);
		fill(255);
		textSize(20);
		text('Undo', 35, height - 68);
	}

	// takes a callback and runs for each spot
	this.eachSpot = function (callback) {
		for(var i = 0; i < 9; i++) {
			for(var j = 0; j < 9; j++) {
				var spot = this.board[i][j];
				callback(spot);
			}
		}
	}

	// takes a callback and runs for each wallVertex
	this.eachVertex = function (callback) {
		for(var i = 0; i < 10; i++) {
			for(var j = 0; j < 10; j++) {
				var vertex = this.wallVertices[i][j];
				callback(vertex);
			}
		}
	}

	// draws each Spot and Vertex
	this.show = function () {
		this.eachSpot(function (spot) {
			spot.show();
		});

		this.eachVertex(function (vertex) {
			vertex.show();
		});
	}

	// returns matching spot based on number or false
	this.getSpotByNum = function (num) {
		var matched = false;

		this.eachSpot(function (spot) {
			if(spot.num == num) {
				matched = spot;
			}
		});

		return matched;
	}

	// returns matching vertex or false
	this.getVertexByNum = function (num) {
		var matched = false;

		this.eachVertex(function (vertex) {
			if(vertex.num == num) {
				matched = vertex;
			}
		});
		return matched
	}

	// removes the highlighted completely
	this.resetHighlightedVertex = function () {
		if(this.highlightedVertex) this.highlightedVertex.hide();
		this.highlightedVertex = null;
	}

	// pushes a wall object onto array of walls
	this.addWall = function (wall) {
		this.walls.push(wall);
	}

	// sets the active player
	this.setActivePlayer = function (player) {
		this.activePlayer = player;
	}

	// sets the inactive player
	this.setInactivePlayer = function (player) {
		this.inactivePlayer = player;
	}

	// swtiches who is active
	this.swapActivePlayer = function () {
		var temp = this.activePlayer;
		this.activePlayer = this.inactivePlayer;
		this.inactivePlayer = temp;
	}

	// starts next player's turn
	this.newTurn = function () {
		this.resetHighlightedVertex();
		this.swapActivePlayer();
		this.updateTexts();
	}

	// pushes an action onto the list for undo
	this.addAction = function (options) {
		this.actions.push(options);
	}

	// undo the last action on the array
	this.undoAction = function () {
		if(this.actions.length > 0) {
			var action = this.actions.splice(this.actions.length - 1);
			if(action[0].type == 'wall') {
				this.undoWall(action[0]);
			}
			if(action[0].type == 'move') {
				this.undoMove(action[0]);
			}	
		}
	}

	// updates information stuff
	this.updateTexts = function () {
		// player turn
		fill(this.getAlphaLessColor(this.activePlayer.color));
		rect(width - width / 9, height / 7, 100, 100);

		for(var i = 0; i < this.players.length; i++) {
			document.getElementById('walls' + [ i + 1]).innerHTML = 'Player ' +this.players[i].num +': ' + this.players[i].tiles + ' Walls';
		}
	}

	// removes alpha channel. sends rgb string back
	this.getAlphaLessColor = function (color) {
		color = color.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
		return (color && color.length === 4) ? "#" +
		  ("0" + parseInt(color[1],10).toString(16)).slice(-2) +
		  ("0" + parseInt(color[2],10).toString(16)).slice(-2) +
		  ("0" + parseInt(color[3],10).toString(16)).slice(-2) : '';
	}

	// checks to see if undo button was hit
	this.checkUndoCollision = function () {
		var lowerX = 10;
		var upperX = 110;
		var lowerY = height - 100;
		var upperY = height - 50;

		if(mouseX > lowerX && mouseX < upperX && mouseY > lowerY && mouseY < upperY){
			this.undoAction();
		}
	}

	// undoes a wall action
	this.undoWall = function (options) {
		// remove wall from array and board
		this.walls.splice(this.walls.length - 1);
		options.wall.removeSelf();

		// give wall tile back
		options.player.tiles++;

		// set active player to other guy
		this.swapActivePlayer();

		this.updateTexts();
	}

	// undoes a movement
	this.undoMove = function (options) {
		// move back to previous spot
		options.player.moveTo(options.oldSpot);

		// set active player to other guy
		this.swapActivePlayer();

		this.updateTexts();
	}
 }



