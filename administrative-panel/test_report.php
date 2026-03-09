<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing Report Generation</h2>";

// Test 1: Config file
echo "<h3>1. Testing Config File</h3>";
if(file_exists('includes/config.php')) {
    echo "✓ Config file exists<br>";
    include('includes/config.php');
    echo "✓ Config file loaded<br>";
    
    if(isset($conn1)) {
        echo "✓ Connection \$conn1 is set<br>";
        if(mysqli_ping($conn1)) {
            echo "✓ Database connection \$conn1 is active<br>";
        } else {
            echo "✗ Database connection \$conn1 failed: " . mysqli_error($conn1) . "<br>";
        }
    } else {
        echo "✗ Connection \$conn1 not set<br>";
    }
    
    if(isset($conn2)) {
        echo "✓ Connection \$conn2 is set<br>";
        if(mysqli_ping($conn2)) {
            echo "✓ Database connection \$conn2 is active<br>";
        } else {
            echo "✗ Database connection \$conn2 failed: " . mysqli_error($conn2) . "<br>";
        }
    } else {
        echo "✗ Connection \$conn2 not set<br>";
    }
} else {
    echo "✗ Config file not found<br>";
}

// Test 2: MPDF Library
echo "<h3>2. Testing MPDF Library</h3>";
if(file_exists('MPDF57/mpdf.php')) {
    echo "✓ MPDF file exists<br>";
    try {
        include("MPDF57/mpdf.php");
        echo "✓ MPDF file loaded<br>";
        
        $mpdf = new mPDF('c','A4','','',10,10,05,0,0,0);
        echo "✓ MPDF object created successfully<br>";
    } catch(Exception $e) {
        echo "✗ MPDF Error: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
    }
} else {
    echo "✗ MPDF file not found<br>";
}

// Test 3: Query with sample data
echo "<h3>3. Testing Database Query</h3>";
$testAppId = isset($_GET['AppId']) ? intval($_GET['AppId']) : 76951;
$testEid = isset($_GET['eid']) ? intval($_GET['eid']) : 25;

echo "Testing with AppId=$testAppId and ExamYear=$testEid<br>";

$sql = "SELECT * FROM tbladm_10 WHERE AppId=$testAppId and ExamYear=$testEid";
echo "Query: $sql<br>";

if(isset($conn1)) {
    $res = mysqli_query($conn1, $sql);
    if(!$res) {
        echo "✗ SQL Error: " . mysqli_error($conn1) . "<br>";
    } else {
        $row = mysqli_fetch_assoc($res);
        if(!$row) {
            echo "✗ No record found<br>";
            
            // Try to find any records
            $countSql = "SELECT COUNT(*) as cnt FROM tbladm_10";
            $countRes = mysqli_query($conn1, $countSql);
            if($countRes) {
                $countRow = mysqli_fetch_assoc($countRes);
                echo "Total records in tbladm_10: " . $countRow['cnt'] . "<br>";
            }
            
            // Try to find records with this ExamYear
            $yearSql = "SELECT COUNT(*) as cnt FROM tbladm_10 WHERE ExamYear=$testEid";
            $yearRes = mysqli_query($conn1, $yearSql);
            if($yearRes) {
                $yearRow = mysqli_fetch_assoc($yearRes);
                echo "Records with ExamYear=$testEid: " . $yearRow['cnt'] . "<br>";
            }
            
            // Show sample AppIds
            $sampleSql = "SELECT AppId, Id, ExamYear, Name FROM tbladm_10 WHERE ExamYear=$testEid LIMIT 5";
            $sampleRes = mysqli_query($conn1, $sampleSql);
            if($sampleRes && mysqli_num_rows($sampleRes) > 0) {
                echo "<strong>Sample records with ExamYear=$testEid:</strong><br>";
                echo "<table border='1' cellpadding='5'><tr><th>AppId</th><th>Id</th><th>ExamYear</th><th>Name</th></tr>";
                while($sampleRow = mysqli_fetch_assoc($sampleRes)) {
                    echo "<tr>";
                    echo "<td>" . $sampleRow['AppId'] . "</td>";
                    echo "<td>" . $sampleRow['Id'] . "</td>";
                    echo "<td>" . $sampleRow['ExamYear'] . "</td>";
                    echo "<td>" . $sampleRow['Name'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            echo "✓ Record found!<br>";
            echo "Student: " . $row['Name'] . "<br>";
            echo "Father: " . $row['FatherName'] . "<br>";
            echo "App No: PII-" . $row['Id'] . "<br>";
        }
    }
}

echo "<hr>";
echo "<p>If all tests pass, <a href='print_stdprvform10.php?AppId=$testAppId&eid=$testEid'>click here to generate the report</a></p>";
?>
