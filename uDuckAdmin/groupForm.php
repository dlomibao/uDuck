<?php include 'cp_header.php';
	  include 'uD_admin.php';
	  $admin=new uDuck_Admin();
	  if(isset($_GET['ID']) ){
			$groupvalue=$_GET['ID'];
			$g=$admin->getGroupByID($groupvalue);}
	  		//print_r($g);	}
	  else{
			$groupvalue='';
			$g=Array ( 'Name' => '','Caption'=>'','Thumb' => '','CatID' => '');
		}
	  
 ?>

	<div class='cp_body' id='groupForm'>
	
	<h2>Edit Group</h2>
	<form action='actions/addGroup.php' method='post'>
	<table>
	<tr>
		<td>Group Name:</td>
		<td colspan=2> <input type="text" name="name" value='<?php echo $g['Name']; ?>' placeholder="Enter group name here..."size=90 /></td>
	</tr>
	<tr>
		<td>Caption:</td>
		<td colspan=2><input type="text" name="caption" value='<?php echo $g['Caption']; ?>' placeholder="Enter caption here..." size=90 /></td>
	</tr>
	<tr>
		<td>Thumb URL:</td>
		<td colspan=2><input type="text" name="thumb" value='<?php echo $g['Thumb']; ?>'placeholder="http://" size=90 /></td>
	</tr>
	<tr>
		<td>Category:</td>
		<td><?php $admin->dropMenuCat("cid",$g['CatID']);?></td>
		<td>ID: <input type="text" name="id" readonly="readonly" size="6" value='<?php echo $groupvalue; ?>' placeholder="New Group" class="greyedout"/></td>
	</tr>
	</table>
	<br>
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
	</div>

<?php include 'cp_footer.php'; ?>
