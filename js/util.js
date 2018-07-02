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
