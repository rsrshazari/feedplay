<?php $this->load->view('header') ?>
<style media="screen">
    .d-print-thermal{display: none;}
</style>
      <div class="main-content">
      <section class="section" id="print-area">
        <div class="section-body">
        <div class="invoice" style="border:1px solid #dee2e6;padding:25px;margin:20px 0;">
        <div class="invoice-print">
        <div class="row">
          <h4 class="d-print-thermal "><?= $store->store_name ?></h4>
        <div class="col-lg-12 ">
        <div class="invoice-title d-print-none-thermal">
        <h5>Order #<?= $order_details->id ?></h5>
        <div class="invoice-number" style="margin-top:-35px;">   <?= date("d-m-Y", strtotime($order_details->ordered_at)) ?></div>
        </div>
        <br class="d-print-none-thermal">
        <div class="row d-print-none-thermal">
        <div class="col-6">
        <address>
        <strong>Bill to:</strong><br><br>
        <?= $order_details->buyer_first_name . ' ' . $order_details->buyer_last_name ?><br>
        <?= $order_details->buyer_address ?><br>
        <?= $order_details->buyer_city ?>-<?= $order_details->buyer_zip ?><br>
        <?= $order_details->buyer_country ?><br>
        <?= $order_details->buyer_email ?><br>
        <?= $order_details->buyer_mobile ?><br>

        </address>
        </div>
        <div class="col-6 text-right">
        <address>
        <strong>Seller:</strong><br><br>
        <a href="#"><?= $store->store_name ?></a><br>
        <?= $store->store_address ?><br><?= $store->store_city ?><br><?= $store->store_state?> <?= $store->store_zip ?><br><?= $store->store_country ?><br>
        </address>
        </div>
        </div>
        <div class="d-print-thermal">
          <div class="d-print-thermal ">
            <h5>#<?= $order_details->id ?> (   <?= date("d-m-Y", strtotime($order_details->ordered_at)) ?>)</h5>
          </div>
          <div class="d-print-thermal ">
          <p class="section-lead m-0 text-center small">
            <?= $store->store_name ?><br>
              <?= $store->store_address ?><br><?= $store->store_city ?> <?= $store->store_state?> <?= $store->store_country ?><br>
          </p>
          <br>
          <p class="section-lead m-0 text-left">
          Customer : <?= $order_details->bill_first_name . ' ' . $order_details->bill_last_name ?><br>
          </p>
          </div>
        </div>
        </div>
        </div>
        <div class="row ">
        <div class="col-md-12">
          <span class="d-print-thermal ">
          <table>
          <thead>
          <tr>
          <th class="description">Item</th>
          <th class="price">Price</th>
          </tr>
          </thead>
          <tbody>
            <?php
            $c=1;
            foreach ($order as $row1) {
            ?>
            <tr>
            <td class="description"><?=$row1->product_name?> (<?=$row1->quantity?>)<br><small><small class="text-muted">dfg</small></small></td>
            <td class="price">₹ <?= $row1->unit_price ?></td>
            </tr>
          <?php $c++;} ?>
          </tbody>
        </table>
          </span>
        <span class="d-print-none-thermal">
          <?php
          $count=1;
          $total_amount;
          foreach ($order as $row) {
           $total_amount +=$row->unit_price * $row->quantity;
          ?>
      <ul class="list-unstyled list-unstyled-border mb-2">
      <li class="media align-items-center">
      <a href="#" class="d-print-none-thermal d-print-none">
      <img src="https://store.qpe.co.in/upload/ecommerce/<?= $row->thumbnail?>" alt="<?= $row->thumbnail?>" width="50" height="50"><br>
      </a>
      <div class="media-body">
      <div class="media-right font-14 text-dark">₹ <?= $row->unit_price * $row->quantity?></div>
      <div class="media-title mb-0 font-14"><a href="#"><?=$row->product_name?></a> <span class="text-primary text-small"> </span></div>
      <div class="text-small">₹<?=$row->unit_price?>x<?=$row->quantity?><br><small class="text-muted">small</small></div>
      </div>
      </li>
    <?php $count++; } ?>
      </ul>
    </span>

    </div>
    </div>
        <div class="row">
        <div class="col-7 d-print-none-thermal">
      <div class="section-title">Order status</div>
      <p class="section-lead ml-0"><span class="text-danger"><i class="fas fa-spinner"></i> <?=$order_details->status?></span><br><?=$order_details->payment_method?> </p>
      <div class="section-title">Deliver to</div>
      <p class="section-lead ml-0">
      <?= $order_details->buyer_first_name . ' ' . $order_details->buyer_last_name ?><br><?= $order_details->buyer_email ?><small></small>
      </p>
      </div>
        <div class="col-5 text-right">
        <div class="invoice-detail-item" style="margin-top: 20px;">
        <div class="invoice-detail-name">Subtotal</div>
        <div class="invoice-detail-value">₹ <?= $order_details->subtotal?></div>
        </div>
        <div class="invoice-detail-item">
    <div class="invoice-detail-name">Delivery charge</div>
    <div class="invoice-detail-value">₹<?= $order_details->shipping?></div>
    </div>
    <div class="invoice-detail-item">
    <div class="invoice-detail-name">Tax</div>
    <div class="invoice-detail-value">₹<?= $order_details->tax?></div>
    </div>


      <hr class="mt-2 mb-2">
      <div class="invoice-detail-item">
      <div class="invoice-detail-name">Total</div>
      <div class="invoice-detail-value">₹ <?= $order_details->payment_amount?></div>
      </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <section>
        </div>
        <div class="row mb-10 d-print-none-thermal">
          <div class="col-md-12">
          <div class="text-md-right">
            <div class="float-lg-left mb-lg-0 mb-3">
              <!-- <button class="btn btn-dark btn-icon icon-left"><i class="fa-regular fa-file-invoice-dollar"></i> Pdf Download</button> -->

            </div>
             <div class="btn-group" role="group" aria-label="">
              <button type="button" id="large-print" class="btn-sm btn btn-outline-primary print-options no_radius">Large A4</button>
              <button type="button" id="thermal-print" class=" btn-sm btn btn-outline-primary print-options no_radius">Thermal 80mm</button>
              <button type="button" id="mobile-print" class=" btn-sm btn btn-outline-primary print-options no_radius">Thermal 57mm</button>
              </div>
          </div>
         </div>
         </div>




<?php $this->load->view('footer') ?>
<script>
        $(document).ready(function () {
        $(".print-options").click(function () {
            var id  = $(this).attr('id');
             var contents = $("#print-area").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({ "position": "absolute", "top": "-1000000px" });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.

            //Append the external CSS file.
            if(id=="mobile-print")
              frameDoc.document.write('<link href="<?php echo base_url();?>assets/css/print/ecommerce-thermal-mobile-print.css" rel="stylesheet" type="text/css" />');
            else if(id=="thermal-print")
              frameDoc.document.write('<link href="<?php echo base_url();?>assets/css/print/ecommerce-thermal-print.css" rel="stylesheet" type="text/css" />');
            else frameDoc.document.write('<link href="<?php echo base_url();?>assets/css/print/ecommerce-print.css" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 1000);


        });
        });
</script>
