<?php include "cp_header.php";
	  include 'uD_admin.php';
	  $admin=new uDuck_Admin();
	  if(isset($_GET['ID']) ){
			$catvalue=$_GET['ID'];
			$c=$admin->getCategoryByID($catvalue);}
	  		//print_r($c);	}
	  else{
			$catvalue='';
			$c=Array ( 'Cat' => '','GroupName'=>'');
		}
?>
	<div class='cp_body' id='catForm'>
		<h2>Edit Category</h2>
		<form action='actions/addCat.php' method='post'>
			<table>
				<tr>
					<td>Category Name</td>
					<td><input type="text" name="cat" value='<?php echo $c['Cat'];?>'/></td>
				</tr>
				<tr>
					<td>Group Name</td>
					<td><input type="text" name="gname" value='<?php echo $c['GroupName'];?>'/></td>
				</tr>
				<tr>
					<td>ID: <input type="text" name="id" readonly="readonly" size="6" value='<?php echo $catvalue; ?>' placeholder="New Group" class="greyedout"/></td>
	
				</tr>
			</table>
			<button type='submit'>Send</button>
			<button type='reset'>Reset</button>
		</form>
	</div>

		
<?php include "cp_footer.php";?>