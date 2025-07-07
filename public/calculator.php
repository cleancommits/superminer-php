<?php
// /var/www/html/superminer/public/calculator.php
require_once '../includes/config.php';
require_once '../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperMiner.com - ROI Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/logo/superminer.jpg">
</head>
<body>
    <header class="hero-section text-white" id="site-header">
        <a href="/" class="d-inline-flex align-items-center text-decoration-none text-white gap-3">
            <img src="assets/logo/superminer.jpg" alt="SuperMiner.com Logo" class="logo-glow" style="width: 56px; height: 56px; border-radius: 50%">
            <h2 class="fs-5 fw-bold d-flex d-sm-none">SuperMiner.com</h2>
            <h2 class="fs-2 fw-bold d-sm-flex d-none">SuperMiner.com</h2>
        </a>
        <ul class="nav fs-6 header-nav d-lg-flex d-none">
            <li class="nav-item">
                <a class="nav-link" href="/">Top 10 Coins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/calculator.php">ROI Calculator</a>
            </li>
        </ul>
        <div class="dropdown d-md-flex d-lg-none">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/">Top 10 Coins</a></li>
                <li><a class="dropdown-item active" href="/calculator.php">ROI Calculator</a></li>
            </ul>
        </div>
    </header>

    <section id="main-content">
        <div class="row w-100" style="margin-left: 0px;">
            <div class="col-lg-2 border-end d-flex justify-content-center align-items-center">AD Section</div>
            <div class="col-lg-8 py-5">
                <h2 class="text-center mb-4 fw-bold text-primary">ROI Calculator</h2>
                <h5 class="text-center mb-4 fw-bold text-primary">Hi Preet,
                    Hope you're doing well today!
                    I've update the top 10 coins and mobile view.
                    I’m currently having an issue with my Upwork account, so I’m unable to send messages there.
                    If possible, please reach out to me on WhatsApp at +381 61 1467608.
                    Thank you!</h5>
                <div class="card calc-card shadow-sm p-4">
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <label for="coin" class="form-label fw-bold text-secondary">Coin</label>
                            <select name="coin" id="coin" class="form-select p-10" required size="1" style="max-height: 200px; overflow-y: auto;">
                                <?php foreach ($coins as $coin): ?>
                                    <option
                                        data-href="<?php echo WHATTOMINE_URL."/coins/".$coin['id']."-".strtolower($coin['tag'])."-".strtolower($coin['algorithm']); ?>"
                                        value="<?php echo htmlspecialchars($coin['name']); ?>"
                                        data-profitability="<?php echo ''; ?>"
                                    >
                                        <?php echo htmlspecialchars($coin['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="hashRate" class="form-label fw-bold text-secondary">Hash Rate (MH/s)</label>
                            <input type="number" name="hashRate" id="hashRate" class="form-control" step="0.1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="powerCost" class="form-label fw-bold text-secondary">Power Cost ($/kWh)</label>
                            <input type="number" name="powerCost" id="powerCost" class="form-control" step="0.01" required>
                        </div>
                        <div class="col-md-6">
                            <label for="powerUsage" class="form-label fw-bold text-secondary">Power Usage (W)</label>
                            <input type="number" name="powerUsage" id="powerUsage" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="hardwareCost" class="form-label fw-bold text-secondary">Hardware Cost ($)</label>
                            <input type="number" name="hardwareCost" id="hardwareCost" class="form-control" step="0.01" required>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg cta-btn">Calculate</button>
                            <a href="#" target="_blank" class="btn btn-secondary btn-lg explorer-btn" id="explorer_btn">Explorer</a>
                        </div>
                    </form>
                    <?php if (!empty($result)): ?>
                        <div class="alert alert-success mt-4 text-center">
                            <h5>Estimated Daily Profit: <span class="fw-bold text-success">$<?php echo $result; ?></span></h5>
                            <?php if (!empty($breakEven)): ?>
                                <p>Break-Even Time: <span class="fw-bold"><?php echo $breakEven; ?> days</span></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-2 border-start d-flex justify-content-center align-items-center d-none d-lg-flex">AD Section</div>
        </div>
        <div class="ad border-start d-flex justify-content-center align-items-center" style="height: 100px; flex-shrink: 0;">Bottom-AD Section</div>
    </section>
    
    <footer class="text-center bg-none" id="site-footer">
        
        <div class="bg-dark text-white py-3">
            <p class="mb-0">© 2025 SuperMiner.com | 
            <a href="<?php echo AFFILIATE_AMAZON; ?>" class="text-white">Buy on Amazon</a> | 
            <a href="<?php echo AFFILIATE_NEWEGG; ?>" class="text-white">Buy on Newegg</a>
        </p>
        </div>    
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#coin').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                });
            });
    </script>
</body>
</html>