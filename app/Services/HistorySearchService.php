<?php

namespace App\Services;

use App\Repositories\HistorySearchRepository;

/**
 * 整備依頼検索サービス
 *
 * 検索に関するビジネスロジックを担当するサービスクラス
 */
class HistorySearchService
{
    protected HistorySearchRepository $historySearchRepository;

    public function __construct(HistorySearchRepository $historySearchRepository)
    {
        $this->historySearchRepository = $historySearchRepository;
    }

    /**
     * 検索条件に基づいて整備依頼を取得（ページネーション対応）
     */
    public function searchRequests(array $searchData)
    {
        return $this->historySearchRepository->searchRequests($searchData);
    }
}
