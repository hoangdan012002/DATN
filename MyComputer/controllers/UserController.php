
<?php 
	include "models/UserModel.php";
	class UserController extends Controller{
		use UserModel;
		public function index(){
			$cusId = $_SESSION['customer_id'];
			if($cusId == null){
				header('Location: index.php?controller=account&action=login');
				exit();
			}
			
			$conn = Connection::getInstance();
		
			$query = $conn->prepare("
				SELECT orders.id AS order_id, orders.cname, orders.phone, orders.address, orders.create_at, orders.status, 
					orderdetails.product_id, orderdetails.number, orderdetails.price,
					products.name, products.photo, products.price
				FROM orders
				JOIN orderdetails ON orders.id = orderdetails.order_id
				JOIN products ON orderdetails.product_id = products.id
				WHERE orders.customer_id = :customer_id
				ORDER BY orders.id DESC
			");
		
			// Bind giá trị cho tham số :customer_id trong truy vấn
			$query->bindParam(":customer_id", $cusId, PDO::PARAM_INT);
		
			// Thực thi truy vấn
			$query->execute();
		
			// Lấy kết quả truy vấn
			$orders = $query->fetchAll(PDO::FETCH_ASSOC);

		
			// Hiển thị kết quả truy vấn bằng cách truyền dữ liệu vào view
			$this->loadView("UserView.php", array("orders" => $orders));
		}
		public function cancel1(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			var_dump($id);
			//goi ham tu model de thuc hien
			$this->modelCancel1($id);
			//di chuyen den trang danh sach cac ban ghi
			echo "<script>location.href='index.php?controller=user';</script>";
		}	
	}
 ?>