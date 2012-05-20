<?php require_once 'actions/Act.php';
include 'cp_header.php';

?>

<div class='cp_body' id='postbody'>
<?php echo Act::listFromTable('post',array('ID','Title','Author','Caption'));?>	

</div>
<?php include 'cp_footer.php'; ?>
