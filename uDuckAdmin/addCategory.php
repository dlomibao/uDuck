<?php include "cp_header.php";?>
	<div class='cp_body' id='catbody'>
		<h3>Create New Category</h3>
		<form action='actions/addCat.php' method='post'>
			Category Name <input type="text" name="cat" /><br>
			Group    Name <input type="text" name="gname" /><br>
			<button type='submit'>Send</button>
			<button type='reset'>Reset</button>
		</form>
	</div>

		
<?php include "cp_footer.php";?>