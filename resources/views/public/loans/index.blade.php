<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="ngStorage.min.js"></script>
	<script src="calcs.js"></script>

	<link rel="stylesheet" href="style.css"/>
</head>
<body ng-app = "calc-app">
<div id = "interest_div" ng-controller = "calcController as calc">
	<p>Total Loans Added: {{total_loans}}
	<input ng-model = "loan.principle"/  placeholder = "Principal">
	<input ng-model = "loan.rate"/ placeholder = "Rate (yearly as a percent)">
	<input ng-model = "loan.minimum"/ placeholder = "Minimum (monthly payment)">
	<button ng-click = "calc.addLoan(loan)">Add Loan</button>
	<div id="extra_payment">
		<p> Add all loans before pressing Calculate</p>
		<input ng-model = "payment"/ placeholder = "Payment over minimum"> 
		<button ng-click = "calc.calculate()">Calculate</button>
	</div>
	<button ng-click = "calc.clearLocal()">Clear Loans</button>
</div>


<div id = "answers">
	<p id = "months"></p>
	<p id = "interest"></p>
	<p id = "variance"></p>
	<p id = "rounding"></p>
	<p id = "paid_in"></p>
</div>


</body>
</html>