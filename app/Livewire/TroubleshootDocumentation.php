<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TroubleshootTopic;

class TroubleshootDocumentation extends Component
{
    public $topicsTree = [];

    public function mount()
    {
        $topics = TroubleshootTopic::with(['category', 'subcategory', 'subSubcategory'])->get();

        foreach ($topics as $t) {
            $cat = $t->category->name ?? 'Uncategorized';

            // CASE 1: Ada Subkategori & Sub-Subkategori
            if ($t->subcategory && $t->subSubcategory) {
                $sub = $t->subcategory->name;
                $subsub = $t->subSubcategory->name;
                $this->topicsTree[$cat][$sub][$subsub][] = [
                    'title' => $t->title,
                    'content' => $t->content,
                    'video_url' => $t->video_url,
                ];
            }

            // CASE 2: Hanya ada Subkategori
            elseif ($t->subcategory && !$t->subSubcategory) {
                $sub = $t->subcategory->name;
                $this->topicsTree[$cat][$sub][] = [
                    'title' => $t->title,
                    'content' => $t->content,
                    'video_url' => $t->video_url,
                ];
            }

            // CASE 3: Langsung dari kategori
            else {
                $this->topicsTree[$cat][] = [
                    'title' => $t->title,
                    'content' => $t->content,
                    'video_url' => $t->video_url,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.troubleshoot-documentation', [
            'topicsTree' => $this->topicsTree,
        ]);
    }
}
