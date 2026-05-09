<?php

namespace App\Livewire\Dashboard;

use App\Repositories\DashboardRepo;
use Livewire\Component;

class DashboardData extends Component
{
    public $summary = [];
    public $finance = [];
    public $progress = [];
    public $latestPurchaseOrders = [];
    public $latestPermintaanDanas = [];
    public $unitTerbaru = [];

    public function mount()
    {
        $data = DashboardRepo::getData();

        $this->summary = $data['summary'];
        $this->finance = $data['finance'];
        $this->progress = $data['progress'];
        $this->latestPurchaseOrders = $data['latest_purchase_orders'];
        $this->latestPermintaanDanas = $data['latest_permintaan_danas'];
        $this->unitTerbaru = $data['unit_terbaru'];
    }

    public function render()
    {
        return view('mods.dashboard.dashboard-data');
    }
}
