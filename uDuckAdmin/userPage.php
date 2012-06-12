<?php
/**User page
 *
 */
include 'cp_header.php';
include 'uD_Admin.php';
$admin= new uDuck_Admin();//auto connect
$level=((isset($_SESSION['uLvl']))?$_SESSION['uLvl']:0);

if(isset($_GET['start'])){$start=$_GET['start'];}else{$start=0;}//sets the start of the post listing range based on MySQL OFFSET 
if(isset($_GET['count'])){$count=$_GET['count'];}else{$count=25;}//sets the number of posts to show based on MySQL LIMIT

$html="";
if($level>100){//if level is high enough show other users
	$u=$admin->getUserRange($start,$count);
	$html.="<h3>Other Users</h3>
			<form action='actions/deleteUsers.php' method='post'>";
//build post table
		$showArray=array('Name','Email','Created','Permissions');
		$html .= '<table class="realtable"><tr>';
		foreach($showArray as $e){
			$html .= '<td><em>'. $e .'</em></td>';
		}
		$html .= '</tr>';
		foreach($u as $row){
			$id=$row['ID'];
			$html .= "<tr>";
			foreach($showArray as $f){
				$disp=$row[$f];
				if($f=='Name'){$disp="<a href='userForm.php?ID=$id'>$disp</a>";}
				$html .= '<td>'. $disp .'</td>';
			}
			$html .= "<td><input type='checkbox' name='selected[]' value='$id'/></td></tr>";
		}
		$html .= '</table>';
		$html.= "<br><input type='submit' value='Delete Selected'/>
				<button type='reset'>Clear Selection</button></form>";
}//end if
		
?>

<div class="cp_body" id="userPage">
	<?php print_r($_SESSION); ?>
	<h2>Users</h2>
	<h3>Current User</h3>
	<table class="realtable">
		<tr><td><em>Name</em></td><td><em>Email</em></td><td><em>Created</em></td><td><em>Permissions</em></td></tr>
		<tr>
			<td><?php echo $_SESSION['uName'];?></td>
			<td><?php echo $_SESSION['uEmail'];?></td>
			<td><?php echo $_SESSION['uCreated'];?></td>
			<td><?php echo $_SESSION['uLvl'];?></td>
		</tr>
	</table>
	<a href='userForm.php?ID=<?php echo $_SESSION['uID'];?>'>Edit Profile/Password</a><br><!--when you go here remember o check for permissions-->
	
	<?php echo $html;//if valid permissions show other users ?>
	
	
	
</div><!--end postPage-->

<?php include 'cp_footer.php';
?>