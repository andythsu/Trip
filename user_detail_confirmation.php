<?php
include 'lib/User.class.php';
$user_id = $_POST['user_id'];
$result = User::selectByID($user_id);
$user_name = $result[0]['user_name'];
$user_email = $result[0]['user_email'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/user_detail_confirmation.css" rel="stylesheet">

  <title>Welcome</title>

</head>

<body style="display: block">
  <div class="text-center">
    <img class="" src="img/index_logo.png" alt="" width="50%" height="50%">
  </div>
  <div class="text-center">
    <h1>Do you want to change the following information?</h1>
    <!-- banner section -->
    <div class="alert alert-danger" style="display: none"></div>
    <div class="alert alert-success" style="display: none"></div>
    <!-- ////////////////////// -->
    <h2 name="user_name">User name: <?php echo $user_name ?></h2>
    <div class="">
      <button class="btn btn-info change_name_btn" name="change_name">Change name</button>
      <div class="change_name_div">
        <input type="text" name="change_name_field" value="">
        <button class="btn btn-success confirm_change_name_btn">Confirm</button>
      </div>
    </div>
    <h2 name="user_email">User email: <?php echo $user_email ?></h2>
    <button class="btn btn-info change_email_btn" name="change_email">Change email</button>
    <div class="change_email_div">
      <input type="email" name="change_email_field" value="" required>
      <button class="btn btn-success confirm_change_email_btn">Confirm</button>
    </div>
  </div>
  <div class="text-center" style="margin-top: 20px">
    <button class="btn btn-primary" name="button">Skip</button>
  </div>
</body>
</html>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/modal.js"></script>
<script type="text/javascript">
// hide the divs on start
$(document).ready(function(){
  $(".change_name_div").css("display", "none");
  $(".change_email_div").css("display", "none");
});

$(".change_name_btn").on("click", function(){
  $(".change_name_div").toggle();
});

$(".change_email_btn").on("click", function(){
  $(".change_email_div").toggle();
});

$(".confirm_change_name_btn").on("click", function(){
  var $name_field = $(this).siblings("input");
  var new_name = $name_field.val();
  // check for empty name
  if(!new_name.replace(/\s/g, '').length){
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
  var form_data = {
    "name" : new_name,
    "id" : <?php echo $user_id ?>
  };
  $.ajax({
    "url" : "change_user_detail.php",
    "type" : "post",
    "data" : form_data,
    success : function(json){
      var json_data = JSON.parse(json);
      var msg = json_data['msg'];
      var type = json_data['type'];
      if(type == "fail"){
        $(".alert-danger").html(msg).show(500).delay(2000).hide(500);
      }else if(type == "success"){
        $(".alert-success").html(msg).show(500).delay(2000).hide(500);
        $("h2[name=user_name]").html("User name: " + new_name);
      }
    }
  });
});

$(".confirm_change_email_btn").on('click', function(){
  var $email_field = $(this).siblings("input");
  var new_email = $email_field.val();
  // check for valid email
  if(!validateEmail(new_email)){
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
  var form_data = {
    "email" : new_email,
    "id" : <?php echo $user_id ?>
  };
  $.ajax({
    "url" : "change_user_detail.php",
    "type" : "post",
    "data" : form_data,
    success : function(json){
      var json_data = JSON.parse(json);
      var msg = json_data['msg'];
      var type = json_data['type'];
      if(type == "fail"){
        $(".alert-danger").html(msg).show(500).delay(2000).hide(500);
      }else if(type == "success"){
        $(".alert-success").html(msg).show(500).delay(2000).hide(500);
        $("h2[name=user_email]").html("User email: " + new_email);
      }
    }
  });
});

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

</script>
