<?php 
	//load file layout.php
	$this->layoutPath = "Layout.php";
 ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?controller=users&action=create" class="btn btn-primary">Thêm mới </a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Danh sách người dùng </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Họ và tên </th>
                    <th>Email</th>
                    <th style="width:120px;"></th>
                </tr>
                <?php foreach($data as $rows): ?>
                <tr>
                    <td><?php echo $rows->name ?></td>
                    <td><?php echo $rows->email ?></td>
                    <td style="text-align:center; display: flex;">
                        <a style="border: 1px solid #ccc; padding: 3px 5px; color: #fff; background: blue;" 
                        href="index.php?controller=users&action=update&id=<?php echo $rows->id; ?>">Update</a>&nbsp;
                        <a style="border: 1px solid #ccc; padding: 3px 5px; color: #fff; background: red;" 
                        href="index.php?controller=users&action=delete&id=<?php echo $rows->id; ?>" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            	<?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
            	<li class="page-item disabled"><a href="#" class="page-link">Trang</a></li>
            	<?php for($i = 1; $i <= $numPage; $i++): ?>
            	<li class="page-item"><a href="index.php?controller=users&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
            	<?php endfor; ?>
            </ul>
        </div>
    </div>
</div>