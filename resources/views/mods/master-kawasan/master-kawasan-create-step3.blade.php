<div id="step3">
    <div class="content-header mb-4">
        <h6 class="mb-0">File & Dokumen</h6>
        <small>Upload gambar denah, surat, atau dokumen pendukung kawasan</small>
    </div>

    <div class="row g-6">
        <div class="col-12">
            @forelse ($form['files'] ?? [] as $fileIndex => $file)
                <div class="card border mb-4" wire:key="file-row-{{ $fileIndex }}">
                    <div class="card-body">
                        <div class="row g-4 align-items-end">

                            <div class="col-12 col-md-5">
                                <label class="form-label">Judul Dokumen</label>
                                <input
                                    type="text"
                                    class="form-control @error('form.files.' . $fileIndex . '.judul_file') is-invalid @enderror"
                                    placeholder="Contoh: Denah Kawasan"
                                    wire:model="form.files.{{ $fileIndex }}.judul_file">

                                @error('form.files.' . $fileIndex . '.judul_file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-5">
                                <label class="form-label">File</label>
                                <input
                                    type="file"
                                    class="form-control @error('form.files.' . $fileIndex . '.file') is-invalid @enderror"
                                    wire:model="form.files.{{ $fileIndex }}.file"
                                    accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx">

                                @error('form.files.' . $fileIndex . '.file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div wire:loading wire:target="form.files.{{ $fileIndex }}.file">
                                    <small class="text-primary">Mengupload file...</small>
                                </div>
                            </div>

                            <div class="col-12 col-md-2 text-md-end">
                                <button
                                    type="button"
                                    class="btn btn-label-danger w-100"
                                    wire:click="removeFile({{ $fileIndex }})">
                                    <i class="icon-base ti tabler-trash icon-xs"></i>
                                </button>
                            </div>

                            @if (!empty($file['file']))
                                <div class="col-12">
                                    <div class="alert alert-secondary mb-0 d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="icon-base ti tabler-paperclip me-1"></i>

                                            @if (is_object($file['file']))
                                                {{ $file['file']->getClientOriginalName() }}
                                            @else
                                                File sudah dipilih
                                            @endif
                                        </div>

                                        @if (is_object($file['file']) && in_array($file['file']->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'webp']))
                                            <a
                                                href="{{ $file['file']->temporaryUrl() }}"
                                                target="_blank"
                                                class="btn btn-sm btn-label-primary">
                                                Preview
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary mb-0">
                    Belum ada dokumen. Klik <strong>Tambah File</strong> untuk menambahkan dokumen.
                </div>
            @endforelse
        </div>
    </div>

    <hr>

    <div class="row g-6">
        <div class="col-12 d-flex justify-content-between">
            <button type="button" class="btn btn-label-secondary" wire:click="prevStep">
                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Kembali</span>
            </button>

            <button type="submit" class="btn btn-success">
                <i class="icon-base ti tabler-device-floppy icon-xs me-sm-2 me-0"></i>
                <span class="align-middle">Simpan</span>
            </button>
        </div>
    </div>
</div>
