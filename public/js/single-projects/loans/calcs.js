angular.module('calc-app', ['ngStorage'])
	.controller("calcController", ["$scope", '$localStorage', function($scope, $localStorage){

		$scope.payment;
		$scope.loan = {};
		$scope.total_loans = 0;
		var loans = [];
		var loans_clone;
		this.clearLocal = function(){
			$scope.total_loans = 0;
			loans.splice(0);
			$localStorage.$reset();
			window.localStorage.clear();
			console.log($localStorage);
			console.log(loans);
		};
		this.addLoan = function(loan){
			loan['monthlyRate'] = loan['rate'] / 1200;
			loan['initial_interest'] = loan['principle'] * loan['monthlyRate'];
			loan['extra'] = 0;
			loan['current_interest'] = 0;
			loan['total_interest'] = 0;

			if(loan.minimum == undefined){
				loan.minimum = 0;
			}

			loans.push(loan);
			$scope.loan = {};
			$scope.total_loans++;
		};
		this.calculate = function(){
			if($localStorage.loans_clone == undefined){
				$localStorage.loans_clone = $.extend(true, [], loans);
				console.log("copying loans");
			}else{
				loans = $.extend(true, [], $localStorage.loans_clone);
				console.log("didn't copy loans");
			}
			console.log($localStorage.loans_clone);
			// puts them in order of high-low initial interest
			runCalc();
		};

		function runCalc(){
			var extra = $scope.payment;
			loans.sort(compare);
			console.log(loans);

			// puts all of extra on first loan
			if(extra != undefined){
				loans[0]['extra'] = extra;
			}else{
				loans[0]['extra'] = 0;
			}
			var loan_counter = 0, month_counter = 0, total_months = 0;
			var notDone = true;
			var paid_in = "";
			while(notDone){
				// adds interest and pays each principle
				for(var i = loan_counter; i < loans.length; i++){
					loans[i]['current_interest'] = loans[i]['principle'] * loans[i]['monthlyRate'];
					loans[i]['principle'] -= loans[i]['minimum'];
					loans[i]['principle'] -= loans[i]['extra'];
					loans[i]['principle'] += loans[i]['current_interest'];
					loans[i]['total_interest'] += loans[i]['current_interest'];				
				}
				month_counter++;

				if(loans[loan_counter]['principle'] <= 0){
					paid_in += (loan_counter+1) + " paid in " + month_counter +" months <br>";
					loan_counter++;
					total_months += month_counter;
					month_counter = 0;
					if(loan_counter == loans.length){
						notDone = false;
					}else{
						// current loans extra amount is now the original
						// extra plus all previous minimums
						loans[loan_counter]['extra'] = $scope.payment;
						for(var k = 0; k < loan_counter; k++){
							loans[loan_counter]['extra'] = parseInt(loans[loan_counter]['extra']) + parseInt(loans[k]['minimum']);
						}
					}
					
				}
			}

			var total_total_interest = 0, extra_errors = 0;
			for(var l = 0; l < loans.length; l++){
				extra_errors += loans[l]['principle'];
				total_total_interest += loans[l]['total_interest'];
			}
			var rounding_error = Math.ceil(extra_errors*-1/350);

			$("#months").text("Total Months: "+total_months);
			$("#interest").text("Total Interest: $"+Math.ceil(total_total_interest));
			$("#variance").text("Interest variance +/- 4%");
			$("#rounding").text("Rounding Error: Should be 0-1 less months than shown");
			$("#paid_in").html(paid_in);
		}

		this.clearLocal();

	}]);



//order in highest interest rate to lowest
function compare(a,b) {
  if (a.monthlyRate < b.monthlyRate)
    return 1;
  else if (a.monthlyRate > b.monthlyRate)
    return -1;
  else 
    return 0;
}


