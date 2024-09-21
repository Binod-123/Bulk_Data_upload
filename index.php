<?php
include 'config.php';

?>
<!-- Import Form -->
<form action="submit.php" method="POST" enctype="multipart/form-data">
    <label for="csvFile">Upload CSV file:</label>
    <input type="file" name="csvFile" id="csvFile" required>
    <button type="submit">Upload</button>
</form>
