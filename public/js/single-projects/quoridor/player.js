function Player (color, spot, num) {
	this.color = color;
	this.spot = spot;
	this.num = num;
	this.tiles = 10;

	this.initialize = function () {
		this.spot.colorize(this.color);	
		board.players.push(this);
	}

	// returns true if moving to a spot is a valid move
	this.canMoveTo = function (spot) {
		var dist = this.spot.getRelativeDistanceFrom(spot);

		// if movement is diagonal
		if(floor(dist) != dist) {
			// diagonal 1 square away
			if(dist == Math.sqrt(2)) {
				// if not touching a player, never ok
				if( ! this.isTouchingOtherPlayer()) return false;

				var dir = this.spot.getDirectionToOtherPlayer();
				var wall = this.spot.checkIfWallBehind(dir, board.inactivePlayer.spot);
				// if touching a player and player doesn't have wall "behind", never ok
				if( ! wall) return false;

				// must still be touching otherPlayer
				if( ! spot.isTouchingInactivePlayer()) return false;

				// if new spot has wall between it and otherPlayer, never ok
				if(spot.hasWallBetweenInactivePlayer()) return false;

				return true;				
			}
			
			return false;
		}

		// if movement is > 2 squares, never ok
		if(dist > 2) return false;

		// if movement is through wall, never ok. I know I call this multiple times, but it allowed the logic to be broken apart
		if(this.spot.hasWallBetween(spot, dist)) {
			return false;
		}

		// if movement is 2 squares away, only ok if other player between movement
		if(dist == 2) {
			// check if spot between this.spot and spot matches otherPlayer.spot
			var mid = this.spot.getBetweenSpot(spot);

			if(board.inactivePlayer.spot.isSameAsVector(mid)) {
				return true;
			}

			return false;
		}
		
		// if onto other player, never ok
		if(spot == board.inactivePlayer.spot) return false;

		// if moving onto yourself
		if(spot == board.activePlayer.spot) return false;

		// twas a regular ol' move
		return true;
	}

	// "move" the player to spot
	this.moveTo = function (newSpot) {
		// set old spot to white
		this.spot.reset();
		// make new spot player color
		newSpot.colorize(this.color);
		// make player spot the new spot
		this.spot = newSpot;
	}

	// checks if other player is 1 away
	this.isTouchingOtherPlayer = function () {
		// can assume this is the board.activePlayer
		return this.spot.isTouchingInactivePlayer();
	}

	// returns associated spots vector
	this.getVector = function () {
		return this.spot.getVector();
	}

	// decrements tiles by 1
	this.useTile = function () {
		this.tiles--;
	}

	this.hasTiles = function () {
		return this.tiles > 0;
	}
}






