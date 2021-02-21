<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->view('header');
?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center">
                <h1>Oops!</h1>
                <h2>404 Not Found</h2>
                <div class="error-actions">
                    <a href="http://localhost/codeigniter/BlockExplorer/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>Take Me Home </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>