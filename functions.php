<?php 
include 'config.php';
function createTemporaryTable($db) {
    $sql = "CREATE TABLE IF NOT EXISTS temporary_completedata (
        S_No INT,
        TransactionDate DATE,
        AcademicYear VARCHAR(10),
        Session VARCHAR(50),
        AllotedCategory VARCHAR(50),
        VoucherType VARCHAR(50),
        VoucherNumber VARCHAR(50),
        RollNumber VARCHAR(50),
        Admno VARCHAR(50),
        Status VARCHAR(50),
        FeeCategory VARCHAR(50),
        Faculty VARCHAR(100),
        Program VARCHAR(100),
        Department VARCHAR(100),
        Batch VARCHAR(100),
        ReceiptNumber VARCHAR(100),
        FeeHead VARCHAR(100),
        DueAmount DECIMAL(20,2),
        PaidAmount DECIMAL(20,2),
        ConcessionAmount DECIMAL(20,2),
        ScholarshipAmount DECIMAL(20,2),
        ReverseConcessionAmount DECIMAL(20,2),
        WriteoffAmount DECIMAL(20,2),
        AdjustedAmount DECIMAL(20,2),
        RefundAmount DECIMAL(20,2)
    )";

    if ($db->query($sql) === TRUE) {
        echo "Temporary table created successfully.<br>";
    } else {
        echo "Error creating table: " . $db->error . "<br>";
    }
    $db->query("TRUNCATE TABLE temporary_completedata");
}
function importCSVData($db, $file) {
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[0] === 'S.No') continue; // Skip header

            $sql = "INSERT INTO temporary_completedata 
                (TransactionDate, AcademicYear, Session, AllotedCategory, VoucherType, VoucherNumber, RollNumber, Admno, Status, FeeCategory, Faculty, Program, Department, Batch, ReceiptNumber, FeeHead, DueAmount, PaidAmount, ConcessionAmount, ScholarshipAmount, ReverseConcessionAmount, WriteoffAmount, AdjustedAmount, RefundAmount)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssssssssssssssssssssssss', $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], $data[19], $data[20], $data[21], $data[22], $data[23], $data[24]);
            if (!$stmt->execute()) {
                echo "Error importing data: " . $stmt->error . "<br>";
                fclose($handle);
                return false;
            }
        }

        fclose($handle);
        return true;
    } else {
        return false;
    }
}
?>
