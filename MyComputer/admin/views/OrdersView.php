<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php"; ?>
<div class="col-md-12">    
    <div class="panel panel-primary">
        <div class="panel-heading">Danh sách đơn hàng</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr style="height: 60px">
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Date</th>                  
                    <th style="width:150px; text-align: center;">Status</th>
                    <th style="width:150px; text-align: center;">Delivery</th>
                </tr style="height: 60px">
                <?php foreach($listRecord as $rows): ?>

                <?php   
               //var_dump($listRecord); exit;
                    //lay ban ghi customer
                    $customer = $this->modelGetCustomers($rows->customer_id);
                 ?>
                 <tr style="height: 60px">
                     <td><?php echo $rows->cname; ?></td>
                     <td><?php echo $rows->phone; ?></td>
                     <td><?php echo $rows->address; ?></td>

                     <td>
                        <?php 
                        $date = Date_create($rows->create_at);
                        echo Date_format($date, "d/m/Y");
                        ?>                            
                        </td>
                     <td style="display: flex; align-items: center; justify-content: center; transform: translateY(5px);">
                        
                        <!-- <?php if($rows->status == 1): ?>
                            <span style="border: 1px solid #ccc; padding: 5px 11px; color: #fff; background: blue;" class="label label-primary">Đã giao hàng</span>
                         <?php else: ?>
                            <span style="border: 1px solid #ccc; padding: 5px 5px; color: #fff; background: blue;" class="label label-danger">Chưa giao hàng</span>
                         <?php endif; ?>
 -->
                        <?php if($rows->status == 1): ?>
                            <span style="border: 1px solid #ccc; padding: 5px 11px; color: #fff; background: blue;" class="label label-primary">Đã giao hàng</span>
                         <?php elseif($rows->status == 0): ?>
                            <span style="border: 1px solid #ccc; padding: 5px 5px; color: #fff; background: blue;" class="label label-danger">Đang đặt hàng</span>
                           
                            <?php elseif($rows->status == 2): ?>
                            <span style="border: 1px solid #ccc; padding: 5px 5px; color: #fff; background: blue;" class="label ">Đang Giao hàng</span>
                            
                        <?php else: ?>
                            <span style="border: 1px solid #ccc; padding: 5px 5px; color: #fff; background: blue;" class="label label-danger">Đã hủy </span>
                         <?php endif; ?>
                     </td>
                     <td  style="text-align: center; width: 200px; transform: translateY(5px);">
            <?php if($rows->status == -1): ?>
                <span style="color:red">Đã hủy</span>
            <?php else: ?>
                <a style=" border: 1px solid #ccc; padding: 5px 8px; color: #fff; background: blue; " href="index.php?controller=orders&action=detail&id=<?php echo $rows->id; ?>" class="label label-success">Chi tiết</a>
                <?php if($rows->status == 0): ?>
                <a style="border: 1px solid #ccc; padding: 5px 12px; color: #fff; background: blue;" href="index.php?controller=orders&action=delivery&id=<?php echo $rows->id; ?>" class="label label-info">Giao hàng</a>
                <?php elseif($rows->status == 2): ?>
                    <a style="border: 1px solid #ccc; padding: 5px 12px; color: #fff; background: blue;" href="index.php?controller=orders&action=delivery1&id=<?php echo $rows->id; ?>" class="label label-info">Hoàn thành</a>
                <?php endif; ?>
                <a style="border: 1px solid #ccc; padding: 5px 12px; color: #fff; background: blue;" href="index.php?controller=orders&action=cancel&id=<?php echo $rows->id; ?>" class="label label-danger">Hủy</a>
            <?php endif; ?>
</td>
                 </tr>
                <?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
                <li class="page-item">
                    <?php for($i = 1; $i <= $numPage; $i++): ?>
                    <a href="index.php?controller=orders&p=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </li>
            </ul>
        </div>
    </div>
</div>