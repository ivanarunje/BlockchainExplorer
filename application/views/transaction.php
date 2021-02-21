<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header');
?>

<div class="container" style="margin-top:50px;">
  <div class="row">
    <h4>Transaction Details</h4>
    <table class="table table-bordered" id="transaction_detail_table">
      <tbody>
      <tr>
        <th>Hash</th>
        <td><?php echo $transaction['txid']?></td>
      </tr>
      <tr>
        <th>Status</th>
        <td><?php echo $transaction['status']?></td>
      </tr>
      <tr>
        <th>Size</th>
        <td><?php echo $transaction['size']?> bytes</td>
      </tr>
      <tr>
        <th>VSize</th>
        <td><?php echo $transaction['vsize']?> bytes</td>
      </tr>
      <tr>
        <th>Weight</th>
        <td><?php echo $transaction['weight']?></td>
      </tr>
      <tr>
        <th>Included in Block</th>
        <td><?php echo $transaction['blockhash']?></td>
      </tr>
      <tr>
        <th>Confirmations</th>
        <td><?php echo $transaction['confirmations']?></td>
      </tr>
      <tr>
        <th>Inputs</th>
        <td><?php echo count($transaction['vin'])?></td>
      </tr>
      <tr>
        <th>Outputs</th>
        <td><?php echo count($transaction['vout'])?></td>
      </tr>
      <tr>
        <th>Total Input</th>
        <td><?php echo number_format($transaction['totalInput'],8);?> BTC</td>
      </tr>
      <tr>
        <th>Total Output</th>
        <td><?php echo number_format($transaction['totalOutput'],8);?> BTC</td>
      </tr>
      <tr>
        <th>Fees</th>
        <td><?php echo number_format($transaction['fee'],8);?> BTC</td>
      </tr>
      </tbody>
    </table>
  </div>

  <h4 style="margin-top:50px;"><i class="fa fa-angle-double-right"></i> INPUTS</h4>
  <?php for($i=0; $i<count($transaction['vin']);$i++){ ?> 
  <div id="div_detail_Table">
    <table id="detail_table" class="table table-sm table-borderless">
      <tbody>
        <tr>
          <th scope="row">Index</th>
          <td><?php echo $i?></td>
        </tr>
        <tr>
          <th scope="row">Address</th>
          <td><?php echo $transaction['prev_output'][$i]['scriptPubKey']['addresses'][0]?></td>
        </tr>
        <tr>
          <th scope="row">Value</th>
          <td><?php echo number_format($transaction['prev_output'][$i]['value'], 8); ?></td>
        </tr>
        <tr>
          <th scope="row">Pkscript</th>
          <td><?php echo str_replace("0</br>","OP_0</br>",str_replace(" ","</br>", $transaction['prev_output'][$i]['scriptPubKey']['asm']))?></td>
        </tr>
        <tr>
          <th scope="row">Sigscript</th>
          <td><?php echo str_replace("[ALL]","01",$transaction['vin'][$i]['scriptSig']['asm'])?></td>
        </tr>
        <tr>
          <th scope="row">Witness</th>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php }?>

  <h4 style="margin-top:50px;"><i class="fa fa-angle-double-left"></i> OUTPUTS</h4>
  <?php $i=0; ?>
  <?php foreach($transaction['vout'] as $output): ?>
  <div id="div_detail_Table2">
    <table id="block_trans_table" class="table table-sm table-borderless">
      <tbody>
        <tr>
          <th scope="row">Index</th>
          <td><?php echo $i?></td>
        </tr>
        <tr>
          <th scope="row">Address</th>
          <td><?php 
                $scriptPubkey = $output['scriptPubKey'];
                if(array_key_exists('addresses', $scriptPubkey) == true)
                {
                    echo $output['scriptPubKey']['addresses'][0];
                }
                else
                { 
                    echo "";
                }?>
          </td>
        </tr>
        <tr>
          <th scope="row">Value</th>
          <td><?php echo number_format($output['value'],8);?> BTC</td>
        </tr>
        <tr>
          <th scope="row">Pkscript</th>
          <td><?php echo str_replace("0</br>","OP_0</br>",str_replace(" ","</br>",$output['scriptPubKey']['asm']));?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php $i++; ?>
  <?php endforeach; ?>

</div>

</body>
</html>