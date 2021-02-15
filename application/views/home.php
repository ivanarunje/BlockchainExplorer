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

    <table style="border:2px solid black;">
        <tr>
          <th>Height</th>
          <th>Mined</th>
          <th>Size</th>
        </tr>
    <?php foreach($blocks as $row):?> 
            <tr>
                <td><a href="#"><?=$row['height'];?></a></td>
                <td><?=floor((time()-$row['time'])/60);?>minutes ago&nbsp;&nbsp;</td>
                <td><?=$row['size'];?>bytes</td>
            </tr>
    <?php endforeach;?>
    </table>
  </body>
</html>