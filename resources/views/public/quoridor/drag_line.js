function DragLine (x1, y1, x2, y2) {
	this.removeAll = function () {

	}


	// i was trying to, on clicking 1st vertex, have a line between there and mouse
	// maybe come back later
	this.show = function () {
		stroke(255);

		beginShape(LINES);

		vertex(x1, y1);
		vertex(x2, y2);

		endShape();
	}
}