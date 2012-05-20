<!DOCTYPE HTML>
<head>
	<title>uDuck Accessor test</title>
</head>
<body>
<?php
require_once "uDuck.php";
$start=microtime(true);
$cms= new UDuck();
$posts=$cms->getAllPosts();
echo "<br><br><pre>";
print_r($posts);

print_r($cms->getPostByID(2));
echo "<br><br>";
print_r($cms->getGroupByID(1));

$end=microtime(true)-$start;
echo "$end secs </pre>"; 

?>
</body>
</html>


