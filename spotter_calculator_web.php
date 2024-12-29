<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $spotter = $_POST['spotter'];
    $num_members = intval($_POST['num_members']);
    $value = floatval($_POST['value']);

    if ($num_members <= 0) {
        $error = "Number of members must be greater than zero.";
    } elseif ($value < 0) {
        $error = "Value must not be negative.";
    } else {
        $adjusted_value = $value * 0.8;
        $share_per_member = $num_members > 1 ? $adjusted_value / $num_members : 0;
        $spotter_share = $share_per_member + (0.2 * $adjusted_value);

        $result = [
            'adjusted_value' => number_format($adjusted_value, 2),
            'share_per_member' => number_format($share_per_member, 2),
            'spotter_share' => number_format($spotter_share, 2),
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Spotter Calculator</title>
</head>
<body>
    <h1>Spotter Calculator</h1>
    <form method="POST">
        <label for="spotter">Who is the spotter?</label><br>
        <input type="text" id="spotter" name="spotter" required><br><br>

        <label for="num_members">How many members (including the spotter)?</label><br>
        <input type="number" id="num_members" name="num_members" required><br><br>

        <label for="value">What is the total value?</label><br>
        <input type="number" step="0.01" id="value" name="value" required><br><br>

        <button type="submit">Calculate</button>
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif (isset($result)): ?>
        <h2>Results:</h2>
        <p>Total adjusted value: <?php echo $result['adjusted_value']; ?></p>
        <p>Each non-spotter member gets: <?php echo $result['share_per_member']; ?></p>
        <p><?php echo htmlspecialchars($spotter); ?> (the spotter) gets: <?php echo $result['spotter_share']; ?></p>
    <?php endif; ?>
</body>
</html>