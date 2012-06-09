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
include "uD_Admin.php";
$admin= new uDuck_Admin();
if(isset($_GET['ID']) ){
	$postvalue=$_GET['ID'];
	$p=$admin->getPostByID($postvalue);
	//print_r($p);
}else{
	$postvalue='';
	$p=Array ( 'Title' => '','Author'=>'','Body' => 'Enter Post Body Here.','Caption' => '','Thumb' => '','GroupID'=>'','CatID'=>'','Tags' => '','Visible'=>'1', 'Created'=>'new post','Modified'=>'new post');
	
}
?>


<div class="cp_body" id="postForm">
	<!--uses nicedit for textarea richtexxt-->
	 <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
	 <script type="text/javascript">
		//<![CDATA[
        	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  		//]]>
  	</script>
	<h2>Edit Post</h2>
	

	<form action='actions/addPost.php' method='post'>
		<table>
			<tr>
				<td>Author: </td>
				<td><?php $admin->dropMenuUser("Author",$p['Author']); ?><!--<input type="text" name="Author"/>--></td>
				<td>Category: </td>
				<td><?php $admin->dropMenuCat("CatID",$p['CatID']); ?></td>
				<td>Group: </td>
				<td><?php $admin->dropMenuGroup("GroupID",$p['GroupID']); ?></td>
			</tr>
		</table>
		<input type="text" name="Title"   placeholder="Enter Title Here" title="Title"   value="<?php echo $p['Title']; ?>" style="width:90%;"/>
		<input type="text" name="Caption" placeholder="Caption"          title="Caption" value="<?php echo $p['Caption']; ?>" style="width:90%;"/>
		<textarea name="Body" placeholder="Enter Post Body Here." style="width: 90%;" rows="15"><?php echo $p['Body'];?></textarea>
		<table>
			<tr>
				<td>Thumbnail URL: </td>
				<td colspan="3"><input type="text" name="Thumb" value='<?php echo $p['Thumb']; ?>' size="90" placeholder="http://" /></td>
			</tr>
			<tr>
				<td>Tags: </td>
				<td colspan="3"><input type="text" name="Tags" value='<?php echo $p['Tags']; ?>' size="90"/></td>
			</tr>
			<tr>
				<td>Visible: <input type="checkbox" value=1 name="Visible" <?php if($p['Visible']>0){echo "checked";}?>/></td>
				<td>ID: <input type="text" name="id" readonly="readonly" size="5" value='<?php echo $postvalue; ?>' placeholder="New Post" class="greyedout"/></td>
				<td>Created: <?php echo $p['Created'];?></td>
				<td>Modified: <?php echo $p['Modified'];?></td>
			</tr>
		</table>
	
	
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
</div>


<?php	require_once "./cp_footer.php"; ?>
		
		
		
</body>
</html>