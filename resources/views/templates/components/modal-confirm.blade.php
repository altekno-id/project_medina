<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {

    public $data = [];

    #[On('modal-confirm-generateDataConfirm')]
    public function generateDataConfirm($data)
    {
        $this->data = $data;
    }

    public function process()
    {
        $this->dispatch($this->data['dispatch']);
    }
};
?>

<div>
    <div wire:ignore.self class="modal fade" id="modalConfirm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col text-center">
                            <span class="badge bg-label-{{ $data['color'] ?? 'secondary' }} rounded mb-4 p-2">
                                <i class="icon-base ti tabler-{{ $data['icon'] ?? 'alert-triangle' }} icon-50px"></i>
                            </span>
                            <h4 class="card-title mb-4">Konfirmasi {{ $data['label'] ?? null }}</h4>
                            <p class="card-text">
                                Apakah anda yakin {{ $data['msg'] ?? null }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button wire:click="process()" type="button" class="btn btn-{{ $data['color'] ?? 'secondary' }}">Ya, lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
</div>
