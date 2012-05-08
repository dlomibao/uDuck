<?php
/**the form to add new posts
 * TODO: 
 * 		Get initial values
 * 		use GET to ?id=1 to load a post via pdo
 * 		use pdo to grab group and category drop down list
 * 		check for permission to pick an Author other than self (drop down?)
 * 		check for permission to publish(make visible)
 * 		call add vs update based on what the GET data says
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<title>uDuck Post Form</title>
</head>
<body>
	
	<form action='actions/addPost.php' method='post'>
		ID			<input type="text" name="id" /><br>
		Title		<input type="text" name="Title"/><br>
		Author		<input type="text" name="Author"/><br>
		Body		<input type="text" name="Body" /><br>
		Caption		<input type="text" name="Caption" /><br>
		ThumbnailURL<input type="text" name="Thumb" /><br>
		Group		<input type="text" name="GroupID" /><br>
		Category	<input type="text" name="CatID" /><br>
		Tags		<input type="text" name="Tags"/><br>
		Visible		<input type="checkbox" name="Visible" /><br>
	
	
	
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
	

		
		
		
</body>
</html>