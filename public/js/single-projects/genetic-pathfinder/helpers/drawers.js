function drawSets() {
	// draw closed set
	for (var i = 0; i < Pathfinder.closedSet.length; i++) {
		Pathfinder.closedSet[i].show(color(255, 0, 0));
	}

	// draw open set
	for (var i = 0; i < Pathfinder.openSet.length; i++) {
		Pathfinder.openSet[i].show(color(0, 255, 0));
	}
}


function drawGrid() {
	// draw background grid
	for (var i = 0; i < side; i++) {
		for(var j = 0; j < side; j++) {
			grid[i][j].show(255);
		}
	}
}

function drawTheCurrentPath() {
	// draw current attempted path
	for (var i = 0; i < path.length; i++) {
		path[i].show(color(0, 0, 255));
	}
}


function printStats() {
	document.getElementById('generation-container').innerHTML = "Generation: " + population.generations + 
										" -- Best Fitness Ever: " + bestFitnessEver;
	document.getElementById('best-round-pathfinder').innerHTML = "Best this round: "+bestFitness+"<br/>" + 
								"| | | Heuristic Weight: " + bestPathfinder.dna.genes.heuristicWeight + "<br/>" +
								"| | | Heuristic: " + bestPathfinder.dna.genes.heuristic + "<br/>" +
								"| | | Neighbor Preference: " + bestPathfinder.dna.genes.neighborPreference + "<br/>" +
								"| | | Open Set Choice: " + bestPathfinder.dna.genes.nextAttemptChoice;


	document.getElementById('fitness-tracker').append(population.getTotalFitness()+', ');

}