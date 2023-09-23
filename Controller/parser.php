<?php
include_once '../Model/authorization.php';
include_once '../Config/database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$success_msg="";
$error_msg="";
$alert_msg="";
$success_msg_c="";
$alert_msg_c="";
// $url = 'https://kontakt.az/soyuducu-samsung-rb34t670fsa-wt-gumusu/';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';
    if ($formType === 'product') {
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $query = "SELECT * FROM mydb.product_info WHERE link = '$url'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $error_msg = "Error: URL already exists";
        } else {
        // echo "URL: $url";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        // $html = file_get_contents($url);
        preg_match('/<h1\s+class="title">(.+)<\/h1>/', $html, $matches);
        $title = isset($matches[1]) ? $matches[1] : null;
        // echo "title: $title<br>";
        preg_match('/<a href="https:\/\/kontakt\.az">Əsas səhifə<\/a><\/li><li><a href=".*?">(.*?)<\/a>/s', $html, $matches);
        $category = isset($matches[1]) ? $matches[1] : null;
        // print_r($matches);
        // echo "category: $category<br>";
        preg_match('/<span style="text-decoration:line-through;font-weight:normal">(\d+\.\d+) <small class="azn_span">M<\/small><\/span>/', $html, $matches);
        $old_price = isset($matches[1]) ? $matches[1] : null;
        // echo "Old price: $old_price<br>";
        if(preg_match('/<span style="text-decoration:line-through;font-weight:normal">(\d+\.\d+) <small class="azn_span">M<\/small><\/span>/', $html, $matches)) {
            preg_match('/<span class="nprice" id="price-\d+">(.*)<small class="azn_span">M<\/small><\/span>/', $html, $matches);
            $price = $matches[1];
            // echo "price: $price<br>";
        }
        else {
            preg_match('/<span\s+class="nprice"\s+id="price-\d+">([^<]+)<\/span>/', $html, $matches);
            $price = isset($matches[1]) ? $matches[1] : null;
            // echo "price: $price<br>";
        }

        preg_match('/<a\s+class="single-product-link"\s+href="([^"]+)"\s+data-lightbox="single-product"\s+data-title="[^"]*">/', $html, $matches);
        $image_url = isset($matches[1]) ? $matches[1] : null;
        // echo "price: $image_url<br>";

        date_default_timezone_set('Asia/Baku');
        $date = date('Y-m-d H:i:s');
        if ($image_url) {
            $image_path = '../Media/product_img/' . basename($image_url);
            file_put_contents($image_path, file_get_contents($image_url));
            // $image_url = isset($matches[1]) ? basename($matches[1]) : null;
        }
        if ($url) {
            $auth = new Authorization($conn);
            if ($title !== null && $auth->createProduct($title, $category, $price, $old_price, $image_url, $url, $date)) {
                $success_msg = 'Product information parsed and saved successfully!';
            } else {
                $alert_msg = "Invalid URL";
            }
        }        
    }
    } elseif ($formType === 'category') {
        $url= isset($_POST['url']) ? $_POST['url'] : '';
        $url_2 = $url . 'page/2/';
        $url_3 = $url . 'page/3/';
        $urls = [$url,$url_2,$url_3];
        foreach ($urls as $url) {

        // echo "URL: $url";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);

        // preg_match('/<div class="name">\s*<a draggable="false" href=".*?">(.*?)<\/a>/', $html, $matches);
        // $title = isset($matches[1]) ? $matches[1] : null;
        // echo "title: $title<br>";
        // print_r($matches);
        // $pattern = '/<div class="name">\s*<a draggable="false" href="(.*?)">/';
        $pattern = '/<div class="name">\s*<a draggable="false" href="(.*?)">\s*(.*?)\s*<\/a>/';
        preg_match_all($pattern, $html, $matches);
        // print_r($matches);
        $links = $matches[1]; 
        $titles = $matches[2];
        // print_r($links); 

        // foreach ($titles as $title) {
        //     echo $title . "<br>";
        // }
        // foreach ($links as $link) {
        //     echo $link . "<br>";
        // }

        $pattern = '/<img\s+class="lazy"\s+alt="[^"]*"\s+src="[^"]*"\s+data-src="([^"]+)"\s*>/';
        preg_match_all($pattern, $html, $matches);
        $image_urls = isset($matches[1]) ? $matches[1] : null;
        // foreach ($image_urls as $image_url) {
        //     echo $image_url . "<br>";
        // }

            preg_match_all('/<button\s+class="select-item"\s+data-id="\d+"\s+data-reserve-id="\d+"\s+data-mid="[^"]+"\s+data-price="([^"]+)"/', $html, $matches);
            $prices = $matches[1];
        
            preg_match('/<a href="https:\/\/kontakt\.az">Əsas səhifə<\/a><\/li><li><a href=".*?">(.*?)<\/a>/s', $html, $matches);
            $category = isset($matches[1]) ? $matches[1] : null;

            date_default_timezone_set('Asia/Baku');
            $date = date('Y-m-d H:i:s');

            for ($i = 0; $i < 48; $i++) {
                $title = isset($titles[$i]) ? $titles[$i] : null;
                $image_url = isset($image_urls[$i]) ? $image_urls[$i] : null;
                // $_SESSION['image_url1'] = $image_url1;

                $image_path = '../Media/product_img/' . basename($image_url);
                file_put_contents($image_path, file_get_contents($image_url));
                
                $price = isset($prices[$i]) ? $prices[$i] : null;
                $link = isset($links[$i]) ? $links[$i] : null;
                $old_price = null;

                preg_match('/<h1\s+class="title">(.+)<\/h1>/', $html, $matches);
                $title2 = isset($matches[1]) ? $matches[1] : null;

                if($url){
                    $auth = new Authorization($conn);
                    if ($title2===null && $title!==null && $auth->createProduct($title,$category,$price,$old_price,$image_url,$link,$date)) {
                        $prices = [];


                        if (preg_match_all('/<button\s+class="select-item"\s+data-id="(\d+)"/', $html, $matches)) {
                            $dataIds = isset($matches[1]) ? $matches[1] : [];
                            if (preg_match_all('/<button\s+class="select-item"\s+data-id="\d+"\s+data-reserve-id="\d+"\s+data-mid="[^"]+"\s+data-price="([^"]+)"/', $html, $priceMatches)) {
                                $prices = $priceMatches[1];
                                $pattern = '/<div class="name">\s*<a draggable="false" href="(.*?)">\s*(.*?)\s*<\/a>/';
                                preg_match_all($pattern, $html, $matches);
                                // print_r($matches);
                                $links = $matches[1];
                            } else {
                                $prices = [];
                            }
                            foreach ($dataIds as $index => $dataId) {
                                $price = isset($prices[$index]) ? $prices[$index] : null;
                                $link = isset($links[$index]) ? $links[$index] : null;
                                $pattern = '/<span\s+style="text-decoration:line-through;font-weight:normal">(\d+\.\d+)\s+<small class="azn_span">M<\/small><\/span>.*<span\s+class="nprice"\s+id="price-'.$dataId.'">(\d+\.\d+)\s+<small class="azn_span">M<\/small><\/span>/';
                                if (preg_match($pattern, $html, $matches)) {
                                    $old_price = isset($matches[1]) ? $matches[1] : null;
                                    // echo "Price: $price | Old price: $old_price | Link: $link<br>";
                                    $updateQuery = "UPDATE mydb.product_info SET old_price = '$old_price' WHERE link = '$link'";
                                        if ($conn->query($updateQuery) === TRUE) {
                                            // $success_msg = "Old price updated successfully!";
                                        } else {
                                            // $error_msg = "Error updating old price: ";
                                        }
                                }
                            }
                        }
                        $success_msg_c = 'Product information parsed and saved successfully!'; 
                    } else {
                        // $alert_msg_c="Invalid URL";
                    }
                }
        }
        
    }
}
}
?>