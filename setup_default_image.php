<?php
// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define paths - adjusted for the correct project structure
$uploadsDir = __DIR__ . '/uploads';
if (!is_dir($uploadsDir)) {
    // Try to create relative to the admin directory
    $uploadsDir = dirname(__FILE__) . '/uploads';
}

$defaultImagePath = $uploadsDir . '/default.jpg';

// Create uploads directory if it doesn't exist
if (!file_exists($uploadsDir)) {
    if (!mkdir($uploadsDir, 0755, true)) {
        die("Failed to create uploads directory at: " . $uploadsDir);
    }
    echo "Created uploads directory successfully at: " . $uploadsDir . "\n";
}

// Create a simple default image if it doesn't exist
if (!file_exists($defaultImagePath)) {
    // Create a 200x200 image
    $image = imagecreatetruecolor(200, 200);
    
    // Make the background light gray
    $bgColor = imagecolorallocate($image, 240, 240, 240);
    imagefill($image, 0, 0, $bgColor);
    
    // Add some text
    $textColor = imagecolorallocate($image, 100, 100, 100);
    $text = "No Image";
    
    // Use basic text since we might not have access to fonts
    $x = (200 - (strlen($text) * 5)) / 2;
    $y = 100;
    imagestring($image, 5, $x, $y, $text, $textColor);
    
    // Save the image
    if (imagejpeg($image, $defaultImagePath, 90)) {
        echo "Default image created successfully at: " . $defaultImagePath . "\n";
    } else {
        die("Failed to create default image at: " . $defaultImagePath);
    }
    
    imagedestroy($image);
}

// Set proper permissions
if (chmod($defaultImagePath, 0644)) {
    echo "Permissions set successfully\n";
} else {
    echo "Warning: Could not set permissions on " . $defaultImagePath . "\n";
}

echo "Current script location: " . __FILE__ . "\n";
echo "Uploads directory: " . $uploadsDir . "\n";
echo "Default image path: " . $defaultImagePath . "\n";

// Verify the file exists and is readable
if (file_exists($defaultImagePath) && is_readable($defaultImagePath)) {
    echo "Default image exists and is readable\n";
} else {
    echo "Warning: Default image is not accessible\n";
} 