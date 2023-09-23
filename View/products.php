<?php include '../Controller/parser.php';?>
<div class="container1" style="display:flex">
<?php include 'dashboard.php' ?>

<div class="container" style="max-width: 900px; margin-left: 300px; display:flex;">
        <!-- <h1 style="margin-bottom: 20px;">Parsed Products</h1> -->
        <table class="table">
            <thead>
                <tr>
                <th>Main image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Old&nbsp;price</th>
                <th>Link</th>
                <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../Config/database.php';
                include '../Controller/parser.php';

                $query = "SELECT * FROM mydb.product_info";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row['main_image'] . "' alt='Product Image' style='width: 100px;'></td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['old_price'] . "</td>";
                        echo "<td><a href='" . $row['link'] . "' target='_blank'>Link</a></td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <button id="exportButton" class="btn btn-primary" style="margin-left: 20px; margin-top:10px; height:40px;">Export</button>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js" integrity="sha512-NCiXRSV460cHD9ClGDrTbTaw0muWUBf/zB/yLzJavRsPNUl9ODkUVmUHsZtKu17XknhsGlmyVoJxLg/ZQQEeGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../Media/js/settings.js"></script>
    <script>
    $(document).ready(function() {
        $('#exportButton').click(function() {
            window.location.href = '../Controller/export.php';
        });
    });
</script>
</body>
</html>
