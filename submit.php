<?php 
include 'functions.php';
if (isset($_FILES['csvFile']['tmp_name'])) {
    $file = $_FILES['csvFile']['tmp_name'];

    // Step 1: Create the temporary table
    createTemporaryTable($db);

    // Step 2: Import the CSV data into the temporary table
    $importResult = importCSVData($db, $file);

    // If import is successful, proceed with verification and distribution
    if ($importResult) {
        echo "Data successfully imported!<br>";

        // Step 3: Verify the imported data
        verifyData($db);

        // Step 4: Distribute the data to final tables
        distributeData($db);
        
        echo "Data distribution completed!";
    } else {
        echo "Data import failed.";
    }
} else {
    echo "No file uploaded.";
}
?>