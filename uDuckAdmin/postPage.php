<?php
/**post page
 * 
 * shows available post actions
 * 	delete
 *  edit
 *  add new
 * list all posts
 */
include 'cp_header.php';
include 'uD_Admin.php';
$admin= new uDuck_Admin();//auto connect
if(isset($_GET['start'])){$start=$_GET['start'];}else{$start=0;}//sets the start of the post listing range based on MySQL OFFSET 
if(isset($_GET['count'])){$count=$_GET['count'];}else{$count=25;}//sets the number of posts to show based on MySQL LIMIT
$p=$admin->getPostRange($start,$count);
$admin->getAllUsers();
$admin->getAllCategories();
$admin->getAllGroups();
//build post table
		$showArray=array('Title','Author','Caption','CatID','GroupID','Visible');
		$html ='';
		$html .= '<table class="realtable"><tr>';
		foreach($showArray as $e){
			$html .= '<td><em>'. $e .'</em></td>';
		}
		$html .= '</tr>';
		//<a href='postForm.php?ID=$id'> 
		foreach($p as $row){
			$id=$row['ID'];
			$html .= "<tr>";
			foreach($showArray as $f){
				$disp=$row[$f];
				if($f=='Title'){$disp="<a href='postForm.php?ID=$id'>$disp</a>";}
				if($f=='Author'){$disp=$admin->returnRowItem($row[$f], $admin->u,"Name");}//not ideal probably
				if($f=='CatID'){$disp=$admin->returnRowItem($row[$f], $admin->c,"Cat");}//not ideal probably
				if($f=='GroupID'){$disp=$admin->returnRowItem($row[$f], $admin->g,"Name");}//not ideal probably
				$html .= '<td>'. $disp .'</td>';
			}
			$html .= "<td><input type='checkbox' name='selected[]' value='$id'/></td></tr>";
		}
		$html .= '</table>';
		
?>

<div class="cp_body" id="postPage">
	<h2>Posts</h2>
	<a href="postForm.php">Create New Post</a><br><br>
	<form action="actions/deletePosts.php" method="post">
	<?php echo $html; ?><!--holds the dynamically generated table of posts-->
	<br>
	<input type="submit" value="Delete Selected"/> <!--TODO: add confirmation dialog-->
	<button type="reset">Clear Selection</button>
	</form>
	
	
</div>

<?php include 'cp_footer.php';
?>