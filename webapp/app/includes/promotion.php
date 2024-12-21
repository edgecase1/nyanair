<?php

function isImportantSalesDay() {
    // Define a list of important sales days (month-day format or full date)
    $importantDays = [
        '01-01', // New Year's Day
        '11-24', // Black Friday 
        '12-25', // Christmas Day
        '07-04', // Independence Day (example)
        '02-14', // Valentine's Day (specific year example)
    ];

    $todayMonthDay = date('m-d'); // Month and day only

    // Check if today matches any important sales day
    return in_array($todayMonthDay, $importantDays) || in_array($todayMonthDay, $importantDays);
}

if (isImportantSalesDay())
{
    echo 'we have a coupon code for ' . $_REQUEST['from'] . '-' . $_REQUEST['to'] . '<div style="background-color: #28a745;color: #fff;border: none; padding: 10px 20px;
    border-radius: 5px;font-size: 1em;cursor: pointer;transition: background-color 0.3s;">SAVE20</div>';
} else {
    echo 'No promotion for ' . $_REQUEST['from'] . '-' . $_REQUEST['to'] . ' on ' . $_REQUEST['departure'];
}

?>