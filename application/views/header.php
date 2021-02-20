<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BlockExplorer</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/header.css">
    </head>

    <body>
    <header class="header">
        <div class="center">
            <div class="caption">
                <h2 class="title"><a href="<?php echo base_url();?>">Block Explorer</a></h2>
                <p class="text">Explore blocks and transaction on Bitcoin Testnet!</p>
                <form action="<?php echo base_url();?>index.php/HomeController/searchFunction" method="post">
                    <input type="text" class="form-control mr-1" name="inputValue" id="inputValue" placeholder="Search by transaction or block (Hash/Height)" autocomplete="off">		   
                    <button class="btn btn-light" role="button">Search</button>
                </form>
            </div>	
        </div>
    </header>