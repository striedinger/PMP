// Setup the filter
angular.module("app")
.filter('marked', function() {

  // Create the return function
  // set the required parameter name to **number**
  return function(questions) {
    var output = [];
    // Ensure that the passed in data is a number
    var i = 0;
    while (i<questions.session.exam.questions) {
      if(questions[i].marked=1){
        output.push(questions[i]);
      }
    }
    return output;
  }
});

app.filter('answered', function() {

  // Create the return function
  // set the required parameter name to **number**
  return function(questions) {
    var output = [];
    // Ensure that the passed in data is a number
    var i = 0;
    while (i<questions[0].session.exam.questions) {
      if(questions[i].answer!=null){
        output.push(questions[i]);
      }
      i = i+1;
    }
    return output.length  ;
  }
});

app.filter('getById', function() {
  return function(input, id) {
    var i=0, len=input.length;
    for (; i<len; i++) {
      if (+input[i].id == +id) {
        return i;
      }
    }
    return null;
  }
});