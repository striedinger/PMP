# angular-sweetalert #
==================

![][bower-url]
[![NPM version][npm-image]][npm-url]
![][david-url]
![][dt-url]
![][license-url]

An angular service which expose sweetalert in angular way.

## Requirements ##

- [angular][angular-url]
- [sweetalert][sweetalert-url]

## Install from bower ##

```powershell
bower install angular-h-sweetalert --save
```

## Install from npm ##

```powershell
npm install angular-h-sweetalert --save
```

## Import ##

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DEMO</title>
    <link rel="stylesheet" type="text/css" href="libs/sweet-alert.css">
</head>
<body>
    <script type="text/javascript" src="libs/sweet-alert.min.js"></script>
    <script type="text/javascript" src="libs/angular.min.js"></script>
    <script type="text/javascript" src="ngSweetAlert.js"></script>
</body>
</html>
```

## Usage ##

```javascript

var demo = angular.module('demo', ['hSweetAlert']);

demo.controller('demoController', function($scope, sweet) {
    $scope.basic = function() {
        sweet.show('Simple right?');
    };

    $scope.checkIfShown = function(){
        alert(sweet.isShown());
    };
});
```

See full featured demo: http://leftstick.github.io/angular-sweetalert/



## LICENSE ##

[MIT License](https://raw.githubusercontent.com/leftstick/angular-sweetalert/master/LICENSE)

[angular-url]: https://angularjs.org/
[sweetalert-url]: http://tristanedwards.me/sweetalert
[google-fonts-url]: http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300

[bower-url]: https://img.shields.io/bower/v/angular-h-sweetalert.svg
[npm-url]: https://npmjs.org/package/angular-h-sweetalert
[npm-image]: https://badge.fury.io/js/angular-h-sweetalert.png
[david-url]: https://david-dm.org/leftstick/angular-h-sweetalert.png
[dt-url]:https://img.shields.io/npm/dt/angular-h-sweetalert.svg
[license-url]:https://img.shields.io/npm/l/angular-h-sweetalert.svg
