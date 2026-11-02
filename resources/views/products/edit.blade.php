@extends('layouts.app')

@section('title', 'Edit Produk: ' . $product->nama_produk . ' — Product Monitor')

@section('content')
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center gap-1 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Katalog Produk
        </a>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h2 class="fw-bold mb-1">Edit Produk</h2>
                <p class="text-muted mb-0">Perbarui rincian produk <strong>{{ $product->nama_produk }}</strong>.</p>
            </div>
            <span class="badge rounded-pill text-bg-warning px-3 py-2 fw-semibold">
                <i class="bi bi-pencil-square me-1"></i> Mode Penyuntingan • ID #{{ $product->id }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Form Column -->
        <div class="col-12 col-lg-8">
            <div class="pm-card p-4 p-md-5">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama_produk" class="form-label">
                            Nama Produk <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0" style="border-radius: 12px 0 0 12px; border-color: var(--pm-border);">
                                <i class="bi bi-tag text-muted"></i>
                            </span>
                            <input type="text"
                                   class="form-control border-start-0 ps-0 @error('nama_produk') is-invalid @enderror"
                                   style="border-radius: 0 12px 12px 0;"
                                   id="nama_produk"
                                   name="nama_produk"
                                   value="{{ old('nama_produk', $product->nama_produk) }}"
                                   required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="harga_satuan" class="form-label">
                            Harga Satuan (Rp) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold bg-transparent" style="border-radius: 12px 0 0 12px; border-color: var(--pm-border);">
                                Rp
                            </span>
                            <input type="number"
                                   class="form-control @error('harga_satuan') is-invalid @enderror"
                                   style="border-radius: 0 12px 12px 0;"
                                   id="harga_satuan"
                                   name="harga_satuan"
                                   value="{{ old('harga_satuan', $product->harga_satuan) }}"
                                   min="0"
                                   required>
                            @error('harga_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi_produk" class="form-label">
                            Deskripsi Produk <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('deskripsi_produk') is-invalid @enderror"
                                  id="deskripsi_produk"
                                  name="deskripsi_produk"
                                  rows="4"
                                  required>{{ old('deskripsi_produk', $product->deskripsi_produk) }}</textarea>
                        @error('deskripsi_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="foto_produk" class="form-label">Ganti Foto Produk <span class="text-muted fw-normal">(Biarkan kosong jika tidak ingin mengganti)</span></label>
                        <div class="upload-zone" id="dropZone" onclick="document.getElementById('foto_produk').click()">
                            <input type="file"
                                   class="d-none @error('foto_produk') is-invalid @enderror"
                                   id="foto_produk"
                                   name="foto_produk"
                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                            <div id="uploadPrompt">
                                <div class="mx-auto mb-2 d-flex align-items-center justify-content-center rounded-circle"
                                     style="width: 52px; height: 52px; background: var(--pm-primary-soft); color: var(--pm-primary);">
                                    <i class="bi bi-cloud-arrow-up fs-4"></i>
                                </div>
                                <div class="fw-semibold">Klik untuk mengunggah foto baru atau tarik file ke sini</div>
                                <div class="text-muted small mt-1">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</div>
                            </div>
                            <div id="selectedFileInfo" class="d-none">
                                <span class="badge rounded-pill text-bg-success px-3 py-2">
                                    <i class="bi bi-check2-circle me-1"></i> Foto baru: <span id="fileNameText"></span>
                                </span>
                                <div class="text-muted small mt-2">Klik kembali jika ingin mengganti pilihan gambar</div>
                            </div>
                        </div>
                        @error('foto_produk')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4" style="border-color: var(--pm-border);">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-light rounded-3 px-4 py-2 fw-semibold border">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-pm-primary px-4 py-2 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-save2"></i> Perbarui Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Live Preview Column -->
        <div class="col-12 col-lg-4">
            <div class="sticky-top" style="top: 90px;">
                <div class="text-muted small fw-bold text-uppercase mb-2 px-1" style="letter-spacing: 0.05em;">
                    <i class="bi bi-eye me-1"></i> Pratinjau Perubahan
                </div>
                <div class="pm-card overflow-hidden">
                    <div class="position-relative d-flex align-items-center justify-content-center"
                         style="height: 220px; background: linear-gradient(135deg, rgba(79, 70, 229, 0.08), rgba(6, 182, 212, 0.08));">
                        @if($product->foto_produk)
                            <img id="previewImage"
                                 src="{{ asset('images/' . $product->foto_produk) }}"
                                 alt="{{ $product->nama_produk }}"
                                 class="w-100 h-100 object-fit-cover">
                            <div id="previewPlaceholder" class="text-center text-muted d-none">
                                <i class="bi bi-image display-4 opacity-50"></i>
                                <div class="small mt-1">Belum ada foto</div>
                            </div>
                        @else
                            <img id="previewImage" src="" alt="Preview" class="w-100 h-100 object-fit-cover d-none">
                            <div id="previewPlaceholder" class="text-center text-muted">
                                <i class="bi bi-image display-4 opacity-50"></i>
                                <div class="small mt-1">Belum ada foto</div>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="price-tag mb-2" id="previewPrice">
                            Rp {{ number_format($product->harga_satuan, 0, ',', '.') }}
                        </span>
                        <h5 class="fw-bold mb-2" id="previewName">{{ $product->nama_produk }}</h5>
                        <p class="text-muted small mb-0" id="previewDesc">{{ $product->deskripsi_produk }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('nama_produk');
        const priceInput = document.getElementById('harga_satuan');
        const descInput = document.getElementById('deskripsi_produk');
        const fileInput = document.getElementById('foto_produk');
        const dropZone = document.getElementById('dropZone');

        const previewName = document.getElementById('previewName');
        const previewPrice = document.getElementById('previewPrice');
        const previewDesc = document.getElementById('previewDesc');
        const previewImage = document.getElementById('previewImage');
        const previewPlaceholder = document.getElementById('previewPlaceholder');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const selectedFileInfo = document.getElementById('selectedFileInfo');
        const fileNameText = document.getElementById('fileNameText');

        const formatRupiah = (val) => {
            const num = parseInt(val || 0, 10);
            return 'Rp ' + (isNaN(num) ? '0' : num.toLocaleString('id-ID'));
        };

        nameInput.addEventListener('input', () => {
            previewName.textContent = nameInput.value.trim() || 'Nama Produk';
        });

        priceInput.addEventListener('input', () => {
            previewPrice.textContent = formatRupiah(priceInput.value);
        });

        descInput.addEventListener('input', () => {
            previewDesc.textContent = descInput.value.trim() || 'Deskripsi produk...';
        });

        fileInput.addEventListener('change', handleFileSelect);

        ['dragover', 'dragenter'].forEach(evt => {
            dropZone.addEventListener(evt, (e) => {
                e.preventDefault();
                dropZone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dropZone.addEventListener(evt, (e) => {
                e.preventDefault();
                dropZone.classList.remove('dragover');
            });
        });

        dropZone.addEventListener('drop', (e) => {
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect();
            }
        });

        function handleFileSelect() {
            const file = fileInput.files[0];
            if (!file) return;
            fileNameText.textContent = file.name;
            uploadPrompt.classList.add('d-none');
            selectedFileInfo.classList.remove('d-none');

            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                previewImage.classList.remove('d-none');
                previewPlaceholder.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
