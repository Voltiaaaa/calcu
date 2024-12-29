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

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $spotter = $_POST['spotter'];
        $num_members = intval($_POST['num_members']);
        $value = floatval($_POST['value']);

        if ($num_members <= 0) {
            echo "<p style='color: red;'>Number of members must be greater than zero.</p>";
        } elseif ($value < 0) {
            echo "<p style='color: red;'>Value must not be negative.</p>";
        } else {
            $adjusted_value = $value * 0.8;
            $share_per_member = $num_members > 1 ? $adjusted_value / $num_members : 0;
            $spotter_share = $share_per_member + (0.2 * $adjusted_value);

            echo "<h2>Results:</h2>";
            echo "<p>Total adjusted value: " . number_format($adjusted_value, 2) . "</p>";
            echo "<p>Each non-spotter member gets: " . number_format($share_per_member, 2) . "</p>";
            echo "<p>" . htmlspecialchars($spotter) . " (the spotter) gets: " . number_format($spotter_share, 2) . "</p>";
        }
    }
    ?>
</body>
</html>