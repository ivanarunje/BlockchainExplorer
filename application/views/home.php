<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->view('header');
?>

<!-- TABLES for latest blocks and transactions -->
<div class="container" style="margin-top:50px;">
  <div class="row text-center">
    <h3>Latest Blocks</h3>
    <table class="table table-hover" id="block_table">
      <thead>
      <tr>
        <th scope="col">Height</th>
        <th scope="col">Mined</th>
        <th scope="col">Size</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach($blocks as $row):?> 
          <tr>
              <td><a href="<?php echo base_url();?>index.php/HomeController/getBlockInfo/<?=$row['hash'];?>" style="color:#355c7d; font-weight:bold;"><?=$row['height'];?></a></td>
              <td><?=floor((time()-$row['time'])/60);?> minutes ago</td>
              <td><?=$row['size'];?> bytes</td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  <div class="row text-center" id="transaction_table" style="margin-top:50px; margin-bottom:50px;">
    <h3>Latest Transactions</h3>
    <table class="table table-hover" id="transactions_table">
      <thead>
      <tr>
        <th scope="col">Hash</th>
        <th scope="col">Time</th>
        <th scope="col">Size</th>
        <th scope="col">Fee (BTC)</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach($transactions as $key => $row):?> 
          <tr>
              <td><a href="<?php echo base_url();?>index.php/HomeController/getTransactionInfo/<?=$key;?>" style="color:#355c7d; font-weight:bold;"><?=$key;?></a></td>
              <td><?=date("G:i",$row['time']);?></td>
              <td><?=$row['size'];?> bytes</td>
              <td><?=number_format($row['fee'],8);?></td>
          </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>