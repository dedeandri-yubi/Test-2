<?php
include_once("config.php");

$result = mysqli_query($mysqli, "SELECT product.name as product_name,
        product.id as product_id,
        date,product.price as price_buy,order_items.quantity as qty,
        merchant.name as merchant_name, status.name as status_name
        FROM order_items 
        INNER JOIN product ON order_items.product_id = product.id
        INNER JOIN merchant ON product.merchant_id = merchant.id
        INNER JOIN order_status ON order_items.id = order_status.order_items_id
        INNER JOIN status ON order_status.status_id = status.id
        ORDER BY order_items.id DESC
        ");
// create query merchant name where name = ' Budi'


/**
 * Terdapat besaran angka: "7.875.000" saya ingin menghasilkan output seperti dibawah ini:
 * 7000000
 * 800000
 * 70000
 * 5000
 */

$angka = "7.875.000";

// Menghilangkan tanda titik dan mengubah angka menjadi integer
$angka = str_replace(".", "", $angka);
$angka = intval($angka);

// Memisahkan angka menjadi ribuan, ratusan ribu, jutaan, dan seterusnya
$jutaan = floor($angka / 1000000);
$ratusan_ribu = floor(($angka % 1000000) / 100000);
$puluhan_ribu = floor(($angka % 100000) / 10000);
$ribuan = floor(($angka % 10000) / 1000);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        echo "Soal no: 1 A<br>";
        echo "- " . number_format($jutaan * 1000000, 0, ",", ".") . "<br>";
        echo "- " . number_format($ratusan_ribu * 100000, 0, ",", ".") . "<br>";
        echo "- " . number_format($puluhan_ribu * 10000, 0, ",", ".") . "<br>";
        echo "- " . number_format($ribuan * 1000, 0, ",", ".") . "<br>";

        echo "<hr>";

        // Tampilkan kata "Lima" pada saat perulangan menemukan angka 5 dengan rentang angka 1 s/d 10.
        function tampilkanLima($angka)
        {
            for ($i = 1; $i <= $angka; $i++) {
                if ($i == 5) {
                    echo 'Lima<br>';
                } else {
                    echo $i . '<br>';
                }
            }
        }

        echo "Soal no: 1 B<br>";
        echo tampilkanLima(10);

        echo "<hr>";

        $angka = 20;
        $multiply = 2;
        function hitung($angka)
        {
            $multiply = 3;
            return (2 * $angka) . '<br>';
            $multiply =  2;
        }

        echo "Soal no: 2 A<br>";
        echo hitung(10);
        echo hitung(100);
        echo "<hr>";

        echo "Soal no: 2 B<br>";

        $a = 2;
        function foo()
        {
            $a = 3;
        }
        foo();
        echo $a;

        echo "<hr>";
        echo "Soal no: 3 A<br>";
        echo "- <code>SELECT id as order_id FROM order_items<br></code>";
        echo "- <code>SELECT quntity as qty FROM order_items</code><br>";
        echo "- <code>SELECT product_id as product_id FROM order_items</code><br>";
        echo "- <code>SELECT product.name as product_name FROM order_items INNER JOIN product on order_items.product_id = product.id</code><br>";
        echo "- <code>SELECT merchant.name as merchant_name FROM order_items INNER JOIN product on order_items.product_id = product.id INNER JOIN merchant ON product.merchant_id = merchant.id</code><br>";
        echo "- <code>SELECT users.name as full_name FROM order_items INNER JOIN users on order_items.user_id = users.id</code><br>";

        echo "<hr>";
        echo "Soal no: 3 B<br>";
        echo "- <code>SELECT status.name as status_name FROM order_items INNER JOIN order_status ON order_items.id = order_status.order_items_id INNER JOIN status ON order_status.status_id = status.id where status.name ='Payment'</code><br>";
        echo "- <code>SELECT product.price * order_items.quantity as total FROM order_items INNER JOIN product ON order_items.product_id = product.id where total > 5000 </code><br>";
        echo "- <code>SELECT product.price * order_items.quantity as total FROM order_items INNER JOIN product ON order_items.product_id = product.id INNER JOIN merchant on product.merchant_id = merchant.id where merchant.name like '%DADY%'</code><br>";
        echo "- <code>SELECT merchant.name as merchant_name FROM order_items INNER JOIN product ON order_items.product_id = product.id INNER JOIN merchant on product.merchant_id = merchant.id where merchant.name like '%DADY%'</code><br>";
        echo "- <code>SELECT merchant.expired_date as priode FROM order_items INNER JOIN product ON order_items.product_id = product.id INNER JOIN merchant on product.merchant_id = merchant.id where merchant.expire_date > '01-Jan-2022'</code><br>";
        echo "- <code>SELECT city.name as city_name FROM order_items INNER JOIN product ON order_items.product_id = product.id INNER JOIN merchant on product.merchant_id = merchant.id INNER JOIN city on merchant.city_id = city.id where city.name like '%ONE%' </code><br>";
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name Product</th>
                    <th>Merchant</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Qunatity</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($order_items = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $order_items['product_id'] . "</td>";
                    echo "<td>" . $order_items['product_name'] . "</td>";
                    echo "<td>" . $order_items['merchant_name'] . "</td>";
                    echo "<td>" . $order_items['date'] . "</td>";
                    echo "<td>" . number_format($order_items['price_buy']) . "</td>";
                    echo "<td>" . $order_items['qty'] . "</td>";
                    echo "<td>" . number_format($order_items['price_buy'] * $order_items['qty']) . "</td>";
                    echo "<td>" . $order_items['status_name'] . "</td>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>