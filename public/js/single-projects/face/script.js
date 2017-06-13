$(document).ready(function(){

	var faces = ["evan2.png", "evan.jpg","face5.jpg", "face.png"];
	//Flipping off:  , "face4.png"
	var counter = 1;
	var ticker = 0;
	setInterval(function(){
		var width = $("body").css('background-size');
		var result = parseFloat(width);
		$("body").css("background-size",(result*.95)+"%");
		ticker++;

		if(ticker == 60){
			ticker = 0;
			$("body").css("background-image", "url('/img/single-projects/face/"+faces[counter]+"')");
			$("body").css("background-size","100%");
			counter++;
			if(counter == faces.length){
				counter=0;
			}
			
		}


	},70);


});