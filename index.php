<?php
function convertNumberToWords($number) {
    $words = array(
        0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
        6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
        11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen',
        15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
        50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );

    if ($number == 0) {
        return 'Zero';
    }

    if ($number < 20) {
        return $words[$number];
    } elseif ($number < 100) {
        return $words[$number - $number % 10] . " " . $words[$number % 10];
    } elseif ($number < 1000) {
        return $words[intval($number / 100)] . " Hundred " . convertNumberToWords($number % 100);
    } elseif ($number < 1000000) {
        return convertNumberToWords(intval($number / 1000)) . " Thousand " . convertNumberToWords($number % 1000);
    } elseif ($number < 100000000) {
        return convertNumberToWords(intval($number / 1000000)) . " Million " . convertNumberToWords($number % 1000000);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = intval($_POST["number"]);

    if ($num > 10000000) {
        $result_en = "Number is too large! Maximum is 10,000,000.";
        $result_kh = "ចំនួនធំពេក! អតិបរមាគឺ ១០,០០០,០០០។";
        $result_usd = "N/A";
    } else {
        $result_en = convertNumberToWords($num) . " Riel";
        $result_kh = "បួនពាន់រៀល";  // You need to implement Khmer number words
        $result_usd = "$" . ($num / 4000);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Numbers to Words</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <section>
     <form method="post">
        <label>Input Number</label> <br>
        <input type="number" name="number" required> <br>
        <button type="submit">Convert</button>
    </form>
    
    <?php if (isset($result_en)) { ?>
        <p style="color:dodgerblue;">Result:</p>
        <ul>
            <li><strong><?php echo $result_en; ?></strong></li>
            <li><strong><?php echo $result_kh; ?></strong></li>
            <li><strong><?php echo $result_usd; ?></strong></li>
        </ul>
    <?php } ?>
    
   </section>
</body>
</html>
