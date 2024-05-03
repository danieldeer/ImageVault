
<?php
$target_dir = $_POST["key"];
$target_file = "uploads" . DIRECTORY_SEPARATOR . $target_dir . DIRECTORY_SEPARATOR . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
}

?>

