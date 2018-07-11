/**
* valid user name
* @param  {[type]} name [description]
* @return {[type]} true if there is non-space character in 'name'
*                  false if it's all space
*/
function validateName(name){
  return name.replace(/\s/g, '').length;
}

/**
* valid user email address
* @param  {[type]} email [description]
* @return {[type]} true if it's in correct format
*                  false if the format is wrong
*/
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

/**
* return current date and time
* @return yyyy-mm-ddTh:m
*/
function today(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  var hours = today.getHours();
  var minutes = today.getMinutes();
  mm = mm.toString().length > 1 ? mm : "0"+mm;
  dd = dd.toString().length > 1 ? dd : "0"+dd;
  hours = hours.toString().length > 1 ? hours : "0"+hours;
  minutes = minutes.toString().length > 1 ? minutes : "0"+minutes;
  return yyyy+"-"+mm+"-"+dd+"T"+hours+":"+minutes;
}
