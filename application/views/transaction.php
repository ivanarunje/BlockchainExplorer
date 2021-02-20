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
    <div class="row">
        <h4 style="margin-top:20px;">INPUTS</h4>
    </div>
    <div class="jumbotron">
    <?php for($i=0; $i<count($transaction['vin']);$i++){ ?>
        <div>
            <p>Index: <?php echo $i?></p>
            <p>Address: <?php echo $transaction['prev_output'][$i]['scriptPubKey']['addresses'][0]?></p>
            <p>Value: <?php echo $transaction['prev_output'][$i]['value']?> BTC</p>
            <p>Pkscript: <?php echo $transaction['prev_output'][$i]['scriptPubKey']['asm']?></p>
            <p>Sigscript:<?php echo str_replace("[ALL]","01",$transaction['vin'][$i]['scriptSig']['asm'])?></p>
        </div>
        <hr>
        <?php }?>
    </div>
    <div class="row">
        <h4 style="margin-top:20px;">OUTPUTS</h4>
    </div>
    <div class="jumbotron">
    <?php $i=0; ?>
    <?php foreach($transaction['vout'] as $output): ?>
        <div>
            <p>Index: <?php echo $i?></p>
            <p>Address: <?php 
                $scriptPubkey = $output['scriptPubKey'];
                if(array_key_exists('addresses', $scriptPubkey) == true)
                {
                    echo $output['scriptPubKey']['addresses'][0];
                }
                else
                { 
                    echo "";
                }?></p>
            <p>Value: <?php echo $output['value']?> BTC</p>
            <p>Pkscript: <?php echo $output['scriptPubKey']['asm']?></p>
        </div>
        <?php $i++; ?>
        <hr>
    <?php endforeach; ?>
    </div>
</div>

</body>
</html>