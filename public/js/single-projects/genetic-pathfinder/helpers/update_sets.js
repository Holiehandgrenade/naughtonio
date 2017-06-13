function updateSets() {
	Pathfinder.closedSet.push(current);
	removeFromArray(Pathfinder.openSet, current);
}