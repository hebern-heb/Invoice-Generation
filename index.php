<?php 

include('inc/header.php');
include 'Invoice.php';
$invoice = new Invoice();
?>
<script src="js/invoice.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
	<div class="container">		
	  <h2 class="title" style="text-align: center;margin:20px; ">Invoice System</h2>

    <a href="create_invoice.php" style="float: right;color: #edf7ff" class="btn btn-info">Create Invoice</a>
	  <br><br><br>

      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col"> No.</th>
            <th scope="col">Customer</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
          <tbody>

        <?php		
		$invoiceList = $invoice->getInvoiceList();
		$i=1;
        foreach($invoiceList as $invoiceDetails){
			$invoiceDate = date("d-M-0Y, H:i", strtotime($invoiceDetails["order_date"]));
            echo '
              <tr>
                <td scope="row">'.$i.'</td>
                <td scope="row">'.$invoiceDetails["order_receiver_name"].'</td>
                <td scope="row">'.$invoiceDate.'</td>
                <td scope="row"><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Print Invoice"><span class="glyphicon glyphicon-print"></span></a></td>
              </tr>
            ';
        $i++;}       
        ?>
          </tbody>

      </table>	
</div>	
<?php include('inc/footer.php');?>