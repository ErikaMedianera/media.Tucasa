<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the correct path for the uploads directory
$adminDir = dirname(__FILE__);
$uploadsDir = $adminDir . '/uploads';

echo "Admin directory: " . $adminDir . "\n";
echo "Uploads directory path: " . $uploadsDir . "\n";

// Create uploads directory if it doesn't exist
if (!file_exists($uploadsDir)) {
    if (!mkdir($uploadsDir, 0755, true)) {
        die("Failed to create uploads directory at: " . $uploadsDir);
    }
    echo "Created uploads directory successfully at: " . $uploadsDir . "\n";
} else {
    echo "Uploads directory already exists at: " . $uploadsDir . "\n";
}

// Create a simple default image
$defaultImagePath = $uploadsDir . '/default.jpg';

if (!file_exists($defaultImagePath)) {
    // Check if GD is installed
    if (!extension_loaded('gd')) {
        die("PHP GD extension is not installed");
    }

    // Create a 200x200 image
    $image = imagecreatetruecolor(200, 200);
    
    // Make the background light gray
    $bgColor = imagecolorallocate($image, 240, 240, 240);
    imagefill($image, 0, 0, $bgColor);
    
    // Add text
    $textColor = imagecolorallocate($image, 100, 100, 100);
    $text = "No Image";
    
    // Center the text
    $x = (200 - (strlen($text) * 5)) / 2;
    $y = 95;
    imagestring($image, 3, $x, $y, $text, $textColor);
    
    // Save the image
    if (!imagejpeg($image, $defaultImagePath, 90)) {
        die("Failed to create default image at: " . $defaultImagePath);
    }
    
    imagedestroy($image);
    echo "Created default image at: " . $defaultImagePath . "\n";
    
    // Set permissions
    if (!chmod($defaultImagePath, 0644)) {
        echo "Warning: Could not set permissions on default image\n";
    }
} else {
    echo "Default image already exists at: " . $defaultImagePath . "\n";
}

// Verify everything is accessible
if (is_dir($uploadsDir) && is_readable($uploadsDir)) {
    echo "Uploads directory is accessible\n";
} else {
    echo "Warning: Uploads directory is not accessible\n";
}

if (file_exists($defaultImagePath) && is_readable($defaultImagePath)) {
    echo "Default image is accessible\n";
} else {
    echo "Warning: Default image is not accessible\n";
} 