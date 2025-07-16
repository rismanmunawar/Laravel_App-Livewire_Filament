<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class ShowPage extends Component
{
    public $pageId = null;

    public function mount($pageId)
    {
        $this->pageId = $pageId;
    }
    public function render()
    {
        $page = Page::findOrFail($this->pageId);
        return view('livewire.show-page', [
            'page' => $page
        ]);
    }
}
