@extends('layouts.app')

@section('title', $product->nama_produk . ' — Detail Produk')

@section('content')
    <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <a href="{{ route('products.index') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center gap-1 mb-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Katalog Produk
            </a>
            <h2 class="fw-bold mb-0">Detail Informasi Produk</h2>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning rounded-3 px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-pencil-square"></i> Edit Produk
            </a>
            <button type="button"
                    class="btn btn-outline-danger rounded-3 px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2"
                    onclick="confirmDelete('{{ route('products.destroy', $product->id) }}', '{{ addslashes($product->nama_produk) }}')">
                <i class="bi bi-trash3"></i> Hapus
            </button>
        </div>
    </div>

    <div class="pm-card overflow-hidden p-4 p-md-5">
        <div class="row g-4 g-lg-5 align-items-start">
            <!-- Image Showcase -->
            <div class="col-12 col-md-5">
                <div class="rounded-4 overflow-hidden border d-flex align-items-center justify-content-center"
                     style="min-height: 320px; max-height: 400px; background: linear-gradient(135deg, rgba(79, 70, 229, 0.08), rgba(6, 182, 212, 0.08)); border-color: var(--pm-border) !important;">
                    @if($product->foto_produk)
                        <img src="{{ asset('images/' . $product->foto_produk) }}"
                             alt="{{ $product->nama_produk }}"
                             class="w-100 h-100 object-fit-cover"
                             style="max-height: 400px;">
                    @else
                        <div class="text-center p-5 text-muted">
                            <i class="bi bi-image display-1 opacity-50"></i>
                            <p class="mt-2 mb-0 fw-medium">Tidak ada foto produk</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-12 col-md-7">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="badge rounded-pill px-3 py-2 fw-semibold"
                          style="background: var(--pm-primary-soft); color: var(--pm-primary);">
                        <i class="bi bi-box-seam me-1"></i> Produk Terdaftar
                    </span>
                    <span class="badge rounded-pill text-bg-light border px-3 py-2 text-muted fw-medium">
                        ID #{{ $product->id }}
                    </span>
                </div>

                <h1 class="fw-extrabold mb-3" style="font-size: clamp(1.5rem, 2.5vw, 2.25rem); letter-spacing: -0.02em;">
                    {{ $product->nama_produk }}
                </h1>

                <div class="p-3 rounded-4 mb-4 d-inline-block" style="background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.2);">
                    <div class="text-muted small fw-semibold mb-1">Harga Satuan</div>
                    <div class="fs-2 fw-extrabold" style="color: var(--pm-success); line-height: 1.1;">
                        Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small fw-bold mb-2" style="letter-spacing: 0.05em;">
                        Deskripsi Produk
                    </h6>
                    <div class="p-3 rounded-4 border" style="background: rgba(148, 163, 184, 0.04); border-color: var(--pm-border) !important; white-space: pre-line; line-height: 1.7;">{{ $product->deskripsi_produk }}</div>
                </div>

                <div class="row g-3 pt-3 border-top" style="border-color: var(--pm-border) !important;">
                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 border" style="border-color: var(--pm-border) !important;">
                            <div class="rounded-3 d-flex align-items-center justify-content-center"
                                 style="width: 42px; height: 42px; background: var(--pm-primary-soft); color: var(--pm-primary);">
                                <i class="bi bi-calendar-plus fs-5"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Tanggal Dibuat</div>
                                <div class="fw-semibold small">{{ $product->created_at->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 border" style="border-color: var(--pm-border) !important;">
                            <div class="rounded-3 d-flex align-items-center justify-content-center"
                                 style="width: 42px; height: 42px; background: rgba(6, 182, 212, 0.12); color: #06b6d4;">
                                <i class="bi bi-clock-history fs-5"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Terakhir Diperbarui</div>
                                <div class="fw-semibold small">{{ $product->updated_at->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
