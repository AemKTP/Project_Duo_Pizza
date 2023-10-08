<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // รับค่าที่ส่งมาจาก JavaScript
    $cartId = $_POST['cartId'];
    $decrement = intval($_POST['decrement']);
    $pricePerUnit = floatval($_POST['pricePerUnit']);

    // ค้นหาข้อมูลรายการในตะกร้า
    $stmt = $conn->prepare("SELECT amount, price FROM cart WHERE cartid = ?");
    $stmt->bind_param('i', $cartId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $currentAmount = intval($row['amount']);
        $currentPrice = floatval($row['price']);

        // ตรวจสอบว่าจำนวนไม่เป็นลบและน้อยกว่าหรือเท่ากับ 1
        if ($decrement > 0 && $currentAmount > 1) {
            // ลดจำนวนชิ้นละ 1
            $newAmount = $currentAmount - $decrement;
            
            // คำนวณราคาใหม่โดยใช้จำนวนล่าสุด
            $newTotalPrice = $newAmount * $pricePerUnit;

            // อัปเดตข้อมูลในฐานข้อมูล
            $updateStmt = $conn->prepare("UPDATE cart SET amount=?, price=? WHERE cartid = ?");
            $updateStmt->bind_param('dii', $newTotalPrice, $newAmount, $cartId);
            $updateStmt->execute();

            // ส่งค่าราคาใหม่กลับไปยังเว็บไซต์เพื่ออัปเดต DOM
            $response = array(
                'success' => true,
                'newAmount' => $newAmount,
                'newPrice' => number_format($newTotalPrice, 2)
            );
            echo json_encode($response);
        } else {
            // ค่าไม่ถูกต้องหรือไม่สามารถลดจำนวนได้
            $response = array(
                'success' => false,
                'message' => 'ไม่สามารถลดจำนวนได้'
            );
            echo json_encode($response);
        }
    } else {
        // ไม่พบรายการในตะกร้า
        $response = array(
            'success' => false,
            'message' => 'ไม่พบรายการในตะกร้า'
        );
        echo json_encode($response);
    }
}
