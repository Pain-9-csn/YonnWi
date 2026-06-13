<?php
$page_title = $page_title ?? 'YoonWi Admin';
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= htmlspecialchars($page_title) ?> — YoonWi Admin</title>
    <link rel="stylesheet" href="public/templates/templateAdmin/src/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="public/templates/templateAdmin/src/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="public/templates/templateAdmin/src/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="public/templates/templateAdmin/src/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/templates/templateAdmin/src/assets/css/style.css">
    <style>
        :root {
            --accent: #71c55d;
            --accent-dark: #5fb04d;
            --accent-soft: rgba(113,197,93,.12);
        }
        .sidebar .nav .nav-item.active > .nav-link {
            background: var(--accent-soft);
            border-left: 3px solid var(--accent);
        }
        .sidebar .nav .nav-item .nav-link:hover {
            background: var(--accent-soft);
        }
        .btn-accent { background: var(--accent); color: #fff; border: none; }
        .btn-accent:hover { background: var(--accent-dark); color: #fff; }
        .badge-accent { background: var(--accent); color: #fff; }
        .card-stat { border-left: 4px solid var(--accent); }
        .table thead th { background: #f8f9fa; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
        .action-btn { padding: 4px 10px; font-size: 12px; }
        .page-header { margin-bottom: 24px; }
        .page-header h3 { font-weight: 700; color: #1f2937; }
        .page-header p { color: #6b7280; margin: 0; }
    </style>
</head>