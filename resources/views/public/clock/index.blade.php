<!DOCTYPE html>
<meta charset="utf-8">
<style>

svg{
	border : 5 px solid black;
}


</style>
<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script>
var w=960,
	h=500;
	
var date = new Date(); 
var hours = date.getHours();
var minutes = date.getMinutes();
var seconds = date.getSeconds();

d3.select('body').append('svg')
var svg = d3.select('svg')
			.attr('width',w)
			.attr('height',h);
		 
var group = svg.append('g')
			.attr('width',w)
			.attr('height',h)
			.attr("transform", "translate(" + w / 2 + "," + h / 2 + ")")
			
var arc1 = d3.svg.arc()
						.innerRadius(40)
						.outerRadius(60)
						.startAngle(0);
						
var arc1_0 = group.append("path")
    .datum({endAngle: (Math.PI/30)*seconds})
    .style("fill", "#B2BF80")
    .attr("d", arc1);
						
var arc2 = d3.svg.arc()
						.innerRadius(60)
						.outerRadius(80)
						.startAngle(0);
						
var arc2_0 = group.append("path")
    .datum({endAngle: (Math.PI/30)*minutes})
    .style("fill", "#1F0E59")
    .attr("d", arc2);
	
var arc3 = d3.svg.arc()
						.innerRadius(80)
						.outerRadius(100)
						.startAngle(0);
						
var arc3_0 = group.append("path")
    .datum({endAngle: (Math.PI/12)*hours})
    .style("fill", "#A63F52")
    .attr("d", arc3);


					
setInterval(function() {
  arc1_0.transition()
      .duration(750)
      .call(arcSeconds, 0); // the second parameter doesn't matter since I'm not using a newAngle which I define. (it's based on the current time)

  arc2_0.transition()
      .duration(750)
      .call(arcMinutes, 0);
	  
  arc3_0.transition()
      .duration(750)
      .call(arcHours, 0);
	  
   displayTime();
}, 1000);


function arcSeconds(transition, newAngle) {
var date = new Date(); 
var seconds = date.getSeconds();
  transition.attrTween("d", function(d) {
    var interpolate = d3.interpolate(d.endAngle, (Math.PI/30)*seconds);
    return function(t) {
      d.endAngle = interpolate(t);
      return arc1(d);
    };
  });
}



function arcMinutes(transition, newAngle) {
var date = new Date(); 
var minutes = date.getMinutes();
  transition.attrTween("d", function(d) {
    var interpolate = d3.interpolate(d.endAngle, (Math.PI/30)*minutes);
    return function(t) {
      d.endAngle = interpolate(t);
      return arc2(d);
    };
  });
}


function arcHours(transition, newAngle) {
var date = new Date(); 
var hours = date.getHours();
  transition.attrTween("d", function(d) {
    var interpolate = d3.interpolate(d.endAngle, (Math.PI/12)*hours);
    return function(t) {
      d.endAngle = interpolate(t);
      return arc3(d);
    };
  });
}


function displayTime(){
var date = new Date(); 
var hours = date.getHours();
var minutes = date.getMinutes();
var seconds = date.getSeconds();

seconds = ("0" + seconds).slice(-2);
minutes = ("0" + minutes).slice(-2);
hours = ("0" + hours).slice(-2);


	d3.select('#text').remove();
	group.append('text')
		.text(hours+":"+minutes+":"+seconds)
		.attr('x',-29)
		.attr('id','text');
}

</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83639369-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>