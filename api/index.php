<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied | Coffee Shop Name</title>
    <style>
        :root {
            --bg-color: #fdfbf7;
            /* Warm cream background */
            --container-bg: #ffffff;
            /* Clean white card */
            --text-main: #3c2a21;
            /* Deep espresso */
            --text-muted: #8c7365;
            /* Soft warm taupe */
            --accent-color: #6f4e37;
            /* Rich coffee brown */
            --accent-hover: #503726;
            /* Darker roast hover */
            --border-color: #e6dfd5;
            /* Subtle border */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .error-container {
            text-align: center;
            background: var(--container-bg);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(60, 42, 33, 0.06);
            max-width: 420px;
            width: 90%;
            border: 1px solid var(--border-color);
        }

        .coffee-icon {
            font-size: 3.5rem;
            margin-bottom: 5px;
        }

        h1 {
            font-size: 4rem;
            margin: 0 0 5px 0;
            color: var(--accent-color);
            font-weight: 700;
            letter-spacing: -1px;
        }

        h2 {
            font-size: 1.4rem;
            margin: 0 0 15px 0;
            color: var(--text-main);
        }

        p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0 0 25px 0;
        }

        .home-btn {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .home-btn:hover {
            background-color: var(--accent-hover);
            transform: translateY(-1px);
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="coffee-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="coffee" aria-hidden="true" class="lucide lucide-coffee h-12 w-12 text-[#e5bf96]">
                <path d="M10 2v2"></path>
                <path d="M14 2v2"></path>
                <path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"></path>
                <path d="M6 2v2"></path>
            </svg>
        </div>
        <h1>403</h1>
        <h2>Restricted</h2>
        <p>Looks like this corner of the page is off-limits or reserved. Lets get you back to the main menu before your coffee gets cold!</p>
        <a href="/menu.php" class="home-btn">Back to Menu</a>
    </div>
</body>

</html>