
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
  .controller('formController', function($scope) {
    
    // we will store all of our form data in this object
    $scope.formData = {};
    
    $scope.sendData = function(){
      //TODO: implement PHP POST to MySQL
    };
    
});

