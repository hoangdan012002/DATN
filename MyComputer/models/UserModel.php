<?php 
	trait UserModel{
			public function modelCancel1($id){
			//---
				$conn = Connection::getInstance();
				
				// Update orders status
				$updateOrderQuery = "UPDATE orders SET status = -1 WHERE id = :id";
				$stmt = $conn->prepare($updateOrderQuery);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
			
			
				// Retrieve order details
				$orderDetailQuery = "SELECT product_id, number FROM orderdetails WHERE order_id = :id";
				$stmt = $conn->prepare($orderDetailQuery);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
			
				// Process order details
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$productId = $row['product_id'];
					$quantity = $row['number'];
					// Update product quantity
					$updateProductQuery = "UPDATE products SET soluong = soluong + :quantity WHERE id = :productId";
					$stmt = $conn->prepare($updateProductQuery);
					$stmt->bindParam(':quantity', $quantity);
					$stmt->bindParam(':productId', $productId);
					$stmt->execute();
				}
			}
	}
?>