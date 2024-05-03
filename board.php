<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<a href="index.php">Home</a>
<h1>Posts for key: <?php echo $_REQUEST["key"]?></h1>

Add your own post:
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
Select an image:
<input type="file" name="fileToUpload" id="fileToUpload"><br>
<input type="submit" value="Upload Image" name="submit"><br>
<input type="hidden" name="key" value="<?php echo $_REQUEST["key"]?>">
<br>

Posts:
<?php

$key = $_REQUEST["key"];


if(!file_exists("uploads/$key")){
	mkdir("uploads/$key");	
}

$images = scandir("uploads/$key");
echo '<div class="posts">';
foreach($images as $image)
{
	$image_path_abs = "uploads/$key/$image";

	// Check if file is an image:
	if(is_dir($image_path_abs) || !getimagesize($image_path_abs))
	{
		continue;
	}
	//TODO: Print title of image. echo $image_path_abs . "<br>";
	echo('<img src="' . $image_path_abs . '" width="250px;"><br>');
}
echo "</div>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$target_dir = $_POST["key"];
$target_file = "uploads" . DIRECTORY_SEPARATOR . $target_dir . DIRECTORY_SEPARATOR . time() . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;                                                                                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        echo $_FILES["fileToUpload"]["tmp_name"];
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists:
if (file_exists($target_file))
{
        echo "Sorry, file already exists.";
}

if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
{
	echo "The file has been uploaded to: $target_file";
	// refresh the page:
	$page = $_SERVER['PHP_SELF'] . "?key=$key";
	header("Refresh:0; url=$page");
}
}
?>

</body>
</html>

