<div>
    <div class="loading-50" wire:loading>
        <div class="loader"></div>
    </div>

    <livewire:page-title :data="[
        'title' => 'Data Kawasan Baru',
        'desc' => 'Form data kawasan baru',
    ]" />

    <div class="row">
        <div class="col-12 mb-6">
            <div class="card mt-2">
                <div class="card-body">

                    {{-- Step Header --}}
                    <div class="row mb-5 g-3">

                        <div class="col-12 col-md-4">
                            <button
                                type="button"
                                class="w-100 border-0 bg-transparent text-start p-0"
                                wire:click="goToStep(1)">
                                <div class="d-flex align-items-center gap-3 p-3 rounded border {{ $step === 1 ? 'border-primary bg-label-primary' : '' }}">
                                    <span class="badge rounded-pill {{ $step === 1 ? 'bg-primary' : 'bg-label-secondary' }}">
                                        1
                                    </span>
                                    <div>
                                        <h6 class="mb-0 {{ $step === 1 ? 'text-primary' : '' }}">
                                            Informasi Kawasan
                                        </h6>
                                        <small class="text-muted">
                                            Detail informasi umum kawasan
                                        </small>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div class="col-12 col-md-4">
                            <button
                                type="button"
                                class="w-100 border-0 bg-transparent text-start p-0"
                                wire:click="goToStep(2)">
                                <div class="d-flex align-items-center gap-3 p-3 rounded border {{ $step === 2 ? 'border-primary bg-label-primary' : '' }}">
                                    <span class="badge rounded-pill {{ $step === 2 ? 'bg-primary' : 'bg-label-secondary' }}">
                                        2
                                    </span>
                                    <div>
                                        <h6 class="mb-0 {{ $step === 2 ? 'text-primary' : '' }}">
                                            Cluster & Blok
                                        </h6>
                                        <small class="text-muted">
                                            Detail cluster dan blok
                                        </small>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div class="col-12 col-md-4">
                            <button
                                type="button"
                                class="w-100 border-0 bg-transparent text-start p-0"
                                wire:click="goToStep(3)">
                                <div class="d-flex align-items-center gap-3 p-3 rounded border {{ $step === 3 ? 'border-primary bg-label-primary' : '' }}">
                                    <span class="badge rounded-pill {{ $step === 3 ? 'bg-primary' : 'bg-label-secondary' }}">
                                        3
                                    </span>
                                    <div>
                                        <h6 class="mb-0 {{ $step === 3 ? 'text-primary' : '' }}">
                                            File & Dokumen
                                        </h6>
                                        <small class="text-muted">
                                            Detail arsip dokumen
                                        </small>
                                    </div>
                                </div>
                            </button>
                        </div>

                    </div>

                    {{-- Step Content --}}
                    <form wire:submit.prevent="save">

                        @if ($step === 1)
                            @include('master-kawasan.master-kawasan-create-step1')
                        @elseif ($step === 2)
                            @include('master-kawasan.master-kawasan-create-step2')
                        @elseif ($step === 3)
                            @include('master-kawasan.master-kawasan-create-step3')
                        @endif

                    </form>

                </div>
            </div>
        </div>
    </div>

    @include('master-kawasan.atc.master-kawasan-create-step1-atc')
</div>
