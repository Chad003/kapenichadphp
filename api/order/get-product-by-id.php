<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/utils/response.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/utils/load-database.php');

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("HTTP/1.1 405 Method Not Allowed");
    echo (new ApiResponse())
        ->code(405)
        ->message('Incorrect HTTP Request Method');
    exit;
}
function get_product_by_id(PDO $pdo, $id)
{
    $sql = "
        SELECT 
        PRODUCT_ID, 
        NAME,
        CATEGORY,
        BRAND,
        MEDIUM,
        SELLING_PRICE
        FROM t_products 
        WHERE ID = ?
        LIMIT 1;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch();
}


$productId = $_GET['id'] ?? null;

if (!$productId) {
    echo (new ApiResponse())
        ->error
        ->message('Product ID is required.');
    exit;
}

try {
    $pdo = get_db_connection();
    $product = get_product_by_id($pdo, $productId);

    if (!$product) {
        echo (new ApiResponse())
            ->error
            ->message('Product not found.');
        exit;
    }

    echo (new ApiResponse())
        ->success
        ->data($product)
        ->message('Product loaded successfully.');
} catch (PDOException $e) {
    error_log('Get product error: ' . $e->getMessage());
    echo (new ApiResponse())
        ->error
        ->message('Unable to load product. Please try again later.');
}
