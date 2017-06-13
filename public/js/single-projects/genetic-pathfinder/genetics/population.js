function Population () {
	this.population = [];
	this.matingPool = [];
  	this.generations = 0; 
  	this.popcounter = 0;
  	this.mutationRate = mutationRate;

  	// create initial random population
	for(var i = 0; i < numPathfinders; i++) {
		this.population[i] = new PathfinderConstructor(new DNA());
		// push starting point onto pathfinder's openSet
		this.population[i].openSet.push(start);

		// add neighbors to each Spot according to the current Pathfinder
		for (var k = 0; k < side; k++) {
			for(var j = 0; j < side; j++) {
				grid[k][j].addNeighbors(this.population[i]);
			}
		}
	}


	 // Generate a mating pool
	this.selection = function() {
		// Clear the array
		this.matingPool = [];

		// Calculate total fitness of whole population
		var maxFitness = this.getMaxFitness();

		// Calculate fitness for each member of the population (scaled to value between 0 and 1)
		// Based on fitness, each member will get added to the mating pool a certain number of times
		// A higher fitness = more entries to mating pool = more likely to be picked as a parent
		// A lower fitness = fewer entries to mating pool = less likely to be picked as a parent
		for (var i = 0; i < this.population.length; i++) {
			var fitnessNormal = map(this.population[i].getFitness(),0,maxFitness,1,.1);
			var n = floor(fitnessNormal * 100);  // Arbitrary multiplier

			for (var j = 0; j < n; j++) {
				this.matingPool.push(this.population[i]);
			}
		}
	};


	// Making the next generation
	this.reproduction = function() {
		// Refill the population with children from the mating pool
		for (var i = 0; i < this.population.length; i++) {
			// Sping the wheel of fortune to pick two parents
			var m = floor(random(this.matingPool.length));
			var d = floor(random(this.matingPool.length));
			// Pick two parents
			var mom = this.matingPool[m];
			var dad = this.matingPool[d];
			// Get their genes
			var momgenes = mom.getDNA();
			var dadgenes = dad.getDNA();
			// Mate their genes
			var child = momgenes.crossover(dadgenes);
			// Mutate their genes
			child.mutate(this.mutationRate);
			// Fill the new population with the new child
			this.population[i] = new PathfinderConstructor(child);
			this.population[i].openSet.push(start);

			// add neighbors to each Spot according to the current Pathfinder
			for (var k = 0; k < side; k++) {
				for(var j = 0; j < side; j++) {
					grid[k][j].addNeighbors(this.population[i]);
				}
			}
		}
		this.generations++;
	};



	// Find highest fitness for the population
	this.getMaxFitness = function() {
		var record = 0;
		for (var i = 0; i < this.population.length; i++) {
			if(this.population[i].getFitness() > record) {
				record = this.population[i].getFitness();
			}
		}
		return record;
	};


	this.getTotalFitness = function () {
		var total = 0;
		this.population.forEach(function (p) {
			total += p.getFitness();
		});
		return total;
	}
}