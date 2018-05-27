var app = angular.module('myApp', ['ngRoute'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

app.config(['$routeProvider','$locationProvider', function($routeProvider,$locationProvider){

  $routeProvider
  .when("/home", {
      templateUrl : "views/home.php",
      controller: "HomeController"
  })
  .when("/upload", {
      templateUrl : "views/upload.php",
      controller: "UploadController"
  })
  .when("/my-photo", {
      templateUrl : "views/my-photo.php",
      controller: "MyphotoController"
  })
  .otherwise({
      redirectTo: "/home"
  });


}]);
app.controller('HomeController',function($scope,$http){
  $http({
    method:"GET",
    url:"/api/v2/getuser",
  }).then(function mySuccess(response){
    $scope.user=response.data;
  });
});



app.controller('MyphotoController',function($scope,$http){
  $scope.id="";
  $scope.imUrl=location.hostname+':'+location.port;
  $http({
    method: "GET",
    url: "/api/v2/getall",
  }).then(function mySuccess(response){
    if(typeof response.data.success != 'undefined'){
      if(response.data.pub_images.length!=0){
        $scope.pbimages=response.data.pub_images;
        $scope.pub_image=true;
      }
      else{
        $scope.pub_image=false;
      }
      if(response.data.pri_images.length!=0){
        $scope.primages=response.data.pri_images;
        $scope.pri_image=true;
      }
      else{
        $scope.pri_image=false;
      }
    }
    else{
      for(x in response.data){
        alert(response.data[x]);
      }
    }
  },function myError(response){
    for(x in response.data){
      alert(response.data[x]);
    }
    console.log(response);
});

$scope.getId=function(id){
  $scope.id=id;
}

$scope.onInvite=function(){

var inData=new FormData();
inData.append('img_id',$scope.id);
inData.append('friend_email',$scope.friend.email);

$http({
  method: "POST",
  url: "/api/v2/invite",
  data: inData,
  transformRequest: angular.indentity,
  headers: {'Content-Type': undefined}
}).then(function mySuccess(response){
  if(typeof response.data.success != 'undefined'){
    alert(response.data.message);
    document.getElementById("modal_close").click();
  }
  else{
    for(x in response.data){
      alert(response.data[x]);
    }
  }
},function myError(response){
  for(x in response.data){
    alert(response.data[x]);
  }
});
}

});


app.controller('UploadController', function($scope,$http,$location){
  $scope.image={};
  $scope.onUpload= function(){
    var inData = new FormData();
    for(var key in $scope.image)
      inData.append(key,$scope.image[key]);
    if($scope.image.file.type.split("/")[0]!="image")
      alert("Must Select A Image File");
    else{
      $http({
        method: "POST",
        url: "/api/v2/upload",
        data: inData,
        transformRequest: angular.indentity,
        headers: {'Content-Type': undefined}
      }).then(function mySuccess(response){
        if(typeof response.data.success != 'undefined'){
          alert(response.data.message);
          $location.path("/my-photo");
        }
        else{
          for(x in response.data){
            alert(response.data[x]);
          }
        }
      },function myError(response){
        for(x in response.data){
          alert(response.data[x]);
        }
        console.log(response);
    });
  }
    console.log($scope.image.file.type);
    /*alert($scope.image);
    var inData={
      title: $scope.title,
      description: $scope.disc,
      visibility: $scope.status,
      file:$scope.image
    };
    console.log('file is ' );
    console.dir($scope.image);
    $http({
      method: "POST",
      url: "/api/v2/upload",
      data: inData,
      headers: {'Content-Type': undefined}
    }).then(function mySuccess(response){
        for(x in response.data){
          alert(response.data[x]);
        }
    },function myError(response){
      alert('error');
    });*/
  };

});

app.controller('myCtrl', function($scope) {
    $scope.firstName = "John";
    $scope.lastName = "Doe";
});

app.directive('fileModel', ['$parse', function ($parse) {
    return {
       restrict: 'A',
       link: function(scope, element, attrs) {
          var model = $parse(attrs.fileModel);
          var modelSetter = model.assign;
          element.bind('change', function(){
             scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
             });
          });
       }
    };
}]);
