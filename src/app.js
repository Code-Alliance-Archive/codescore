/*
 *	app.js
 *
 *	Main AngularJS controller and configuration script
 *
 *	Portions of code (C) 2016 Scotch.io, L.L.C. https://scotch.io/tutorials/angularjs-multi-step-form-using-ui-router
 *	Permission for use in this app implied according to terms of original license holder, found here: https://scotch.io/license
 *	This program is inteded for non-profit, non-commercial use. New licenses claimed only on new edits.
 *
 *	New edits:
 *	@author: S. West
 *	@affiliation: Code Alliance
 *	@date: May 2016
 *	@license: cc-by-nc-sa 3.0 IGO
 *
*/


// create our angular app and inject ngAnimate and ui-router 
// =============================================================================
angular.module('formApp', ['ngAnimate', 'ui.router'])

  // configuring our routes 
  // =============================================================================
  .config(function($stateProvider, $urlRouterProvider) {
    
    $stateProvider
    
      // route to show our basic form (/codescore)
      .state('codescore', {
        url: '/codescore',
        templateUrl: 'codescore.html',
        controller: 'formController'
      })
        
      // nested states 
      // each of these sections will have their own view
      // url will be nested (/codescore/mode)
      .state('codescore.mode', {
        url: '/mode',
        templateUrl: 'codescore-mode.html'
      })
          
      // url will be nested (/codescore/set1)
      .state('codescore.set1', {
        url: '/set1',
        templateUrl: 'codescore-set1.html'
      })
          
      // url will be /codescore/set2
      .state('codescore.set2', {
        url: '/set2',
        templateUrl: 'codescore-set2.html'
      })
          
      // url will be /codescore/set3
      .state('codescore.set3', {
        url: '/set3',
        templateUrl: 'codescore-set3.html'
      })
          
      // url will be /codescore/set4
      .state('codescore.set4', {
        url: '/set4',
        templateUrl: 'codescore-set4.html'
      })
          
      // url will be /codescore/set5
      .state('codescore.set5', {
        url: '/set5',
        templateUrl: 'codescore-set5.html'
      })
    
      // url will be /codescore/set5
      .state('codescore.set6', {
        url: '/set6',
        templateUrl: 'codescore-set6.html'
      })
        
      // url will be /codescore/set7
      .state('codescore.set7', {
        url: '/set7',
        templateUrl: 'codescore-set7.html'
      })
      
      // url will be /codescore/set8
      .state('codescore.set8', {
        url: '/set8',
        templateUrl: 'codescore-set8.html'
      })
      
      // url will be /codescore/finish
      .state('codescore.finish', {
        url: '/finish',
        templateUrl: 'codescore-finish.html'
      })
	  
	  // url will be /codescore/postsurvey
	  .state('codescore.postsurvey', {
		  url: '/postsurvey',
		  templateUrl: 'codescore-postsurvey.html'
	  })
    
      // url will be /codescore/takesurvey
      .state('codescore.takesurvey', {
        url: '/takesurvey',
        templateUrl: 'codescore-takesurvey.html'
      });
        
    // catch all route
    // send users to the form page 
    $urlRouterProvider.otherwise('/codescore/mode');
  })

  // our controller for the form
  // =============================================================================
  .controller('formController', function($scope, $http) {
    
    // we will store all of our form data in this object
    $scope.formData = {"tablelocation":"surveydb.surveyqtb"};
	
	$scope.initobj = {"setupname":"surveydb","qtab":"surveyqtb","atab":"surveyresptb"};
	
	$scope.questionsasked = {};	
	
	$scope.questionelemnt = [];
	
		
	//sets up the database (if not already there)
	$scope.setup = function(){
		$http({
			method: 'POST',
			url: 'setup_db.php',
			data: $scope.initobj,
			headers: {'Content-Type': 'application/json'}
		})
		.success(function(data){
		});
	};
		    
    $scope.sendData = function(){		
      //TODO: finish implementing PHP POST commands to MySQL
	  $http({
        method  : 'POST',
        url     : 'post_db.php',
        data    : $scope.formData, //forms user object
        headers : {'Content-Type': 'application/json'} 
      })
	  .success(function(data) {
      });
    };

	//TODO: implement PHP GET from MySQL for survey retrieval	
	$scope.getData = function(){
		$http.get("get_db.php")
		.success(function(data){
			var loads = data.slice(0).split(",");
			for(var l = 0; l < loads.length - 1; l++){
				$scope.questionsasked[l] = loads[l];
				var idd = loads[l].split(":");
				$scope.questionelemnt.push({
					id: idd[0] + "a",
					question: idd[1],
					answer: '',
					inline: true
				});						
			}
			$scope.questionsasked["surveyid"] = loads[loads.length - 1].split(":")[1];
		});
	};
	
	//TODO: implement PHP POSt to MySQL for survey responses
	$scope.sendResponses = function(){
		var newobject = {"tablelocation":"surveydb.surveyresptb"};
		newobject["surveyid"] = $scope.questionsasked["surveyid"];
		for(var q in $scope.questionelemnt){
			var elem = $scope.questionelemnt[q];
			if(elem["id"] !== "surveyid"){
				newobject[elem["id"]] = elem["answer"];
			}
		}
	  $http({
        method  : 'POST',
        url     : 'update_db.php',
        data    : newobject, //forms user object
        headers : {'Content-Type': 'application/json'} 
      })
	  .success(function(data) {
      });
	};
	
});