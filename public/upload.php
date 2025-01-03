<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Directory where the file will be saved
        $target_file = $target_dir . basename($_FILES["file"]["name"]); // Full path to the uploaded file

        // Check if the file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Error: " . $_FILES["file"]["error"];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload Form</title>
</head>
<body>

<h2>Upload a File</h2>
<!-- Form to upload a file -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="file" id="file">
    <br><br>
    Enter filename (optional):
    <input type="text" name="filename" id="filename">
    <br><br>
    <input type="submit" value="Upload File" name="submit">
</form>

</body>
</html>

