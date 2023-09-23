<?php include '../Controller/parser.php';?>
<div class="container1" style="display:flex">
<?php include 'dashboard.php' ?>
<link rel="stylesheet" href="../Media/css/parser.css">
        <div class="column">
        <form method="POST">
            <div class="container" style="margin-top:100px;">
            <form id="parser-form">
                <input type="hidden" name="form_type" value="product">
                <div class="form-group">
                <div class="<?php echo (!empty($success_msg)) ? 'alert alert-success' : ''; ?>"><?= $success_msg ?></div>
                <div class="<?php echo (!empty($error_msg)) ? 'alert alert-danger' : ''; ?>"><?= $error_msg ?></div>
                <div class="<?php echo (!empty($alert_msg)) ? 'alert alert-danger' : ''; ?>"><?= $alert_msg ?></div>
                <label for="url-input">Enter product URL:</label>
                <input name='url' type="url" class="form-control" id="url-input" placeholder="" required>
                </div>
                <button type="submit" class="btn btn-primary">Start Parsing</button>
            </form>
            </div>
            </form>
            <form method="POST">
            <div class="container" style="margin-top:100px;">
            <form id="parser-form">
                <input type="hidden" name="form_type" value="category">
                <div class="form-group">
                <div class="<?php echo (!empty($success_msg_c)) ? 'alert alert-success' : ''; ?>"><?= $success_msg_c ?></div>
                <div class="<?php echo (!empty($alert_msg_c)) ? 'alert alert-danger' : ''; ?>"><?= $alert_msg_c ?></div>
                <label for="url-input">Enter category URL:</label>
                <input name='url' type="url" class="form-control" id="url-input" placeholder="" required>
                </div>
                <button type="submit" class="btn btn-primary">Start Parsing</button>
            </form>
            </div>
            </form>
        </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js" integrity="sha512-NCiXRSV460cHD9ClGDrTbTaw0muWUBf/zB/yLzJavRsPNUl9ODkUVmUHsZtKu17XknhsGlmyVoJxLg/ZQQEeGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../Media/js/settings.js"></script>
</body>
</html>
