<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>

  <body>
    <!-- HEADER NAVIGATION -->
    <nav class="navbar navbar-light bg-light justify-content-between" style="padding:30px 20px;">
    <i class="fa fa-btc fa-3x"><a class="navbar-brand" style="font-size:28px;">LOCK EXPLORER</a></i>
    <form class="form-inline">
      <input class="form-control mr-sm-2" style="padding:20px;" type="search" placeholder="Search by hash, txid, .." aria-label="Search" autocomplete="off">
      <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="font-size:24px"></i></button>
    </form>
    </nav>

    <!-- TABLES for latest blocks and transactions -->
    <div class="container" style="margin-top:50px;">
      <div class="row">
        <div class="col text-center">
        <h4>Latest Blocks</h4>
        <table class="table table-dark">
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
                  <td><a href="<?php echo base_url();?>index.php/HomeController/getBlockInfo/<?=$row['hash'];?>" style="color:yellow"><?=$row['height'];?></a></td>
                  <td><?=floor((time()-$row['time'])/60);?>minutes ago</td>
                  <td><?=$row['size'];?>bytes</td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        </div>
        <div class="col text-center">
        <h4>Latest Transactions</h4>
        <table class="table table-dark">
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
                  <td><a href="#" style="color:#00ccff"><?=$key;?></a></td>
                  <td><?=date("G:i",$row['time']);?></td>
                  <td><?=$row['size'];?> bytes</td>
                  <td><?=$row['fee'];?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        </div>
      </div>
    </div>

    
  </body>
  </html>