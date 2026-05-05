<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🏥 Hospital Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:    #0d1b2a;
            --paper:  #f5f0e8;
            --cream:  #ede8d8;
            --teal:   #1a7d6e;
            --teal2:  #145f54;
            --red:    #c0392b;
            --gold:   #b8860b;
            --muted:  #6b7a8d;
            --white:  #ffffff;
            --radius: 6px;
            --shadow: 0 2px 12px rgba(13,27,42,0.10);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--paper);
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── NAV ── */
        nav {
            background: var(--ink);
            padding: 0 32px;
            display: flex;
            align-items: center;
            gap: 32px;
            height: 60px;
        }
        .nav-brand {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            color: var(--white);
            text-decoration: none;
            letter-spacing: 0.02em;
            flex: 1;
        }
        .nav-brand span { color: #7ecfc6; }
        nav a.nav-link {
            color: #adb5c4;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 4px 0;
            border-bottom: 2px solid transparent;
            transition: color .2s, border-color .2s;
        }
        nav a.nav-link:hover,
        nav a.nav-link.active { color: #7ecfc6; border-bottom-color: #7ecfc6; }

        /* ── LAYOUT ── */
        .container { max-width: 1100px; margin: 36px auto; padding: 0 24px; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 28px;
            border-bottom: 2px solid var(--cream);
            padding-bottom: 16px;
        }
        .page-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            color: var(--ink);
        }
        .page-header p { color: var(--muted); font-size: 0.9rem; margin-top: 4px; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-block;
            padding: 9px 18px;
            border-radius: var(--radius);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: filter .15s, transform .1s;
        }
        .btn:hover { filter: brightness(1.08); transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }
        .btn-teal     { background: var(--teal);  color: #fff; }
        .btn-ink      { background: var(--ink);   color: #fff; }
        .btn-red      { background: var(--red);   color: #fff; }
        .btn-outline  { background: transparent;  color: var(--ink); border: 1.5px solid var(--ink); }
        .btn-sm       { padding: 5px 12px; font-size: 0.78rem; }

        /* ── CARDS / TABLE ── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--ink);
            color: #e0e7ef;
            padding: 13px 16px;
            text-align: left;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 600;
        }
        tbody td { padding: 12px 16px; border-bottom: 1px solid var(--cream); font-size: 0.88rem; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #f9f6f0; }
        .td-code { font-family: monospace; font-weight: 700; color: var(--teal2); }
        .td-actions { display: flex; gap: 8px; }

        /* ── BADGES ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-scheduled  { background: #dbeafe; color: #1d4ed8; }
        .badge-completed  { background: #d1fae5; color: #065f46; }
        .badge-cancelled  { background: #fee2e2; color: #991b1b; }
        .badge-male       { background: #e0f2fe; color: #0369a1; }
        .badge-female     { background: #fce7f3; color: #9d174d; }
        .badge-other      { background: #f3f4f6; color: #374151; }

        /* ── FORMS ── */
        .form-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); padding: 32px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 0.82rem; font-weight: 600; color: var(--muted); letter-spacing: 0.04em; text-transform: uppercase; }
        input[type=text], input[type=date], input[type=datetime-local], select, textarea {
            padding: 10px 12px;
            border: 1.5px solid var(--cream);
            border-radius: var(--radius);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--ink);
            background: var(--white);
            transition: border-color .2s;
            width: 100%;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(26,125,110,.12);
        }
        textarea { resize: vertical; min-height: 80px; }
        .form-actions { display: flex; gap: 12px; margin-top: 28px; }

        /* ── ALERTS ── */
        .alert { padding: 12px 16px; border-radius: var(--radius); font-size: 0.88rem; margin-bottom: 20px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-danger   { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }
        .alert ul { padding-left: 20px; }

        /* ── EMPTY STATE ── */
        .empty-state { padding: 60px; text-align: center; color: var(--muted); }
        .empty-state h3 { font-size: 1.2rem; margin-bottom: 8px; }

        @media (max-width: 700px) {
            .form-grid { grid-template-columns: 1fr; }
            nav { gap: 16px; padding: 0 16px; }
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php" class="nav-brand">🏥 <span>Hospital</span> MVC</a>
    <a href="index.php?controller=patient&action=index" class="nav-link <?= (($_GET['controller'] ?? '') === 'patient') ? 'active' : '' ?>">Patients</a>
    <a href="index.php?controller=appointment&action=index" class="nav-link <?= (($_GET['controller'] ?? '') === 'appointment') ? 'active' : '' ?>">Appointments</a>
</nav>

<div class="container">
