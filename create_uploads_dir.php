<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uploads_dir = __DIR__ . '/../uploads';

// Create uploads directory if it doesn't exist
if (!file_exists($uploads_dir)) {
    if (!mkdir($uploads_dir, 0755, true)) {
        die("Error: No se pudo crear el directorio de uploads");
    }
    echo "Directorio de uploads creado correctamente\n";
} else {
    echo "El directorio de uploads ya existe\n";
}

// Create default image if it doesn't exist
$default_image = $uploads_dir . '/default.jpg';
if (!file_exists($default_image)) {
    // Create a 200x200 image
    $image = imagecreatetruecolor(200, 200);
    
    // Colors
    $bg_color = imagecolorallocate($image, 240, 240, 240); // Light gray
    $text_color = imagecolorallocate($image, 100, 100, 100); // Dark gray
    
    // Fill background
    imagefill($image, 0, 0, $bg_color);
    
    // Add text
    $text = "No Image";
    $font_size = 5;
    
    // Center the text
    $text_width = strlen($text) * imagefontwidth($font_size);
    $text_height = imagefontheight($font_size);
    $x = (200 - $text_width) / 2;
    $y = (200 + $text_height) / 2;
    
    imagestring($image, $font_size, $x, $y - $text_height, $text, $text_color);
    
    // Save image
    imagejpeg($image, $default_image, 90);
    imagedestroy($image);
    
    echo "Imagen por defecto creada correctamente\n";
} else {
    echo "La imagen por defecto ya existe\n";
}

// Set correct permissions
chmod($uploads_dir, 0755);
if (file_exists($default_image)) {
    chmod($default_image, 0644);
}

echo "Permisos establecidos correctamente\n";
?> 