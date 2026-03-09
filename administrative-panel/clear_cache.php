<?php
// Clear PHP opcode cache
echo "<h2>Cache Clearing Utility</h2>";

if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "✓ OPcache cleared successfully!<br>";
} else {
    echo "✗ OPcache not available<br>";
}

if (function_exists('opcache_invalidate')) {
    $mpdfFile = __DIR__ . '/MPDF57/mpdf.php';
    if(file_exists($mpdfFile)) {
        opcache_invalidate($mpdfFile, true);
        echo "✓ MPDF file cache invalidated<br>";
    }
}

if (function_exists('apc_clear_cache')) {
    apc_clear_cache();
    echo "✓ APC cache cleared successfully!<br>";
} else {
    echo "✗ APC not available<br>";
}

// Touch the MPDF file to update modification time
$mpdfFile = __DIR__ . '/MPDF57/mpdf.php';
if(file_exists($mpdfFile)) {
    touch($mpdfFile);
    echo "✓ MPDF file timestamp updated<br>";
}

echo "<hr>";
echo "<p><strong>Cache cleared!</strong></p>";
echo "<p>Now test the report:</p>";
echo '<ul>';
echo '<li><a href="test_report.php?AppId=76951&eid=25" target="_blank">Run Diagnostic Test</a></li>';
echo '<li><a href="print_stdprvform10.php?AppId=76951&eid=25" target="_blank">Generate PDF Report</a></li>';
echo '</ul>';
?>
