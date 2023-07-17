<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration or Sign Up form in HTML CSS | CodingLab </title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/lgn.css') ?>">
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
        .alertt {
            padding: 20px;
            background-color: green;
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        .closebtnn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtnn:hover {
            color: black;
        }
    </style>
</head>

<body>
    <div class="wrapper" ng-app="myApp" ng-controller="myCtrl">
        <h2>Login</h2>

        <div class="alert" ng-if="errorMessage">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{errorMessage}}
        </div>

        

        <div class="alertt" ng-if="message">
            <span class="closebtnn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{message}}
        </div>


        <form>
            <div class="input-box">
                <label for="">Email</label><br>
                <input type="text" placeholder="Enter your email" ng-model="email">
            </div><br>
            <small class="form-text f-14 text-left vi-red-clr" ng-bind-html="trustedHtml(errors.email)" style="color:red"></small>

            <div class="input-box">
                <label for="">Password</label><br>
                <input type="password" placeholder="password" ng-model="password">
            </div><br>
            <small class="form-text f-14 text-left vi-red-clr" ng-bind-html="trustedHtml(errors.password)" style="color:red"></small>

            <div class="input-box button">
                <input type="button" value="Login" name="btnInsert" ng-click="insertData()">
            </div>
            <div class="text">
                <h3>Dont't have an account? <a href="<?php echo Site_url('Register/index') ?>">Signup</a></h3>
            </div>
        </form>
    </div>
</body>

<script>
    var app = angular.module("myApp", []);

    var $config = {
        'base_url': '<?php echo $this->config->item("base_url") ?>'
    }

    app.controller("myCtrl", ['$scope', '$http', '$sce', function($scope, $http, $sce) {

        $scope.trustedHtml = function(plainText) {
            return $sce.trustAsHtml(plainText);
        };
        $scope.errors = {};

        $scope.insertData = function() {
            var data = $.param({
                'email': $scope.email,
                'password': $scope.password,
            });
            $http({
                    method: 'POST',
                    url: $config.base_url + 'Register/loginUser',
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function(response) {
                    if (response.data.status === 'success') {
                        $scope.message = response.data.success_message;
                        window.location.href = "<?php echo base_url('Register/welcome') ?>"
                        $scope.errors = '';
                        $scope.email = '';
                        $scope.password = '';
                    } else {
                        $scope.errors = response.data.errors;
                        $scope.errorMessage = response.data.error_message;
                    }
                })
                .catch(function(error) {
                    console.log('Error:', error);
                });
        }
    }]);
</script>

</html>