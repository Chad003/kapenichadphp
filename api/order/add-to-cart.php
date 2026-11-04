<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/utils/response.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/utils/load-database.php');

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("HTTP/1.1 405 Method Not Allowed");
    echo (new ApiResponse())
        ->code(405)
        ->message('Incorrect HTTP Request Method = '. $_SERVER['REQUEST_METHOD']);
    exit;
}

$REQUEST = json_decode(file_get_contents('php://input'), true);

$deviceFingerprint = $REQUEST['device_fingerprint'] ?? null;
$productId         = $REQUEST['product_id'] ?? null;
$quantity          = $REQUEST['quantity'] ?? 1;


if (!$deviceFingerprint || !$productId) {
    echo (new ApiResponse())
        ->error
        ->message('Invalid request data.');
    exit;
}


try {
    $pdo = get_db_connection();

    $PRODUCT = get_product_by_id($pdo, $productId);

    if (is_null($PRODUCT)) {
        echo (new ApiResponse())
            ->error
            ->message('Product does not exist.');
        exit;
    }

    $price = $PRODUCT['price'];

    $sql = "
        INSERT INTO t_cart (DEVICE_FINGERPRINT, PRODUCT_ID, QUANTITY, PRICE)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
            QUANTITY = QUANTITY + VALUES(QUANTITY),
            PRICE = VALUES(PRICE);
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deviceFingerprint, $productId, $quantity, $price]);

    echo (new ApiResponse())
        ->success
        ->data([
            "product_id" => $productId,
            "price" => $price,
        ])
        ->message('Cart update success.');
} catch (PDOException $e) {
    error_log('Cart database error: ' . $e->getMessage());

    echo (new ApiResponse())
        ->error
        ->message('Unable to update cart. Please try again later.');
}
