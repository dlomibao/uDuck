<?php include 'cp_header.php'; ?>
	<div class='cp_body' id='groupbody'>
	
	<h2>Add Group</h2>
	<form action='actions/addGroup.php' method='post'>
	Group Name: <input type="text" name="name" /><br>
	Caption   : <input type="text" name="caption" /><br>
	Thumb URL : <input type="text" name="thumb" /><br>
	Category  : <input type="text" name="cid" /><br>
	
	
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
	</div>

<?php include 'cp_footer.php'; ?>
