<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header');
$fee_roward_total = 0;
?>

<div class="container" style="margin-top:50px;">
  <div class="row">
    <h4>Block <?php echo $block['height']?></h4>
    <table class="table table-bordered" id="block_detail_table">
      <tbody>
      <tr>
        <th>Hash</th>
        <td><?php echo $block['hash']?></td>
      </tr>
      <tr>
        <th>Confirmations</th>
        <td><?php echo $block['confirmations']?></td>
      </tr>
      <tr>
        <th>Timestamp</th>
        <td><?php echo date("Y-m-d  G:i", $block['time'])?></td>
      </tr>
      <tr>
        <th>Height</th>
        <td><?php echo $block['height']?></td>
      </tr>
      <tr>
        <th>Number of Transactions</th>
        <td><?php echo $block['nTx']?></td>
      </tr>
      <tr>
        <th>Difficulty</th>
        <td><?php echo $block['difficulty']?></td>
      </tr>
      <tr>
        <th>Merkle root</th>
        <td><?php echo $block['merkleroot']?></td>
      </tr>
      <tr>
        <th>Version</th>
        <td><?php echo "0x".dechex($block['version'])?></td>
      </tr>
      <tr>
        <th>Bits</th>
        <td><?php echo hexdec($block['bits'])?></td>
      </tr>
      <tr>
        <th>Weight</th>
        <td><?php echo $block['weight']?></td>
      </tr>
      <tr>
        <th>Size</th>
        <td><?php echo $block['size']?> bytes</td>
      </tr>
      <tr>
        <th>Nonce</th>
        <td><?php echo $block['nonce']?></td>
      </tr>
      <tr>
        <th>Fee Reward</th>
        <td><?php echo number_format($total_fee, 8). " BTC"?></td>
      </tr>
      </tbody>
    </table>
  </div>

  
  <h4 class="text-center" style="margin-top:50px;">BLOCK TRANSACTIONS</h4>
  <?php foreach($complete_info as $txid => $txdata):?> 
  <div id="div_block_trans_Table">
    <table id="block_trans_table" class="table table-sm table-borderless">
      <tbody>
        <tr>
          <th scope="row">Hash</th>
          <td><?=$txid;?></td>
        </tr>
        <tr>
          <th scope="row">From</th>
          <td><?php
              $sum_in = 0;
              foreach ($txdata[0] as $data)
              {
                foreach($data as $address => $value)
                {
                  $sum_in+=$value;
                  echo $address."</br>";
                  if($address != "COINBASE")
                  {
                    echo number_format($value, 8) . "</br>";
                  }
                  else
                  {
                    echo "0.00000000";
                  }
                }
              }?> BTC</td>
        </tr>
        <tr>
          <th scope="row">To</th>
          <td><?php
                $sum_out = 0;
                foreach ($txdata[1] as $data)
                {
                foreach($data as $address2 => $value)
                {
                  $sum_out+=$value;
                  echo $address2."</br>";
                  echo number_format($value, 8) ."</br>";
                }
              }?> BTC
          </td>
        </tr>
        <tr>
          <th scope="row">Fee</th>
          <td><?php if($address != "COINBASE")
              {
                $fee = number_format(($sum_in - $sum_out), 8);
                echo $fee;
                $fee_roward_total += $fee;
              }else{
                echo "0.00000000 BTC";
              }
            ?>
          </td>
        </tr>
        <tr>
          <th scope="row">Amount</th>
          <td class="btn btn-success float-right"><?php echo $sum_out;?> BTC</td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php endforeach;?>
</div>

</body>
</html>