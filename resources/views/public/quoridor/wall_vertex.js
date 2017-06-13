function WallVertex (pos, gap, i, j) {
	this.i = i;
	this.j = j;
	this.x = pos.x;
	this.y = pos.y;
	this.size = gap * 1.2;
	this.num = (i * 10) + (j + 1);

	// draws the vertex
	this.show = function (color) {
		color = color || 'rgb(230, 200, 180)'
		noStroke();
		fill(color);
		ellipse(this.x, this.y, this.size, this.size);
	}

	// show defaults to background color. Just using this as a logical helper
	this.hide = function () {
		this.show();
	}

	// returns vertex if collision is found. otherwise false;
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

	// set the global highlightedVertex to this and draw
	this.highlight = function () {
		this.show(board.activePlayer.color);
		board.highlightedVertex = this;
	}

	// checks if this is the global highlighted
	this.sameAsHighlighted = function () {
		return this == board.highlightedVertex;
	}

	// checks many conditions to see if this is a valid wall
	this.isLegal = function () {
		var diff = Math.abs(this.num - board.highlightedVertex.num);

		if(diff != 2 && diff != 20) {
			return false;
		}

		if(this.isWrapAround(diff)) {
			return false;
		}

		return true;
	}

	// checks if the verticies are on other side of the board
	this.isWrapAround = function (diff) {
		var avg = (this.num + board.highlightedVertex.num) / 2;
		return (avg % 10 == 0 || avg % 10 == 1) && diff != 20;
	}

	this.getVectorFormat = function () {
		return createVector(this.j, this.i);
	}

	// checks if this vertex is the same as some supplied p5 Vector
	this.isSameAsVector = function (vector) {
		return p5.Vector.dist(this.getVectorFormat(), vector) == 0;
	}
}









