<?php
function spotter_calculator() {
    // Ask for the spotter's name
    echo "Who is the spotter? ";
    $spotter = trim(fgets(STDIN));

    // Ask for the total number of members (including the spotter)
    echo "How many members are there (including the spotter)? ";
    $num_members = intval(trim(fgets(STDIN)));
    if ($num_members <= 0) {
        echo "Invalid input: Number of members must be greater than zero.\n";
        return;
    }

    // Ask for the value to be distributed
    echo "What is the total value? ";
    $value = floatval(trim(fgets(STDIN)));
    if ($value < 0) {
        echo "Invalid input: Value must not be negative.\n";
        return;
    }

    // Deduct 20% from the value
    $adjusted_value = $value * 0.8;

    // Calculate the equal share for non-spotter members
    $share_per_member = $num_members > 1 ? $adjusted_value / $num_members : 0;

    // Add 20% to the spotter's share
    $spotter_share = $share_per_member + (0.2 * $adjusted_value);

    // Output the results
    echo "\n--- Distribution Results ---\n";
    echo "Total adjusted value: " . number_format($adjusted_value, 2) . "\n";
    echo "Each non-spotter member gets: " . number_format($share_per_member, 2) . "\n";
    echo "$spotter (the spotter) gets: " . number_format($spotter_share, 2) . "\n";
}

// Run the calculator
spotter_calculator();
?>