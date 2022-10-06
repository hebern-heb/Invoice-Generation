<?php 

include('inc/header.php');
include 'Invoice.php';
$invoice = new Invoice();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$invoice_id= $invoice->saveInvoice($_POST);

	header("Location:index.php");	
}
?>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">

<div class="container content-invoice">
	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h2 class="title" style="text-align: center;"> Invoice System</h2>
					 <a href="index.php"  class="btn btn-info" style="color: #edf7ff"> Invoice List</a>

				</div>		    		
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>From,</h3>
					<?php echo 'ABC'; ?><br>	
					<?php echo 'XYZ COMPANY'; ?><br>	
					<?php echo '8787878778'; ?><br>
					<?php echo 'xyz@gmail.com'; ?><br>	
				</div>      		
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
					<h3>To,</h3>
					<div class="form-group">
						<input type="text" class="form-control" required name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" required name="address" id="address" placeholder="Your Address"></textarea>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="2%"></th>
							<th width="30%"> Name</th>
							<th width="10%">Quantity</th>
							<th width="15%">Unit Price</th>								
							<th width="30%">Tax</th>
							<th width="20%">Total</th>

						</tr>							
						<tr class="all">
							<td class="itemRow"></td>
							

							<td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>			
							<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
							<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
							<td> 
								<div class="input-group">
								<div class="input-group-addon">
									<select name="taxType[]" id="taxType_1">
										<option value="">Select</option>
										<option value="0">0%</option>
										<option value="1">1%</option>
										<option value="5">5%</option>
										<option value="10">10%</option>
									</select>
								</div>
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount_1" placeholder="Tax Amount">
							</div>
							</td>
							<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
						</tr>						
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="margin-left: 50%;">

					<button class="btn btn-info" id="addRows" type="button"> Add More</button>
				</div>
			</div>
			<div class="row">	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					
					<div class="form-group">
						<input type="hidden" value="<?php echo 1 ?>" class="form-control" name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-sm btn-success">						
					</div>
					
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal (without tax): &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Subtotal Without Tax">
							</div>
						</div>	
						<div class="form-group">
							<label>Tax amount: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="tax_amnt" id="tax_amnt" placeholder="Tax amount">
							</div>
						</div>
						
						
						<div class="form-group">
							<label>Subtotal (with tax): &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
							</div>
						</div>

						
						<div class="form-group">
									
							<div class="input-group">
								<label>Discount: &nbsp;</label>

								<div class="input-group-addon currency">
									<select name="discount_type" id="discount_type" >
									<option value="">Select</option>

									<option value="percentage">%</option>
									<option value="amount">$</option>
								</select>
								</div>
								<input value="" type="number" class="form-control" name="discount" id="discount" placeholder="Discount">
							</div>
						</div>
											
						<div class="form-group">
							<label>Discounted Amount: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="discountedAmount" id="discountedAmount" placeholder="Total">
							</div>
						</div>
						
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
							</div>
						</div>
					</span>
				</div>
			</div>
			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>	
<?php include('inc/footer.php');?>