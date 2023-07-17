<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration or Sign Up form in HTML CSS | CodingLab</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Rgstr.css') ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>

<body>
    <div class="wrapper" ng-app="myApp" ng-controller="myCtrl">
        <h2>Registration</h2>
        <form>
            
            <div class="input-box">
                <label for="">First-Name</label><br>
                <input type="text" placeholder="Enter your name" ng-model="firstname" name="firstname">
            </div><br>
            <small class="form-text f-14 text-left vi-red-clr" ng-bind-html="trustedHtml(errors.firstname)" style="color:red"></small>

          
            <div class="input-box">
                <label for="">Email</label><br>
                <input type="text" placeholder="Enter your email" ng-model="email" name="email">
            </div><br>
            <small class="form-text f-14 text-left vi-red-clr" ng-bind-html="trustedHtml(errors.email)" style="color:red"></small>

           
            <div class="input-box">
                <label for="">Password</label><br>
                <input type="password" placeholder="Create password" ng-model="password" name="password">
            </div><br>
            <small class="form-text f-14 text-left vi-red-clr" ng-bind-html="trustedHtml(errors.password)" style="color:red"></small>

          
            <div class="input-box">
                <label for="">Confirm-Password</label><br>
                <input type="password" placeholder="Confirm password" ng-model="conpassword" name="conpassword">
            </div><br>
            <small class="form-text f-14 text-left vi-red-clr" ng-bind-html="trustedHtml(errors.conpassword)" style="color:red"></small>

            <div class="input-box button">
                <input type="button" value="Register Now" name="btnInsert" ng-click="insertData()">
            </div>

            <div class="text">
                <h3> have an account? <a href="<?php echo Site_url('Register/login') ?>">Login
            </a></h3>
            </div>
        </form>
    </div>

    <script>
    var app = angular.module("myApp", []);

    var $config = {
        'base_url': '<?php echo $this->config->item("base_url") ?>'
    }

    app.controller("myCtrl", ['$scope', '$http', '$sce', function ($scope, $http, $sce) {

        $scope.trustedHtml = function(plainText) {
                return $sce.trustAsHtml(plainText);
            };
            $scope.errors = {};
            
            
        $scope.insertData = function () {
            var data = $.param({
                'firstname': $scope.firstname,
                'email': $scope.email,
                'password': $scope.password,
                'conpassword': $scope.conpassword,
            });



            $http({
                method: 'POST',
                url: $config.base_url + 'Register/addUser',
                data: data,
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function(response) {
                        if (response.data.status === 'success') {
                            alert('Registration successful');
                            $scope.errors ='';
                                $scope.firstname = '';
                                $scope.email = '';
                                $scope.password = '';
                                $scope.conpassword ='';
                        } else {
                            $scope.errors = response.data.errors;
                        }
                    })
                    .catch(function(error) {
                        console.log('Error:', error);
                    });
        }



    }]);

</script>
</body>

</html>