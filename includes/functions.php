<?php
// /var/www/html/superminer/includes/functions.php
require_once 'config.php';

/**
 * Calculates daily ROI based on hash rate, power cost, usage, and coin profitability.
 * @param float $hashRate Hash rate in MH/s
 * @param float $powerCost Power cost in $/kWh
 * @param float $powerUsage Power usage in watts
 * @param float $profitPerDay Daily profit from coin data
 * @return float Net daily profit
 */
function calculate_roi($coin_data, $coins, $coin, $hashrate_mh, $power_w, $power_cost, $hardware_cost) {
    $block_time = $coin_data['block_time'] ?? 30;
    $block_reward = $coin_data['block_reward'] ?? 1;
    $nethash = $coin['nethash'];
    $price = $coin['exchanges'][0]['price'] ?? 0;

    $hashrate = $hashrate_mh * 1e6;
    $blocks_per_day = 86400 / $block_time;
    $user_share = $hashrate / $nethash;
    $daily_coins = $user_share * $block_reward * $blocks_per_day;
    $daily_revenue = $daily_coins * $price;

    $daily_power_cost = ($power_w / 1000) * 24 * $power_cost;
    $daily_profit = $daily_revenue - $daily_power_cost;

    if ($daily_profit <= 0) {
        return [
            'daily_profit' => round($daily_profit, 4),
            'roi_days' => INF,
            'roi_percent' => -100
        ];
    }

    $roi_days = $hardware_cost / $daily_profit;
    $roi_percent = ($daily_profit * 30 / $hardware_cost) * 100;

    return [
        'daily_profit' => round($daily_profit, 4),
        'roi_days' => round($roi_days, 2),
        'roi_percent' => round($roi_percent, 2)
    ];
}
?>