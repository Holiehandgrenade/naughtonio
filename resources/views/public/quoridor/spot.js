function Spot (pos, size, i, j) {
	this.i = i;
	this.j = j;
	this.x = pos.x;
	this.y = pos.y;
	this.size = size;
	this.num = (i * 9) + (j + 1);

	// draws a rectangle
	this.show = function (color) {
		if(color){
			fill(color);
		}else{
			fill('white');
		}

		noStroke();
		rectMode(CENTER);
		rect(this.x, this.y, this.size, this.size);
	}

	// returns spot if collision is found. otherwise false;
	this.checkCollision = function () {
		var lowerX = this.x - (this.size / 2);
		var upperX = this.x + (this.size / 2);
		var lowerY = this.y - (this.size / 2);
		var upperY = this.y + (this.size / 2);

		if(mouseX > lowerX && mouseX < upperX && mouseY > lowerY && mouseY < upperY){
			return this;
		}

		return false;
	}

	// runs show with passed color
	this.colorize = function (color) {
		this.show(color);
	}

	// resets to white
	this.reset = function () {
		this.show();
	}

	// returns a p5 vector object of this coordinates
	this.getVector = function () {
		return createVector(this.j, this.i);
	}

	// gets vector distance between this and another spot
	this.getRelativeDistanceFrom = function (spot) {
		return p5.Vector.dist(this.getVector(), spot.getVector());
	}

	// checks if there are any walls between 2 spots
	this.hasWallBetween = function (spot, dist) {
		// for each wall potentially between movement
		var walls = this.getWallsBetweenStraight(spot, dist);

		for(var i = 0; i < walls.length; i++) {
			// remember, a wall is a vertex pair
			var currentWall = walls[i];
			// for each wall actually on the board
			for(j = 0; j < board.walls.length; j++) {
				var currentBoardWall = board.walls[j];
				// if any board wall's coordinates match perfectly, wall is between
				if(currentBoardWall.overlaps(currentWall)) {
					return true;
				}
			}
		}

		// made it through all potential walls with no interruption
		return false;
	}

	// returns array of vertex pairs between two spots
	this.getWallsBetweenStraight = function (spot, dist) {
		// essentially, this does the same thing one way or the other depending on the direction
		var dir = this.getDirection(spot);
		var vertexPairs = [];

		// if right left
		if(dir) {
			var min = Math.min(this.j, spot.j);
			for(var i = 0; i < dist; i++) {
				// push all verticies between the min X coordinate and X + dist
				// pair with this Y coordinate and Y + 1 (since player is 1 thick)
				vertexPairs.push([
					createVector(min + i + 1, this.i),
					createVector(min + i + 1, this.i + 1)
				]);
			}
			return vertexPairs;
		}

		// if up down
		var min = Math.min(this.i, spot.i);
		for(var i = 0; i < dist; i++) {
			vertexPairs.push([
				// push all verticies between the min Y coordinate and Y + dist
				// pair with this X coordinate and X + 1 (since player is 1 thick)
				createVector(this.j, min + i + 1),
				createVector(this.j + 1, min + i + 1)
			]);
		}
		return vertexPairs;
	}

	// returns bool depending on direction
	this.getDirection = function (spot) {
		// right left
		if(this.i == spot.i){
			return true;
		}
		// up down
		if(this.j == spot.j) {
			return false;
		}
	}

	// returns vector between 2 spots
	// can assume that movement is linear and 2
	this.getBetweenSpot = function (spot) {
		var x = (this.j + spot.j) / 2;
		var y = (this.i + spot.i) / 2;
		return createVector(x, y);
	}

	// checks if this vertex is the same as some supplied p5 Vector
	this.isSameAsVector = function (vector) {
		return p5.Vector.dist(this.getVector(), vector) == 0;
	}

	// true if this spot is 1 away from inactive player's spot
	this.isTouchingInactivePlayer = function () {
		return this.getRelativeDistanceFrom(board.inactivePlayer.spot) == 1;
	}

	// checks if there is a wall between here and inactive player. can assume one spot away
	this.hasWallBetweenInactivePlayer = function () {
		var dir = this.getDirectionToOtherPlayer();
		return this.checkIfWallBehind(dir, this);
	}

	// returns 0-4 for up,right,down,left
	this.getDirectionToOtherPlayer = function () {
		// up
		if(this.num - board.inactivePlayer.spot.num == 9) return 0;
		// right
		if(this.num - board.inactivePlayer.spot.num == -1) return 1;
		// down
		if(this.num - board.inactivePlayer.spot.num == -9) return 2;
		// left
		if(this.num - board.inactivePlayer.spot.num == 1) return 3;
	}

	// returns pair of vertices or false
	this.checkIfWallBehind = function (dir, spot) {
		var v = spot.getVector();
		var wall;

		switch (dir) {
			case 0: // up
				wall = [
					createVector(v.x, v.y),
					createVector(v.x + 1, v.y)
				];
				break;
			case 1: // right
				wall = [
					createVector(v.x + 1, v.y),
					createVector(v.x + 1, v.y + 1)
				];
				break;
			case 2: // down
				wall = [
					createVector(v.x, v.y + 1),
					createVector(v.x + 1, v.y + 1)
				];
				break;
			case 3: // left
				wall = [
					createVector(v.x, v.y),
					createVector(v.x, v.y + 1)
				];
				break;
		}
		
		for(var i = 0; i < board.walls.length; i++) {
			if(board.walls[i].overlaps(wall)){
				return wall;
			}
		}

		return false;
	}
}















