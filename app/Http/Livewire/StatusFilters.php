<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $currentStatus;
    public $statusCount;

    public function mount()
    {
        $this->statusCount   = Status::getCount();
        $this->currentStatus = request()->status ?? 'All';

        if (Route::currentRouteName() === 'idea.show') {
            $this->currentStatus = null;
        }
    }

    public function setCurrentStatus($newStatus)
    {
        $this->currentStatus = $newStatus;
        $this->emit('queryStringUpdatedStatus', $this->currentStatus);

        if ($this->getPreviousRouteName() === 'idea.show') {
            return redirect()->route('idea.index', [
                'status' => $this->currentStatus,
                ]);
        }
    }

    public function render()
    {
        return view('livewire.status-filters');
    }

    public function getPreviousRouteName()
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }
}
