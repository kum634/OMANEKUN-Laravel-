<?php

namespace App\Livewire;

use App\Livewire\Forms\HistorySearchForm;
use App\Services\HistorySearchService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * 履歴検索 Livewire コンポーネント
 *
 * /history ページの検索フォームを処理するコンポーネント
 */
class HistorySearch extends Component
{
    public HistorySearchForm $form;

    private readonly HistorySearchService $historySearchService;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // 検索結果
    public $message = '';

    public $messageType = '';

    // 検索条件（ページネーション時に使用）
    public $searchData = [];

    public ?string $currentSortColumn = '';

    public ?string $currentSortOrder = '';

    public function mount() {}

    public function boot(HistorySearchService $historySearchService)
    {
        $this->historySearchService = $historySearchService;
    }

    /**
     * コンポーネントのレンダリング
     */
    public function render()
    {
        try {
            // 検索を実行（ページネーション対応）
            $results = $this->historySearchService
                ->searchRequests($this->searchData)
                ->paginate((int) $this->form->per_page);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->message = 'データの読み込みに失敗しました。';
            $this->messageType = 'warning';
        }

        return view(
            'livewire.history-search',
            [
                'results' => $results,
                'currentSortColumn' => $this->currentSortColumn,
                'currentSortOrder' => $this->currentSortOrder,
            ]
        );
    }

    /**
     * コンポーネントのレンダリング
     */
    public function search(): void
    {
        $this->searchData = $this->form->all();
        $this->resetPage();
        $this->dispatch('close-search-modal');
    }

    /**
     * 並べ替え
     */
    public function sort($column, $order): void
    {
        $this->form->column = $column;
        $this->form->order = $order;
        $this->currentSortColumn = $column;
        $this->currentSortOrder = $order;
        $this->searchData = $this->form->all();
        $this->setPage($this->paginators['page']);
    }

    /**
     * 簡易検索
     * (updated + Form名 + プロパティ名) → updatedFormQuickKeyword
     */
    public function updatedFormQuickKeyword(): void
    {
        $this->searchData = $this->form->all();
        $this->currentSortColumn = $this->form->column;
        $this->currentSortOrder = $this->form->order;
        $this->resetPage();
    }

    /**
     * 表示件数変更
     * (updated + Form名 + プロパティ名) → updatedFormPerPage
     */
    public function updatedFormPerPage(): void
    {
        $this->searchData = $this->form->all();
        // dd($this->searchData);
        $this->resetPage();
    }

    /**
     * フォームリセット
     */
    public function clear(): void
    {
        $this->form->reset();
        $this->resetPage();
    }
}
