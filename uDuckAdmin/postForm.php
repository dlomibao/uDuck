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
require_once "./cp_header.php";
?>
<div class="cp_body" id="postForm">
	<h1>uDuck Post Form</h1>
	<form action='actions/addPost.php' method='post'>
		<table>
		<tr>
			<td>ID</td>
			<td><input type="text" name="id" /></td>
		</tr>
		<tr>
			<td>Title</td>
			<td><input type="text" name="Title" /></td>
		</tr>
		<tr>
			<td>Author</td>
			<td><input type="text" name="Author"/>
		</tr>
		
		<tr>
			<td>Body</td>
			<td><input type="text" name="Body" />
		</tr>
		
		<tr>
			<td>Caption</td>
			<td><input type="text" name="Caption" />
		</tr>
		
		<tr>
			<td>Thumbnail URL</td>
			<td><input type="text" name="Thumb" />
		</tr>
		
		<tr>
			<td>Group ID</td>
			<td><input type="text" name="GroupID" />
		</tr>
		
		<tr>
			<td>Cat ID</td>
			<td><input type="text" name="CatID" />
		</tr>
		
		<tr>
			<td>Tags</td>
			<td><input type="text" name="Tags"/>
		</tr>
		
		<tr>
			<td>Visible</td>
			<td><input type="checkbox" value=1 name="Visible" /><br>
		</table>
	
	
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
</div>
<?php	require_once "./cp_footer.php"; ?>
		
		
		
</body>
</html>