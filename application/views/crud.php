<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body ng-app="myApp">
    <div ng-controller="MyController">
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <tr ng-repeat="record in records">
                <td>{{ record.id }}</td>
                <td>{{ record.name }}</td>
                <td>{{ record.email }}</td>
            </tr>
        </table>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
        <script>
            var app = angular.module('myApp', []);

            app.controller('MyController', function($scope, $http) {
                $scope.records = [];

                $http.get('/index.php/MyController/get')
                    .then(function(response) {
                        $scope.records = response.data;
                    });
            });
        </script>
    </div>
</body>
</html>
