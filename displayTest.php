<!DOCTYPE HTML>
<head>
	<title>uDuck Accessor test</title>
</head>
<body>
<?php
require_once "uDuck.php";
$cms= new UDuck();
$posts=$cms->getAllPosts();
print_r($posts);
?>
</body>
</html>


