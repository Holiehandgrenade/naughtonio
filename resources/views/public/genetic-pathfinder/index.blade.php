<html>
<head>
  <meta charset="UTF-8">
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/libraries/p5.min.js"></script>
  <!-- uncomment lines below to include extra p5 libraries -->
  <!--<script language="javascript" src="/js/single-projects/genetic-pathfinder/libraries/p5.dom.js"></script>-->
  <!--<script language="javascript" src="/js/single-projects/genetic-pathfinder/libraries/p5.sound.js"></script>-->
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/sketch.js"></script>
  
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/master_controls.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/known_solveable_grids.js"></script>

  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/helpers/init.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/helpers/drawers.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/helpers/iterate.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/helpers/find_current_path.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/helpers/remove_from_array.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/helpers/update_sets.js"></script>

  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/deciders/next_attempt.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/deciders/heuristic.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/deciders/calculate_g_score.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/deciders/add_neighbors.js"></script>

  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/genetics/dna.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/genetics/population.js"></script>

  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/objects/spot.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/objects/pathfinder.js"></script>

  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/choices/heuristics.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/choices/neighbor_preferences.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/choices/next_attempts.js"></script>
  <script language="javascript" type="text/javascript" src="/js/single-projects/genetic-pathfinder/choices/heuristic_weight.js"></script>

  <!-- this line removes any default padding and style. you might only need one of these values set. -->
  <style> body {padding: 0; margin: 0;} </style>
</head>

<body>

	<div id="side-container">
    <div id="generation-container"></div>
    <div id="best-ever-pathfinder"></div>
    <div id="best-round-pathfinder"></div> 
    <div id="fitness-tracker">Totals: </div>
  </div>

</body>
</html>