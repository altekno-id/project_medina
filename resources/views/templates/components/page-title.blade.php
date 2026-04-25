<?php

use Livewire\Component;

new class extends Component {
    public $data = [];

    public function mount($data)
    {
        $this->data = $data;
    }
};
?>

<div>
    <div class="row">
        <div class="col-md col-12">
            <h4 class="mb-0">{{ $data['title'] }}</h4>
            <p>{{ $data['desc'] }}</p>
        </div>
        <div class="col-md col-12 text-md-end">
            @if (isset($data['link']))
                <a href="{{ $data['link'] }}" class="btn btn-{{ $data['btn_type'] }} btn-md mt-md-5 mb-md-0 mb-2">
                    @if (isset($data['icon']))
                        <span class="icon-md icon-base ti {{ $data['icon'] }} me-2"></span>
                    @endif
                    {{ $data['link_title'] }}
                </a>
            @endif
        </div>
    </div>
</div>
