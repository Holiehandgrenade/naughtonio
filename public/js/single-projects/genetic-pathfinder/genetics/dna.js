function DNA(newgenes) {

	// define genes as either passed in or random
	if (arguments.length > 0) {
		this.genes = newgenes;
	} else {
		this.genes = {
			neighborPreference: getRandomAddNeighbor(),
			heuristic: getRandomHeuristic(),
			heuristicWeight: getRandomHeuristicWeight(),
			nextAttemptChoice: getRandomNextAttempt(),
		};
	}

	this.crossover = function(partner) {
		var child = {
			neighborPreference: this.genes.neighborPreference,
			heuristic: this.genes.heuristic,
			heuristicWeight: partner.genes.heuristicWeight,
			nextAttemptChoice: partner.genes.nextAttemptChoice,
		};


		return new DNA(child);
	}

	//TODO mutation
	this.mutate = function (rate) {
		if (random(1) < rate) {
			console.log('mutation occured');
			var keyCount = Object.keys(this.genes).length
			var randKey = Object.keys(this.genes)[floor(random(0, keyCount))];
			console.log('before: ' + randKey + ' = ' + this.genes[randKey]);
			this.genes[randKey] = new DNA().genes[randKey];
			console.log('after: ' + randKey + ' = ' + this.genes[randKey]);
		}
	}
}



