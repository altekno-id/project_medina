<?php

namespace App\Livewire\MasterKawasan;

use App\Repositories\MasterKawasanRepo;
use Livewire\Component;
use Livewire\WithFileUploads;


class MasterKawasanCreate extends Component
{
    use WithFileUploads;

    public int $step = 1;

    public $form = [];

    public string $clusterName = '';

    public function mount()
    {
        $this->form = [
            'master_kawasans' => [
                'nama_master_kawasan' => '',
                'alamat_master_kawasan' => '',
                'latitude' => 1.6660311220282815,
                'longitude' => 101.4011585618487,
            ],
            'master_kawasan_subs' => [],
            'files' => [],
        ];
    }

    public function addFile()
    {
        $this->form['files'][] = [
            'judul_file' => '',
            'file' => null,
            'nama_file' => null,
        ];
    }

    public function removeFile($fileIndex)
    {
        unset($this->form['files'][$fileIndex]);

        $this->form['files'] = array_values($this->form['files']);
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate($this->rulesStep1(), [], $this->validationAttributes);
        }

        if ($this->step === 2) {
            $this->validate($this->rulesStep2(), [], $this->validationAttributes);
        }

        if ($this->step === 3) {
            $this->validate($this->rulesStep3(), [], $this->validationAttributes);
        }

        if ($this->step < 3) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;

