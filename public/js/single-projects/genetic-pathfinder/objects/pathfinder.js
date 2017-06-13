function PathfinderConstructor (dna_) {
	this.dna = dna_;
	this.fitness = 0;


	this.openSet = [];
	this.closedSet = [];
	this.path;
	this.current;
	this.done = false;


	this.setFitness = function () {
		return this.fitness = frameCount - begin;
	}


	this.getFitness = function () {
		return this.fitness;
	}

	this.getDNA = function () {
		return this.dna;
	}
}