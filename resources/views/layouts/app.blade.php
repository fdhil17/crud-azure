<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Monitor — Manajemen Produk Modern')</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --pm-primary: #4f46e5;
            --pm-primary-hover: #4338ca;
            --pm-primary-soft: rgba(79, 70, 229, 0.1);
            --pm-accent: #06b6d4;
            --pm-success: #10b981;
            --pm-warning: #f59e0b;
            --pm-danger: #ef4444;
            --pm-bg: #f8fafc;
            --pm-surface: #ffffff;
            --pm-border: #e2e8f0;
            --pm-text: #0f172a;
            --pm-text-muted: #64748b;
            --pm-shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06), 0 1px 2px rgba(15, 23, 42, 0.04);
            --pm-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.06), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
            --pm-shadow-lg: 0 20px 30px -10px rgba(79, 70, 229, 0.14);
        }

        [data-bs-theme="dark"] {
            --pm-primary: #6366f1;
            --pm-primary-hover: #818cf8;
            --pm-primary-soft: rgba(99, 102, 241, 0.15);
            --pm-bg: #0b0f19;
            --pm-surface: #111827;
            --pm-border: #1e293b;
            --pm-text: #f8fafc;
            --pm-text-muted: #94a3b8;
            --pm-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.3);
            --pm-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
            --pm-shadow-lg: 0 20px 30px -10px rgba(0, 0, 0, 0.5);
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--pm-bg);
            color: var(--pm-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image:
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.07) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(6, 182, 212, 0.07) 0px, transparent 50%);
            background-attachment: fixed;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        /* Navbar */
        .pm-navbar {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--pm-border);
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: background 0.25s ease, border-color 0.25s ease;
        }

        [data-bs-theme="dark"] .pm-navbar {
            background: rgba(17, 24, 39, 0.82);
        }

        .pm-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--pm-primary), var(--pm-accent));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            box-shadow: 0 6px 15px -3px rgba(79, 70, 229, 0.4);
        }

        .pm-brand-text {
            font-weight: 800;
            letter-spacing: -0.02em;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--pm-text) 30%, var(--pm-primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Cards & Containers */
        .pm-card {
            background: var(--pm-surface);
            border: 1px solid var(--pm-border);
            border-radius: 18px;
            box-shadow: var(--pm-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .pm-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: var(--pm-shadow-lg);
            border-color: rgba(79, 70, 229, 0.35);
        }

        /* Stat Cards */
        .stat-card {
            padding: 1.35rem 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        /* Buttons */
        .btn-pm-primary {
            background: linear-gradient(135deg, var(--pm-primary), #6366f1);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.25rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.28);
            transition: all 0.2s ease;
        }

        .btn-pm-primary:hover {
            background: linear-gradient(135deg, var(--pm-primary-hover), var(--pm-primary));
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.38);
        }

        .btn-pm-soft {
            background: var(--pm-primary-soft);
            color: var(--pm-primary);
            border: 1px solid transparent;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-pm-soft:hover {
            background: var(--pm-primary);
            color: #fff;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.18s ease;
            border: 1px solid var(--pm-border);
            background: var(--pm-surface);
            color: var(--pm-text-muted);
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-action.view:hover {
            background: rgba(6, 182, 212, 0.12);
            color: #0891b2;
            border-color: rgba(6, 182, 212, 0.3);
        }

        .btn-action.edit:hover {
            background: rgba(245, 158, 11, 0.12);
            color: #d97706;
            border-color: rgba(245, 158, 11, 0.3);
        }

        .btn-action.delete:hover {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* Form Controls */
        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid var(--pm-border);
            padding: 0.65rem 1rem;
            background-color: var(--pm-surface);
            color: var(--pm-text);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--pm-primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
            background-color: var(--pm-surface);
            color: var(--pm-text);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--pm-text);
            margin-bottom: 0.45rem;
        }

        /* Table */
        .pm-table {
            margin-bottom: 0;
        }

        .pm-table thead th {
            background: rgba(148, 163, 184, 0.08);
            color: var(--pm-text-muted);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--pm-border);
        }

        .pm-table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--pm-border);
            color: var(--pm-text);
        }

        .pm-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .pm-table tbody tr:hover {
            background-color: rgba(79, 70, 229, 0.03);
        }

        /* Price Badge */
        .price-tag {
            font-weight: 700;
            color: var(--pm-success);
            background: rgba(16, 185, 129, 0.1);
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            display: inline-block;
            white-space: nowrap;
        }

        /* Upload Dropzone */
        .upload-zone {
            border: 2px dashed var(--pm-border);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: rgba(148, 163, 184, 0.03);
        }

        .upload-zone:hover, .upload-zone.dragover {
            border-color: var(--pm-primary);
            background: var(--pm-primary-soft);
        }

        /* Product Thumbnail */
        .product-thumb {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            object-fit: cover;
            border: 1px solid var(--pm-border);
            box-shadow: var(--pm-shadow-sm);
        }

        .product-thumb-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.08), rgba(6, 182, 212, 0.08));
            border: 1px solid var(--pm-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pm-primary);
            font-size: 1.4rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.35s ease forwards;
        }

        /* Footer */
        .pm-footer {
            margin-top: auto;
            border-top: 1px solid var(--pm-border);
            padding: 1.5rem 0;
            color: var(--pm-text-muted);
            font-size: 0.875rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Top Navigation -->
    <nav class="pm-navbar py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('products.index') }}" class="text-decoration-none d-flex align-items-center gap-3">
                <span class="pm-brand-icon">
                    <i class="bi bi-box-seam-fill"></i>
                </span>
                <div>
                    <span class="pm-brand-text d-block lh-1">ProductMonitor</span>
                    <small class="text-muted" style="font-size: 0.72rem;">Sistem Inventaris & Katalog</small>
                </div>
            </a>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('products.index') }}"
                   class="btn btn-sm rounded-3 px-3 py-2 fw-semibold {{ request()->routeIs('products.index') ? 'btn-pm-soft' : 'text-muted' }}">
                    <i class="bi bi-grid-1x2 me-1"></i> Katalog
                </a>
                <a href="{{ route('products.create') }}"
                   class="btn btn-pm-primary btn-sm d-none d-sm-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg"></i> Tambah Produk
                </a>
                <button type="button" id="themeToggle" class="btn btn-action ms-1" title="Ubah Tema Gelap/Terang">
                    <i class="bi bi-moon-stars" id="themeIcon"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4 py-md-5 animate-fade-up">
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-4 shadow-sm d-flex align-items-center justify-content-between mb-4 py-3 px-4" role="alert" style="background: rgba(16, 185, 129, 0.12); color: #059669;">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span class="fw-semibold">{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content pm-card border-0 p-2">
                <div class="modal-body text-center p-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                         style="width: 60px; height: 60px; background: rgba(239, 68, 68, 0.12); color: #ef4444;">
                        <i class="bi bi-trash3-fill fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Hapus Produk?</h5>
                    <p class="text-muted small mb-4">
                        Produk <strong id="deleteProductName" class="text-body"></strong> akan dihapus permanen dan tidak dapat dikembalikan.
                    </p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light rounded-3 px-3 flex-fill fw-semibold" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <form id="deleteProductForm" method="POST" class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-3 px-3 w-100 fw-semibold">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="pm-footer">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <div>
                <span class="fw-semibold text-body">ProductMonitor</span> &copy; {{ date('Y') }} — Manajemen Produk Modern
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge rounded-pill text-bg-light border fw-medium px-3 py-2">
                    <i class="bi bi-lightning-charge-fill text-warning me-1"></i> Laravel & Bootstrap 5
                </span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark / Light Theme Persistence
        (function () {
            const html = document.documentElement;
            const toggleBtn = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');

            const savedTheme = localStorage.getItem('pm-theme') || 'light';
            setTheme(savedTheme);

            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    const current = html.getAttribute('data-bs-theme');
                    setTheme(current === 'dark' ? 'light' : 'dark');
                });
            }

            function setTheme(theme) {
                html.setAttribute('data-bs-theme', theme);
                localStorage.setItem('pm-theme', theme);
                if (themeIcon) {
                    themeIcon.className = theme === 'dark' ? 'bi bi-sun-fill text-warning' : 'bi bi-moon-stars';
                }
            }
        })();

        // Global Delete Modal Handler
        function confirmDelete(actionUrl, productName) {
            const form = document.getElementById('deleteProductForm');
            const nameEl = document.getElementById('deleteProductName');
            if (form && nameEl) {
                form.action = actionUrl;
                nameEl.textContent = '"' + productName + '"';
                const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                modal.show();
            }
        }
    </script>
    @stack('scripts')
</body>
</html>

