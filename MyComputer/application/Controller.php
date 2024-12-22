<?php 
	class Controller{
		//bien luu noi dung cua file doc vao
		public $view = NULL;
		//bien luu duong dan file layout
		public $layoutPath = NULL;
		//ham load file de hien thi len trang
		public function loadView($fileName, $data = NULL, $append = false) {
    if (file_exists("views/$fileName")) {
        if ($data != NULL) {
            extract($data);
        }

        // Buffer view nội dung
        ob_start();
        include "views/$fileName";
        $viewContent = ob_get_clean();

        // Thêm nội dung nếu chế độ append bật
        if ($append && isset($this->view)) {
            $this->view .= $viewContent;
        } else {
            $this->view = $viewContent;
        }
    }

    if ($this->layoutPath != NULL) {
        include "views/$this->layoutPath";
    } else {
        echo $this->view;
    }
}

		//xac thuc viec dang nhap
		public function authentication(){
			if(isset($_SESSION["email"]) == false)
				header("location:index.php?controller=login");
		}
	}
 ?>