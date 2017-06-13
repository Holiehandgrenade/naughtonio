function preload() {
	init();
}

function setup() {
	initializeScreen();
	initializeGrid();

	population = new Population();
	// population.live();

	counter = 0;
	window.Pathfinder = population.population[counter];
	begin = 0;
	bestFitness = 9999;
	bestPathfinder = Pathfinder;
}


function draw() {
	if(Pathfinder.done) {
		// caught early
		if(frameCount - begin < side * 2) {
			return;
		}

		// calculate fitness of Pathfinder
		fit = Pathfinder.setFitness(frameCount, begin);
		if (fit < bestFitness) {
			bestFitness = fit;
			bestPathfinder = Pathfinder;
			if(bestFitness < bestFitnessEver) {
				bestFitnessEver = bestFitness;
			}
		}
		begin = frameCount;

		// move to next Pathfinder
		counter++;
		window.Pathfinder = population.population[counter];
		
		// refresh grid
		background(255);
		drawGrid();

		// if we're out, this generation is done
		if(counter >= numPathfinders) {
			printStats();
			bestFitness = 9999;

			// initializeGrid();

			population.selection();
    		population.reproduction();

    		counter = 0;
			window.Pathfinder = population.population[counter];
			begin = frameCount;
		}
	}

	// if Pathfinder is not done, try another iteration
	if ( ! Pathfinder.done) {
		drawSets(Pathfinder);

		if (Pathfinder.openSet.length > 0) {
			Pathfinder.done = iterate();

		} else {
			// no solution
			Pathfinder.done = true;
		}
	}
}