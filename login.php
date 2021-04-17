<?php
include_once 'inc/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$insertCustomer=$cs->insert_customer($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$loginCustomer=$cs->login_customer($_POST);
}
if(isset($_SESSION['customer'])){
  echo "<script>window.location='order.php'</script>";
}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<?php
			if(isset($loginCustomer)){
				echo $loginCustomer;
			}
			?>
			<form action="" method="POST">
				<input required name="email" type="text" placeholder="Email">
				<input required name="password" type="password" placeholder="Password">
				<input type="submit" name="login" class="grey" value="SIGN IN"></input>
			</form>
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
		</div>
		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if(isset($insertCustomer)){
				echo $insertCustomer;
			}
			?>
			<form method="POST" action="">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input required name="name" type="text" placeholder="Name">
								</div>

								<div>
									<input required name="city" type="text" placeholder="City">
								</div>

								<div>
									<input required name="zipcode" type="text" placeholder="Zipcode">
								</div>
								<div>
									<input required name="email" type="text" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input required name="address" type="text" placeholder="Address">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="AF">Afghanistan</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>

									</select>
								</div>

								<div>
									<input required name="phone" type="text" placeholder="Phone">
								</div>

								<div>
									<input required name="password" type="password" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Create Account"></input></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include_once 'inc/footer.php';
?>