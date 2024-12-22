
<?php 
	include "models/OrdersModel.php";
	class OrdersController extends Controller{
		use OrdersModel;
		public function index() {
		    $recordPerPage = 25;
		    $numPage = ceil($this->modelTotal() / $recordPerPage);
		    $listRecord = $this->modelRead($recordPerPage);
		    // Gọi nhiều view mà không ghi đè nội dung
		    $this->loadView("OrdersView.php", ["listRecord" => $listRecord, "numPage" => $numPage], true);
}

		//xac nhan da giao hang
		
		public function delivery(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$this->modelDelivery($id);
			//di chuyen den trang danh sach cac ban ghi
			echo "<script>location.href='index.php?controller=orders';</script>";
		}	
		public function delivery1(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$this->modelDelivery1($id);
			//di chuyen den trang danh sach cac ban ghi
			echo "<script>location.href='index.php?controller=orders';</script>";
		}	
		public function cancel(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$this->modelCancel1($id);
			//di chuyen den trang danh sach cac ban ghi
			echo "<script>location.href='index.php?controller=orders';</script>";
		}	
		



		

		
		//chi tiet don hang
		public function detail(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham tu model de thuc hien
			$data = $this->modelListOrderDetails($id);
			//load view
			$this->loadView("OrderDetailView.php",["data"=>$data,"id"=>$id]);
		}
	}
 ?>