<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Welcome</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">



  <!-- Custom styles for this template -->
  <link href="css/sign_in.css" rel="stylesheet">
</head>

<body style="display: block">
  <div class="text-center">
    <img class="" src="img/index_logo.png" alt="" width="50%" height="50%">
  </div>
  <div class="text-center">
    <form class="form-signin">
      <!-- banner section -->
      <div class="alert alert-danger" style="display: none; margin-top: 10px"></div>
      <!-- //////////////////////// -->
      <label for="">Enter your name</label>
      <input type="text" name="name" placeholder="">
      <label for="">Enter your email</label>
      <input type="email" name="email" placeholder="">

      <button class="btn btn-primary form-control sign_up_btn" type="submit" name="button" style="margin-top: 10px">Sign Up</button>

    </form>
    <button class="btn btn-dark" onclick="window.location='index.php'">Back</button>
  </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/modal.js"></script>
<script src="js/util.js"></script>
<script type="text/javascript">
$(".form-signin").submit(function(e){
  e.preventDefault();
  var self = $(this);
  var form_data = getFormData(self);
  var name = form_data['name'];
  var email = form_data['email'];
  if(!validateName(name)){
    var modal_attr = {
      "header" : {
        "content" : "Warning!",
        "color" : "red"
      },
      "body" : {
        "content" : "Name cannot be empty"
      }
    };
    var modal = getModal(modal_attr);
    appendModal(modal);
    return;
  }
  if(!validateEmail(email)){
    var modal_attr = {
      "header" : {
        "content" : "Warning!",
        "color" : "red"
      },
      "body" : {
        "content" : "Please enter a valid email address"
      }
    };
    var modal = getModal(modal_attr);
    appendModal(modal);
    return;
  }
  $.ajax({
    "url" : 'daemon/sign_up_verification.php',
    "type" : 'post',
    "data" : form_data,
    success: function (json) {
      var json_data = JSON.parse(json);
      var msg = json_data['msg'];
      var type = json_data['type'];
      if(type == "fail"){
        $(".alert-danger").html(msg).show(500).delay(2000).hide(500);
      }else if(type == "success"){
        window.location.href = "index.php";
      }
    }
  });
});

function getFormData(form) {
  var form_data = form.serializeArray();
  var json_data = {}; //create an empty object
  $.each(form_data, function (index, field) { //field = the object associated with the index. The object has "name" and "value"
  var name = field['name'];
  var value = field['value'];
  json_data[name] = value;
});
return json_data;
}
</script>
