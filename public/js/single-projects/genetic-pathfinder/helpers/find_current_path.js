function findTheCurrentPath () {
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