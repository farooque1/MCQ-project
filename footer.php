<script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("password-login");
  var y = document.getElementById("password-signup");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}

function ShowHideDiv(btnPassport) {

            var dvPassport = document.getElementById("dvPassport");
            if (btnPassport.value == "Check Your Progress") {
                dvPassport.style.display = "block";
                btnPassport.value = "Hide Progress";
            } else {
                dvPassport.style.display = "none";
                btnPassport.value = "Check Your Progress";
            }
        }


</script>


	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script src="./script.js"></script>	

</body>
</html>