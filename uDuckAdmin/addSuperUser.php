<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>Create New User</title>
</head>
<body>
	//should really be using ssl
	<form action='actions/addUser.php' method='post'>
	Desired Username: <input type="text" name="user" /><br>
	Desired Password: <input type="password" name="pword" /><br>
	Confirm Password: <input type="password" name="pwordv" /><br>
	E-Mail Address  : <input type="text" name="email" /><br>
	Permission Level: <input type="text" name="lvl" value=255 /><br>
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
	

		
		
		
</body>
</html>	