            if ($this->step === 1) {
                $this->dispatch('init-map');
            }
        }
    }

    public function goToStep($targetStep)
    {
        $targetStep = (int) $targetStep;

        if ($targetStep < 1 || $targetStep > 3) {
            return;
        }

        if ($targetStep > 1) {
            $this->validate($this->rulesStep1(), [], $this->validationAttributes);
        }

        if ($targetStep > 2) {
            $this->validate($this->rulesStep2(), [], $this->validationAttributes);
        }

        $this->step = $targetStep;

        if ($this->step === 1) {
            $this->dispatch('init-map');
        }
    }

    public function addCluster()
    {
        $this->validate([
            'clusterName' => 'required|string|max:255',
        ], [], [
            'clusterName' => 'Nama Cluster',
        ]);

        $this->form['master_kawasan_subs'][] = [
            'nama_master_kawasan_sub' => $this->clusterName,
            'bloks' => [],
            'blokName' => '',
        ];

        $this->reset('clusterName');
    }

    public function removeCluster($clusterIndex)
    {
        unset($this->form['master_kawasan_subs'][$clusterIndex]);

        $this->form['master_kawasan_subs'] = array_values($this->form['master_kawasan_subs']);
    }

    public function addBlok($clusterIndex)
    {
        $blokName = $this->form['master_kawasan_subs'][$clusterIndex]['blokName'] ?? null;

        if (!$blokName) {
            $this->addError("form.master_kawasan_subs.$clusterIndex.blokName", 'Nama Blok wajib diisi.');
            return;
        }

        $this->form['master_kawasan_subs'][$clusterIndex]['bloks'][] = [
            'nama_master_kawasan_sub_blok' => $blokName,
        ];

        $this->form['master_kawasan_subs'][$clusterIndex]['blokName'] = '';

        $this->resetErrorBag("form.master_kawasan_subs.$clusterIndex.blokName");
    }

    public function removeBlok($clusterIndex, $blokIndex)
    {
        unset($this->form['master_kawasan_subs'][$clusterIndex]['bloks'][$blokIndex]);

        $this->form['master_kawasan_subs'][$clusterIndex]['bloks'] = array_values(
            $this->form['master_kawasan_subs'][$clusterIndex]['bloks']
        );
    }

    public function addInfo()
    {
        $this->form['master_kawasans']['info_master_kawasan'][] = [
            'label' => '',
            'value' => '',
        ];
    }

    public function removeInfo($infoIndex)
    {
        unset($this->form['master_kawasans']['info_master_kawasan'][$infoIndex]);

        $this->form['master_kawasans']['info_master_kawasan'] = array_values(
            $this->form['master_kawasans']['info_master_kawasan']
        );
    }

    public function rulesStep1()
    {
        return [
            'form.master_kawasans.nama_master_kawasan' => 'required|string|max:255',
            'form.master_kawasans.alamat_master_kawasan' => 'required|string',
            'form.master_kawasans.latitude' => 'required',
            'form.master_kawasans.longitude' => 'required',
            'form.master_kawasans.info_master_kawasan.*.value' => 'required_with:form.master_kawasans.info_master_kawasan.*.label|string|max:255',
        ];
    }

    public function rulesStep2()
    {
        return [
            'form.master_kawasan_subs' => 'required|array|min:1',
            'form.master_kawasan_subs.*.nama_master_kawasan_sub' => 'required|string|max:255',
            'form.master_kawasan_subs.*.bloks' => 'required|array|min:1',
            'form.master_kawasan_subs.*.bloks.*.nama_master_kawasan_sub_blok' => 'required|string|max:255',
        ];
    }

    public function rulesStep3()
    {
        return [
            'form.files' => 'nullable|array',
            'form.files.*.judul_file' => 'required_with:form.files.*.file|string|max:255',
            'form.files.*.file' => 'required_with:form.files.*.judul_file|file|max:5120',
        ];
    }

    public function rules()
    {
        return array_merge(
            $this->rulesStep1(),
            $this->rulesStep2(),
            $this->rulesStep3()
        );
    }

    public $validationAttributes = [
        'form.master_kawasans.nama_master_kawasan' => 'Nama Kawasan',
        'form.master_kawasans.alamat_master_kawasan' => 'Alamat Kawasan',
        'form.master_kawasans.latitude' => 'Latitude',
        'form.master_kawasans.longitude' => 'Longitude',
        'form.master_kawasans.info_master_kawasan' => 'Info Tambahan',
        'form.master_kawasans.info_master_kawasan.*.label' => 'Label Informasi',
        'form.master_kawasans.info_master_kawasan.*.value' => 'Nilai / Deskripsi',

        'form.master_kawasan_subs' => 'Cluster',
        'form.master_kawasan_subs.*.nama_master_kawasan_sub' => 'Nama Cluster',
        'form.master_kawasan_subs.*.bloks' => 'Blok',
        'form.master_kawasan_subs.*.bloks.*.nama_master_kawasan_sub_blok' => 'Nama Blok',

        'form.files' => 'File Dokumen',
        'form.files.*.judul_file' => 'Judul Dokumen',
        'form.files.*.file' => 'File Dokumen',
    ];

    public function save()
    {
        $this->validate($this->rules(), [], $this->validationAttributes);

        $data = [
            'master_kawasans' => [
                'nama_master_kawasan' => $this->form['master_kawasans']['nama_master_kawasan'],
                'alamat_master_kawasan' => $this->form['master_kawasans']['alamat_master_kawasan'],
                'latitude' => $this->form['master_kawasans']['latitude'],
                'longitude' => $this->form['master_kawasans']['longitude'],
                'info_master_kawasan' => json_encode([
                    'keterangan' => null,
                ]),
            ],
            'master_kawasan_subs' => collect($this->form['master_kawasan_subs'] ?? [])
                ->map(function ($cluster) {
                    return [
                        'nama_master_kawasan_sub' => $cluster['nama_master_kawasan_sub'],
                        'bloks' => collect($cluster['bloks'] ?? [])
                            ->map(function ($blok) {
                                return [
                                    'nama_master_kawasan_sub_blok' => $blok['nama_master_kawasan_sub_blok'],
                                ];
                            })
                            ->values()
                            ->toArray(),
                    ];
                })
                ->values()
                ->toArray(),
            'files' => $this->form['files'] ?? [],
        ];

        $query = MasterKawasanRepo::storeDt($data);

        if ($query) {
            $this->dispatch('notify', data: [
                'type' => 'success',
                'title' => 'Proses Berhasil',
                'message' => 'Data kawasan baru berhasil ditambahkan.'
            ]);

            $this->resetForm();
            $this->dispatch('init-map');
        } else {
            $this->dispatch('notify', data: [
                'type' => 'error',
                'title' => 'Proses Gagal',
                'message' => 'Proses tidak berhasil, hubungi admin untuk masalah ini.'
            ]);
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->step = 1;
        $this->clusterName = '';

        $this->form = [
            'master_kawasans' => [
                'nama_master_kawasan' => '',
                'alamat_master_kawasan' => '',
                'latitude' => 1.6660311220282815,
                'longitude' => 101.4011585618487,
                'info_master_kawasan' => [],
            ],
            'master_kawasan_subs' => [],
            'files' => [],
        ];
    }


    public function render()
    {
        return view('mods.master-kawasan.master-kawasan-create');
    }
}
