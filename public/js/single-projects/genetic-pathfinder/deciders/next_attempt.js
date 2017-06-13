function determineNextAttempt() {
	switch(Pathfinder.dna.genes.nextAttemptChoice) {
		case 'back-of-list':
			backOfList();
			break;
		case 'front-of-list':
			frontOfList();
			break;
		case 'smallest-f-front':
			smallestFFront();
			break;
		case 'smallest-f-back':
			smallestFBack();
			break;
	}
}


function backOfList() {
	var winner = Pathfinder.openSet.length - 1;
	for (var i = Pathfinder.openSet.length - 1; i > 0; i--) {
		if(Pathfinder.openSet[i].f < Pathfinder.openSet[winner].f) {
			winner = i;
		}
	}
	current = Pathfinder.openSet[winner];
}

function frontOfList() {
	var winner = 0;
	for (var i = 0; i < Pathfinder.openSet.length - 1; i++) {
		if(Pathfinder.openSet[i].f < Pathfinder.openSet[winner].f) {
			winner = i;
		}
	}
	current = Pathfinder.openSet[winner];
}

function smallestFFront() {
	var clone = Pathfinder.openSet.slice(0);
	clone.sort(function(a,b){onF(a,b)});

	var winner = 0;
	for (var i = 0; i < clone.length - 1; i++) {
		if(clone[i].f < clone[winner].f) {
			winner = i;
		}
	}
	current = clone[winner];
}

function smallestFBack() {
	var clone = Pathfinder.openSet.slice(0);
	clone.sort(function(a,b){onF(a,b)});

	var winner = clone.length - 1;
	for (var i = clone.length - 1; i > 0; i--) {
		if(clone[i].f < clone[winner].f) {
			winner = i;
		}
	}
	current = clone[winner];
}







function onF(a, b) {
	return a.f - b.f;
}