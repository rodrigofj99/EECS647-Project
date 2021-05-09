<!DOCTYPE html>
<?php
session_start();
 ?>
<html>
<head>
<title>Playlist Party</title>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}

body {
	/*background: #f6f5f7;*/
	background-image: url('http://mppmduse2pmpovwapp.azurewebsites.net/wp-content/uploads/2019/09/netflix-background-9.jpg'); /*https://cdn.hipwallpaper.com/i/98/21/dUyCkp.jpg */
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
}

h1 {
	font-weight: bold;
	color:#fff;
	margin: 0;
	opacity: 1;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
}

a {
	color: #fff;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #FF4B2B;
	background-color: #B22222;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}

button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

button.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #000;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
	color:white;
	background-color: #878C8F;
	opacity: 1;
	font-weight: bold;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25),
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 480px;
}

.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
	opacity: 1;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
	opacity: 1;
}

.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	z-index: 1;
	opacity: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}

	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;
}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #B22222;
	background: -webkit-linear-gradient(to right, ##B22222, #FF416C);
	background: linear-gradient(to right, ##B22222, #FF416C);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

.social-container {
	margin: 20px 0;
}

.social-container a {
	border: 1px solid #DDDDDD;
	border-radius: 50%;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	margin: 0 5px;
	height: 40px;
	width: 40px;
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}

.opacity {
	opacity: 0.8;
}

.logo{
	width:500px;
	display: block;
  	margin-left: auto;
  	margin-right: auto;
}

</style>
</head>

<body>
	<?php
	$message = "";
		include 'db_connect.php';
		$dbConnection = OpenCon();
			if(isset($_POST['signin_button'])) //call when button sigin is pressed
			{
				$email = $_POST['email'];
				$password = $_POST['password'];
				$stmt = $dbConnection->prepare("SELECT Email,Password,UID FROM user WHERE Email = '$email' and Password = '$password'");
				$stmt->execute();
				$result = $stmt->get_result();
				$val = $result->fetch_row();
				if(!$val)
				{
					echo "Wrong email or password";
				}else
				{
					$userID = $val[2];
					echo($userID);
					//setcookie("UID",$userID);

					$_SESSION['UID'] = $userID;
					echo '<script type="text/javascript">
					location.replace("profile.php");
				 </script>';
					exit();
			//	echo '
			//		<form name="signup" action="setCookie.php"  method="post">
			//		<input type="email" name="UID" value =';
			//		echo($val[2]);
			//		/>'
			//		</form>';
				}
			}

			if(isset($_POST['signup_button'])) //call when button signup is pressed
			{
				$name = $_POST['name'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$stmt = $dbConnection->prepare("INSERT INTO user(Name,Email,Password) values('$name','$email','$password')");
				$stmt->execute();
			}

			CloseCon($dbConnection);
	?>
<div style="background-color: #000; opacity:0.8"><img class="logo" src="logo-removebg-preview.png" alt=""></div>
<div class="container opacity" id="container">
	<div class="form-container sign-up-container">
		<form name="signup" action=""  method="post">
			<h1>Create Account</h1>
			<input type="text" name="name" required placeholder="Name" />
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<button type="submit" name="signup_button">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form name="signin" action="" method="post">
			<h1>Sign in</h1>
			<input type="email" name="email" placeholder="Email" />
			<input type="password" name="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button type="submit" name="signin_button">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start sharing your favorite movies</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

</script>
<footer class="pt-2 my-2 border-top text-center" style="color:white">
		Copyright &copy; 2021: Rodrigo Figueroa Justiniano, Victoria Maldonado.
		<a href="https://github.com/rodrigofj99/EECS647-Project" class="ml-2">GitHub Repository</a>
</footer>
</body>
</html>
