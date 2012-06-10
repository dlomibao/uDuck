<?php
/**category page
 * 
 * shows available  actions
 * 	delete
 *  edit
 *  add new
 * list all categories
 */
include 'cp_header.php';
include 'uD_Admin.php';
$admin= new uDuck_Admin();//auto connect
if(isset($_GET['start'])){$start=$_GET['start'];}else{$start=0;}//sets the start of the post listing range based on MySQL OFFSET 
if(isset($_GET['count'])){$count=$_GET['count'];}else{$count=25;}//sets the number of posts to show based on MySQL LIMIT
$p=$admin->getCategoriesRange($start,$count);
//build post table
		$showArray=array('Cat','GroupName');
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
				if($f=='Cat'){$disp="<a href='catForm.php?ID=$id'>$disp</a>";}
				//if($f=='Author'){$disp=$admin->returnRowItem($row[$f], $admin->u,"Name");}//not ideal probably
				//if($f=='CatID'){$disp=$admin->returnRowItem($row[$f], $admin->c,"Cat");}//not ideal probably
				//if($f=='GroupID'){$disp=$admin->returnRowItem($row[$f], $admin->g,"Name");}//not ideal probably
				$html .= '<td>'. $disp .'</td>';
			}
			$html .= "<td><input type='checkbox' name='selected[]' value='$id'/></td></tr>";
		}
		$html .= '</table>';
		
?>

<div class="cp_body" id="postPage">
	<h2>Categories</h2>
	<a href="catForm.php">Create New Category</a><br><br>
	<form action="actions/deleteCats.php" method="post"><!--eventually refactor to a single delete.php with different modes aka delete.php?Mode=group-->
	<?php echo $html; ?><!--holds the dynamically generated table of posts-->
	<br>
	<input type="submit" value="Delete Selected"/> <!--TODO: add confirmation dialog-->
	<button type="reset">Clear Selection</button>
	</form>
	
	
</div>

<?php include 'cp_footer.php';
?>