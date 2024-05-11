<!-- Validation script-->
<!-- jQuery library -->
<script src="<?php echo $home_url; ?>src/js/auth/jquery.js"></script>
<!-- our custom JavaScript -->
<script src="<?php echo $home_url; ?>src/js/auth/custom-script.js"></script>

<script>
// jQuery codes
$(document).ready(function(){
// catch the submit form, used to tell the user if password is good enough
$('#register, #change-password').submit(function(){

var password_strenght=$('#passwordStrength').text();

if(password_strenght!='Good Password!'){
  alert('Password not strong enough');
  return false
}

return true;
});

});
}
</script>
</body>

</html>