
<?php
require_once __DIR__ . '/utils/load-env.php';

$pdo = null;
$card = null;
$errorMessage = null;

$customerName = '';
$customerId = '';

$REFERENCE_NUMBER_FROM_URL = trim(
    (string) ($_GET['q'] ?? '')
);

// Default to an unpunched card.
$punches = array_fill(0, 10, false);

try {
    $dsn = 'mysql:host=' . $_ENV['DB_HOST']
        . ';dbname=' . $_ENV['DB_NAME']
        . ';charset=utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $options
    );

    if ($REFERENCE_NUMBER_FROM_URL === '') {
        $errorMessage = 'Invalid loyalty card QR code.';
    } else {
        $sql = "
            SELECT
                ID,
                PROMO_ID,
                REFERENCE_NUMBER,
                CUSTOMER_NAME,
                DAY_1,
                DAY_2,
                DAY_3,
                DAY_4,
                DAY_5,
                DAY_6,
                DAY_7,
                DAY_8,
                DAY_9,
                DAY_10
            FROM t_promo_punch_card
            WHERE SHA1(REFERENCE_NUMBER) = ?
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$REFERENCE_NUMBER_FROM_URL]);

        $card = $stmt->fetch();

        if (!$card) {
            $errorMessage = 'Loyalty card not found. Please check your QR code.';
        } else {
            $customerName = $card['CUSTOMER_NAME'];
            $customerId = $card['REFERENCE_NUMBER'];

            // Map DAY_1 through DAY_10 to the stamp grid.
            for ($i = 1; $i <= 10; $i++) {
                $column = 'DAY_' . $i;

                $punches[$i - 1] = (int) $card[$column] === 1;
            }
        }
    }
} catch (PDOException $e) {
    // Keep database details out of the public page.
    error_log('Punch card database error: ' . $e->getMessage());

    $errorMessage = 'Unable to load your loyalty card. Please try again later.';
}

// Calculate stamp progress.
$punchCount = count(array_filter($punches));
$progress = (int) round(($punchCount / 10) * 100);

// Stamp labels.
$stamps = [
    ['label' => '1st Order'],
    ['label' => '2nd Order'],
    ['label' => '3rd Order'],
    ['label' => '4th Order'],
    ['label' => '5th Order'],
    ['label' => '6th Order'],
    ['label' => '7th Order'],
    ['label' => '8th Order'],
    ['label' => '9th Order'],
    ['label' => '10th Order'],
];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#171717">
    <title>SipUp Coffee | Punch Card</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/qrcheck.css">
</head>

<body class="bg-neutral-100 text-neutral-900">
    <main class="page-shell mx-auto flex h-[100dvh] w-full max-w-2xl flex-col gap-3 px-3 py-3 sm:px-5 sm:py-4">
        <header
            class="flex shrink-0 items-center justify-between rounded-2xl bg-neutral-900 px-4 py-3 text-white sm:px-5">
            <div class="min-w-0">
                <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-yellow-300 sm:text-xs">SipUp Coffee By
                    Chad</p>
                <h1 class="brand-title mt-1 text-2xl font-black tracking-tight sm:text-3xl">Loyalty Card</h1>
                <p class="mt-1 truncate text-xs text-neutral-300 sm:text-sm">
                    <?= htmlspecialchars($customerName, ENT_QUOTES, 'UTF-8') ?> <span class="text-neutral-500">·
                        <?= htmlspecialchars($customerId, ENT_QUOTES, 'UTF-8') ?></span></p>
            </div>
            <div class="ml-3 shrink-0 text-right">
                <div class="text-3xl font-black leading-none text-yellow-300 sm:text-4xl"><?= $punchCount ?><span
                        class="text-base text-neutral-400">/10</span></div>
                <div class="mt-1 text-[10px] font-semibold uppercase tracking-wider text-neutral-300 sm:text-xs">Stamps
                </div>
            </div>
        </header>
		
        <section
            class="flex min-h-0 flex-1 flex-col rounded-2xl border border-neutral-200 bg-white p-3 shadow-sm sm:p-4">
            <div class="mb-3 flex shrink-0 items-end justify-between gap-2">
                <div>
                    <h2 class="text-sm font-extrabold sm:text-base">Every cup brings you closer</h2>
                    <p class="mt-0.5 text-[11px] text-neutral-500 sm:text-xs">Collect 10 stamps to earn a free cup!</p>
                </div>
                <span
                    class="shrink-0 rounded-full bg-neutral-100 px-2.5 py-1 text-[10px] font-bold text-neutral-700 sm:text-xs"><?= $progress ?>%
                    complete</span>
            </div>

            <div class="mb-3 h-1.5 shrink-0 overflow-hidden rounded-full bg-neutral-100">
                <div class="h-full rounded-full bg-yellow-400 transition-all" style="width: <?= $progress ?>%"></div>
            </div>
			
			<?php 
			$LOGO = file_get_contents('logo.txt');
			?>

            <div class="stamp-grid grid min-h-0 flex-1 grid-cols-5 grid-rows-2 gap-2">
                <?php foreach ($stamps as $index => $stamp): ?>
                    <?php $isPunched = !empty($punches[$index]); ?>
                    <div
                        class="relative min-h-0 overflow-hidden rounded-xl border-2 <?= $isPunched ? 'punched border-yellow-400' : 'unpunched border-neutral-200' ?>">
                        <img class="stamp-photo" src="<?= $LOGO ?>" alt="SipUp Logo by Chad" />
                        <div class="stamp-shade"></div>
                        <span class="stamp-status"
                            aria-label="<?= $isPunched ? 'Punched' : 'Not punched' ?>"><?= $isPunched ? '✓' : '○' ?></span>
                        <span class="stamp-label"><?= htmlspecialchars($stamp['label'], ENT_QUOTES, 'UTF-8') ?></span>
                        <?php if ($isPunched): ?>
                            <span
                                class="absolute inset-0 z-[1] border-2 border-yellow-300/70 rounded-lg pointer-events-none"></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <footer class="mt-3 flex shrink-0 items-center justify-between gap-2 border-t border-neutral-100 pt-3">
                <div class="flex items-center gap-2 text-[10px] font-medium text-neutral-500 sm:text-xs">
                    <span
                        class="flex h-5 w-5 items-center justify-center rounded-full bg-yellow-300 font-black text-neutral-900">✓</span>
                    Punched
                    <span
                        class="ml-2 flex h-5 w-5 items-center justify-center rounded-full bg-neutral-100 font-black text-neutral-500">○</span>
                    Not yet
                </div>
                <div class="text-right text-[10px] font-extrabold uppercase tracking-wide text-neutral-700 sm:text-xs">
                    10th stamp = Free cup</div>
            </footer>
        </section>

        <p class="shrink-0 text-center text-[10px] text-neutral-500 sm:text-xs">Thank you for choosing SipUp Coffee by Chad.
            Enjoy every sip!</p>
    </main>
</body>

</html>