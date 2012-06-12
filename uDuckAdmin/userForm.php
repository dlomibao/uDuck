<?php 
/*userForm
 * allows the addition or editing of users 
 * must check for permissions
 * 
 */
include 'cp_header.php';
include 'uD_admin.php';
	  $admin=new uDuck_Admin();
	  $html="";
	  if(isset($_GET['ID']) ){
			if($_SESSION['uLvl']>100){
				$uservalue=$_GET['ID'];
				$u=$admin->getUserByID($uservalue);
				$protected=FALSE;
			}else{
				$uservalue=$_SESSION['uID'];
				$u=$admin->getUserByID($uservalue);
				$protected=TRUE;
			}
			
			$html.="";
		}
	  else{
	  		if($_SESSION['uLvl']>10){//this is a mess fix the level checking system going forward
				$uservalue='';
				$u=Array ( 'Name' => '','Email'=>'','Permissions' => '1');}
			$protected=!($_SESSION['uLvl']>100);//if the user level is too low set permissions to min
		}
	  
 ?>

	<div class='cp_body' id='userForm'>
	
	<h2>Edit User</h2>
	<form action='actions/addUser.php' method='post'>
	<table>
	<tr>
		<td>User Name:</td>
		<td colspan=2> <input type="text" name="user" value='<?php echo $u['Name']; ?>' placeholder="Enter user name here..."size=90 /></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td colspan=2><input type="text" name="email" value='<?php echo $u['Email']; ?>' placeholder="Enter email address here..." size=90 /></td>
	</tr>
	<tr>
		<td> Permissions</td>
		<td colspan=2><input type="text" name="permissions" value='<?php echo $u['Permissions']; if($protected){echo " ' readonly='readonly' class='greyedout";} ?>'  size=90 /></td><!--messy!-->
	</tr>
	<tr>
		<td <?php if($uservalue==''){echo "style='display: none'";}?>><button id="pwbutton" type="button" onClick="toggle();">Change Password</button></td>
	</tr>
	<tbody id="passhide" <?php if($uservalue>0){echo "style='display: none'";}?>>
	<tr <?php if($uservalue==''){echo "style='display: none'";}?> >
		<td>Current Password</td>
		<td><input type="password" name="pwordcurr" <?php if($uservalue==''){echo "disabled='disabled'";}?>></td>
	</tr>
	<tr>
		<td>New Password</td><!--be careful to make sure I don't overwrite anything without current password-->
		<td><input type="password" name="pword" ></td>
	</tr>
	<tr>
		<td>New Password Verify</td>
		<td><input type="password" name="pwordv"></td>
	</tr>
	</tbody>
	<tr>
		<td>ID: <input type="text" name="id" readonly="readonly" size="6" value='<?php echo $uservalue; ?>' placeholder="New User" class="greyedout"/></td>
	</tr>
	</table>
	<br>
	<button type='submit'>Send</button>
	<button type='reset'>Reset</button>
	</form>
	</div>
	
	<script>
		function toggle() {
		 if( document.getElementById("passhide").style.display=='none' ){
		   document.getElementById("passhide").style.display = '';
		   document.getElementById("pwbutton").innerHTML="Don't Change Password";
		   
		   
		 }else{
		   document.getElementById("passhide").style.display = 'none';
		    document.getElementById("pwbutton").innerHTML="Change Password";
		 }
		}
		</script>
<?php include 'cp_footer.php'; ?>