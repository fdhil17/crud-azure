@extends('layouts.app')

@section('title', 'Katalog Produk — Product Monitor')

@push('styles')
<style>
    .hero-banner {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 55%, #06b6d4 100%);
        border-radius: 22px;
        padding: 2.25rem 2.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 35px -10px rgba(79, 70, 229, 0.35);
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 360px;
        height: 360px;
        background: radial-gradient(circle, rgba(255,255,255,0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .product-grid-card {
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-grid-img-wrap {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.08), rgba(6, 182, 212, 0.08));
    }

    .product-grid-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }

    .product-grid-card:hover .product-grid-img-wrap img {
        transform: scale(1.06);
    }

    .search-input-wrap {
        position: relative;
    }

    .search-input-wrap .bi-search {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--pm-text-muted);
    }

    .search-input-wrap input {
        padding-left: 2.65rem;
    }

    .view-toggle-btn {
        border-radius: 10px;
        padding: 0.5rem 0.85rem;
        border: 1px solid var(--pm-border);
        background: var(--pm-surface);
        color: var(--pm-text-muted);
        transition: all 0.15s ease;
    }

    .view-toggle-btn.active {
        background: var(--pm-primary);
        color: #fff;
        border-color: var(--pm-primary);
    }
</style>
@endpush

@section('content')
    @php
        $totalProducts = $products->count();
        $totalValue = $products->sum('harga_satuan');
        $avgPrice = $totalProducts > 0 ? $products->avg('harga_satuan') : 0;
        $maxPrice = $totalProducts > 0 ? $products->max('harga_satuan') : 0;
    @endphp

    <!-- Hero Header -->
    <div class="hero-banner mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-1 mb-2 fw-semibold">
                <i class="bi bi-stars me-1"></i> Dashboard Inventaris
            </span>
            <h1 class="fw-extrabold mb-1" style="font-size: clamp(1.5rem, 3vw, 2.1rem); letter-spacing: -0.02em;">
                Kelola & Pantau Produk Anda
            </h1>
            <p class="mb-0 text-white text-opacity-75">
                Pantau harga, deskripsi, dan katalog produk secara real-time dalam satu tampilan modern.
            </p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('products.create') }}" class="btn btn-light rounded-3 px-4 py-2 fw-bold shadow-sm text-primary d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill"></i> Tambah Produk Baru
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="pm-card stat-card h-100 d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(79, 70, 229, 0.12); color: #4f46e5;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <div class="text-muted small fw-medium">Total Produk</div>
                    <div class="fs-4 fw-bold">{{ $totalProducts }} <span class="fs-6 fw-normal text-muted">item</span></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="pm-card stat-card h-100 d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.12); color: #10b981;">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-muted small fw-medium">Total Nilai Unit</div>
                    <div class="fs-5 fw-bold text-truncate">Rp {{ number_format($totalValue, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="pm-card stat-card h-100 d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(6, 182, 212, 0.12); color: #06b6d4;">
                    <i class="bi bi-bar-chart-line"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-muted small fw-medium">Rata-rata Harga</div>
                    <div class="fs-5 fw-bold text-truncate">Rp {{ number_format($avgPrice, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="pm-card stat-card h-100 d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b;">
                    <i class="bi bi-trophy"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-muted small fw-medium">Harga Tertinggi</div>
                    <div class="fs-5 fw-bold text-truncate">Rp {{ number_format($maxPrice, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & View Toolbar -->
    @if($totalProducts > 0)
        <div class="pm-card p-3 mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-5">
                    <div class="search-input-wrap">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama atau deskripsi produk...">
                    </div>
                </div>
                <div class="col-7 col-md-4">
                    <select id="sortSelect" class="form-select">
                        <option value="newest">Urutkan: Terbaru</option>
                        <option value="price-asc">Harga: Terendah ke Tertinggi</option>
                        <option value="price-desc">Harga: Tertinggi ke Terendah</option>
                        <option value="name-asc">Nama: A - Z</option>
                    </select>
                </div>
                <div class="col-5 col-md-3 d-flex justify-content-end gap-2">
                    <button type="button" class="view-toggle-btn active" id="btnTableView" title="Tampilan Tabel">
                        <i class="bi bi-list-ul me-1"></i> <span class="d-none d-sm-inline">Tabel</span>
                    </button>
                    <button type="button" class="view-toggle-btn" id="btnGridView" title="Tampilan Kartu">
                        <i class="bi bi-grid-fill me-1"></i> <span class="d-none d-sm-inline">Grid</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($totalProducts > 0)
        <!-- TABLE VIEW -->
        <div id="tableViewContainer" class="pm-card overflow-hidden">
            <div class="table-responsive">
                <table class="table pm-table" id="productTable">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        @foreach($products as $product)
                            <tr class="product-item"
                                data-name="{{ strtolower($product->nama_produk) }}"
                                data-desc="{{ strtolower($product->deskripsi_produk) }}"
                                data-price="{{ $product->harga_satuan }}"
                                data-date="{{ $product->created_at->timestamp }}">
                                <td class="fw-semibold text-muted row-index">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($product->foto_produk)
                                            <img src="{{ asset('images/' . $product->foto_produk) }}"
                                                 alt="{{ $product->nama_produk }}"
                                                 class="product-thumb">
                                        @else
                                            <div class="product-thumb-placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('products.show', $product->id) }}"
                                               class="fw-bold text-decoration-none text-body d-block mb-1">
                                                {{ $product->nama_produk }}
                                            </a>
                                            <span class="badge rounded-pill text-bg-light border text-muted fw-normal" style="font-size: 0.7rem;">
                                                ID #{{ $product->id }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="price-tag">
                                        Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td style="max-width: 280px;">
                                    <span class="text-muted small d-block">
                                        {{ Str::limit($product->deskripsi_produk, 65) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small fw-medium">{{ $product->created_at->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $product->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('products.show', $product->id) }}"
                                           class="btn-action view" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn-action edit" title="Edit Produk">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button"
                                                class="btn-action delete"
                                                title="Hapus Produk"
                                                onclick="confirmDelete('{{ route('products.destroy', $product->id) }}', '{{ addslashes($product->nama_produk) }}')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--pm-border) !important;">
                <small class="text-muted">Menampilkan <strong id="visibleCount">{{ $totalProducts }}</strong> dari {{ $totalProducts }} produk</small>
            </div>
        </div>

        <!-- GRID VIEW -->
        <div id="gridViewContainer" class="row g-4 d-none">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 product-grid-col"
                     data-name="{{ strtolower($product->nama_produk) }}"
                     data-desc="{{ strtolower($product->deskripsi_produk) }}"
                     data-price="{{ $product->harga_satuan }}"
                     data-date="{{ $product->created_at->timestamp }}">
                    <div class="pm-card pm-card-hover product-grid-card">
                        <div class="product-grid-img-wrap">
                            @if($product->foto_produk)
                                <img src="{{ asset('images/' . $product->foto_produk) }}"
                                     alt="{{ $product->nama_produk }}">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i class="bi bi-image fs-1 opacity-50"></i>
                                    <small class="mt-1">Tanpa Foto</small>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge rounded-pill bg-dark bg-opacity-75 text-white px-3 py-2 shadow-sm">
                                    Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h6 class="fw-bold mb-0 text-truncate" title="{{ $product->nama_produk }}">
                                    {{ $product->nama_produk }}
                                </h6>
                            </div>
                            <p class="text-muted small mb-3 flex-grow-1">
                                {{ Str::limit($product->deskripsi_produk, 75) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: var(--pm-border) !important;">
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $product->created_at->format('d M Y') }}
                                </small>
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn-action view" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn-action edit" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn-action delete" title="Hapus"
                                            onclick="confirmDelete('{{ route('products.destroy', $product->id) }}', '{{ addslashes($product->nama_produk) }}')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty Filter Result State -->
        <div id="noFilterResult" class="pm-card text-center py-5 d-none">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                 style="width: 72px; height: 72px; background: var(--pm-primary-soft); color: var(--pm-primary);">
                <i class="bi bi-search fs-2"></i>
            </div>
            <h5 class="fw-bold">Produk tidak ditemukan</h5>
            <p class="text-muted mb-3">Tidak ada produk yang cocok dengan kata kunci pencarian Anda.</p>
            <button type="button" id="resetFilterBtn" class="btn btn-pm-soft px-4 py-2">
                Reset Pencarian
            </button>
        </div>
    @else
        <!-- Empty Database State -->
        <div class="pm-card text-center py-5 px-3">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                 style="width: 84px; height: 84px; background: var(--pm-primary-soft); color: var(--pm-primary);">
                <i class="bi bi-box-seam display-5"></i>
            </div>
            <h4 class="fw-bold mt-2">Belum Ada Produk di Katalog</h4>
            <p class="text-muted mx-auto mb-4" style="max-width: 420px;">
                Mulai kelola inventaris Anda dengan menambahkan produk pertama lengkap dengan foto, harga satuan, dan deskripsi.
            </p>
            <a href="{{ route('products.create') }}" class="btn btn-pm-primary px-4 py-2">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk Pertama
            </a>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const btnTableView = document.getElementById('btnTableView');
        const btnGridView = document.getElementById('btnGridView');
        const tableViewContainer = document.getElementById('tableViewContainer');
        const gridViewContainer = document.getElementById('gridViewContainer');
        const noFilterResult = document.getElementById('noFilterResult');
        const resetFilterBtn = document.getElementById('resetFilterBtn');
        const visibleCountEl = document.getElementById('visibleCount');

        if (!searchInput) return;

        let currentView = localStorage.getItem('pm-view-mode') || 'table';
        setViewMode(currentView);

        btnTableView.addEventListener('click', () => setViewMode('table'));
        btnGridView.addEventListener('click', () => setViewMode('grid'));

        function setViewMode(mode) {
            currentView = mode;
            localStorage.setItem('pm-view-mode', mode);
            if (mode === 'grid') {
                btnGridView.classList.add('active');
                btnTableView.classList.remove('active');
                tableViewContainer.classList.add('d-none');
                gridViewContainer.classList.remove('d-none');
            } else {
                btnTableView.classList.add('active');
                btnGridView.classList.remove('active');
                gridViewContainer.classList.add('d-none');
                tableViewContainer.classList.remove('d-none');
            }
            applyFilterAndSort();
        }

        function applyFilterAndSort() {
            const query = searchInput.value.trim().toLowerCase();
            const sortBy = sortSelect.value;

            const tableBody = document.getElementById('productTableBody');
            const tableRows = Array.from(tableBody.querySelectorAll('.product-item'));
            const gridCols = Array.from(gridViewContainer.querySelectorAll('.product-grid-col'));

            const comparator = (a, b) => {
                if (sortBy === 'price-asc') return Number(a.dataset.price) - Number(b.dataset.price);
                if (sortBy === 'price-desc') return Number(b.dataset.price) - Number(a.dataset.price);
                if (sortBy === 'name-asc') return a.dataset.name.localeCompare(b.dataset.name);
                return Number(b.dataset.date) - Number(a.dataset.date);
            };

            tableRows.sort(comparator).forEach(row => tableBody.appendChild(row));
            gridCols.sort(comparator).forEach(col => gridViewContainer.appendChild(col));

            let visibleCount = 0;
            tableRows.forEach((row) => {
                const match = row.dataset.name.includes(query) || row.dataset.desc.includes(query);
                row.classList.toggle('d-none', !match);
                if (match) {
                    visibleCount++;
                    const idxCell = row.querySelector('.row-index');
                    if (idxCell) idxCell.textContent = visibleCount;
                }
            });

            gridCols.forEach((col) => {
                const match = col.dataset.name.includes(query) || col.dataset.desc.includes(query);
                col.classList.toggle('d-none', !match);
            });

            if (visibleCountEl) visibleCountEl.textContent = visibleCount;

            if (visibleCount === 0) {
                noFilterResult.classList.remove('d-none');
                tableViewContainer.classList.add('d-none');
                gridViewContainer.classList.add('d-none');
            } else {
                noFilterResult.classList.add('d-none');
                if (currentView === 'grid') {
                    gridViewContainer.classList.remove('d-none');
                } else {
                    tableViewContainer.classList.remove('d-none');
                }
            }
        }

        searchInput.addEventListener('input', applyFilterAndSort);
        sortSelect.addEventListener('change', applyFilterAndSort);

        if (resetFilterBtn) {
            resetFilterBtn.addEventListener('click', () => {
                searchInput.value = '';
                sortSelect.value = 'newest';
                applyFilterAndSort();
            });
        }
    });
</script>
@endpush
