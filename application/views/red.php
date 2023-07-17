<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <style>
        .alert {
            padding: 20px;
            background-color: green;
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
    </style>
</head>

<body ng-app="crudApp" ng-controller="crudController">

    <?php if ($this->session->flashdata('success_message')) : ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <h1 align="center">Crud Using AngularJS and Codeigniter3</h1>

    <h2>Add New Record</h2>
    <form ng-submit="createRecord()">
        <input type="text" ng-model="name" placeholder="Name" required>
        <input type="email" ng-model="email" placeholder="Email" required>
        <button type="submit">Add</button>
    </form>

    <div class="text">
        See data <a href="<?php echo Site_url('MyController/indexx') ?>">Click</a>
            </div>
</body>

<script>
    var app = angular.module('crudApp', []);

    var $config = {
        'base_url': '<?php echo $this->config->item("base_url") ?>'
    }

    app.controller('crudController', ['$scope', '$http', function($scope, $http) {

        $scope.createRecord = function() {
            var data = $.param({
                'name': $scope.name,
                'email': $scope.email,
            });
            $http({
                    method: 'POST',
                    url: $config.base_url + 'MyController/create',
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                }).then(function(response) {
                          alert('data submitted');
                })
                .catch(function(error) {
                    console.log('Error:', error);
                });
        }
    }]);
</script>

</html>