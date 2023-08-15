<!DOCTYPE html>
<html>
<head>
    <title>Checkout Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            padding-right: 10px;
        }
    </style>
</head>
<body>

<h2>Checkout Page</h2>

<form action="" method="post">
    <label for="customerName">Customer Name:</label>
    <input type="text" id="customerName" name="customerName" required>
    <br><br>

    <h3>Selected Products:</h3>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["checkout"])) {
            $customerName = $_POST["customerName"];
            echo "<p>Customer: $customerName</p>";

            $totalPrice = 0;
            foreach ($_POST["products"] as $product) {
                list($productName, $productPrice) = explode("|", $product);
                $totalPrice += (float) $productPrice;
                echo "<tr><td>$productName</td><td>$" . number_format($productPrice, 2) . "</td></tr>";
            }

            echo "<tr class='total'><td>Total:</td><td>$" . number_format($totalPrice, 2) . "</td></tr>";
        }
        ?>
    </table>

    <br>
    <button type="submit" name="checkout">Checkout</button>
</form>

</body>
</html>
