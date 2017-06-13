function Wall (color, size, v1, v2) {
	this.color = color;
	this.size = size;
	// wall vertices
	this.v1 = v1; 
	this.v2 = v2;

	// draws a line between with player color
	this.show = function () {
		color = board.getAlphaLessColor(this.color);

		stroke(color);
		strokeWeight(size);

		line(this.v1.x, this.v1.y, this.v2.x, this.v2.y);
	}

	// if the midpoint of the current wall is the same as any other midpoints, not legal
	// if midpoint is on the vertex of another wall and they are a straight line, not legal
	this.isLegal = function () {
		var midpoint = this.getMidpoint();

		for(var i = 0; i < board.walls.length; i++) {
			var tempWall = board.walls[i];
			var tempMidpoint = tempWall.getMidpoint();
			var n1 = tempWall.v1.num;
			var n2 = tempWall.v2.num;

			// criss-cross
			if(midpoint == tempMidpoint) {
				return false;
			}

			// on top of each other in a line
			if((midpoint == n1 || midpoint == n2) && (tempMidpoint == this.v1.num || tempMidpoint == this.v2.num)) {
				return false;
			}
		}

		return true;
	}

	// returns the vertexNum between the 2 wall verticies
	this.getMidpoint = function () {
		return (this.v1.num + this.v2.num) / 2 ;
	}

	// checks to see if a "halfwall" potential movement overlaps with and walls on board
	this.overlaps = function (wall) {
		var mid = board.getVertexByNum(this.getMidpoint());
		var otherV1 = wall[0];
		var otherV2 = wall[1];

		// since V1 and V2 are previously sorted, if the midpoint matches one, I can tell what direction to check the other point
		
		// if mid matches V1, I want to check if V2 matches any of this wall's vertices
		if(mid.isSameAsVector(otherV1) && (this.v1.isSameAsVector(otherV2) || this.v2.isSameAsVector(otherV2))) {
			return true;
		}

		// if mid matches V2, I want to check if V1 matches any of this wall's vertices
		if(mid.isSameAsVector(otherV2) && (this.v1.isSameAsVector(otherV1) || this.v2.isSameAsVector(otherV1))) {
			return true;
		}

		return false;
	}

	this.removeSelf = function () {
		strokeWeight(size);
		
		stroke('white');
		line(this.v1.x, this.v1.y, this.v2.x, this.v2.y);
		stroke(backgroundColor);
		line(this.v1.x, this.v1.y, this.v2.x, this.v2.y);
	}
}




