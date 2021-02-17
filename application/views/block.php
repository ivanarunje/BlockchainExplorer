<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BlockExplorer</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    </head>

  <body>
    <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">BlockExplorer</a>
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </nav>

    <div class="container" style="margin-top:50px;">
      <div class="row">
        <h4>Block <?php echo $block['height']?></h4>
        <table class="table table-bordered">
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
            <td><?php echo $block['version']?></td>
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
            <th>Block Reward</th>
            <td></td>
          </tr>
          <tr>
            <th>Fee Reward</th>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="row">
        <h4 style="margin-top:20px;">Block transactions</h4>
      </div>
        <?php foreach($block['tx'] as $transaction):?> 
        <div class="jumbotron">
            <p>Hash: <?=$transaction['txid'];?></p>
            <p>From: <?=$transaction['vout'][0]['value'];?></p>
        </div>
        <?php endforeach;?>

    </div>

  </body>
</html>