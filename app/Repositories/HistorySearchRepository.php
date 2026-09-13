<?php

namespace App\Repositories;

use App\Models\Requests;
use Illuminate\Support\Facades\Auth;

class HistorySearchRepository
{
    /**
     * 検索条件に基づいて整備依頼を取得
     */
    public function searchRequests(array $searchData)
    {
        $uid = Auth::user()->id;
        $query = Requests::where('UID', $uid);
        $query->where('visible', 1);

        // 検索条件が空の場合は全件取得
        $hasSearchConditions = $this->hasSearchConditions($searchData);

        if ($hasSearchConditions) {
            // 入庫日の検索条件を追加
            $this->addStorageDateCondition($query, $searchData);
            // 納車予定日の検索条件を追加
            $this->addRetrievalDateCondition($query, $searchData);
            // 車検証の有効期限の検索条件を追加
            $this->addInspectionDateCondition($query, $searchData);
            // お客様情報の検索条件を追加
            $this->addCustomerConditions($query, $searchData);
            // 車両情報の検索条件を追加
            $this->addVehicleConditions($query, $searchData);
            // 整備情報の検索条件を追加
            $this->addMaintenanceConditions($query, $searchData);
            // 特記事項の検索条件を追加
            $this->addNoticesConditions($query, $searchData);
            // 簡易検索のキーワードを追加
            $this->addQuickKeywordCondition($query, $searchData);
        }

        // ソート順を設定
        if (! empty($searchData['column']) && ! empty($searchData['order'])) {
            $query->orderBy($searchData['column'], $searchData['order']);
        } else {
            $query->orderBy('updated', 'desc');
        }

        return $query;
    }

    /**
     * 簡易検索のキーワードを追加
     */
    private function addQuickKeywordCondition($query, array $searchData)
    {
        $keyword = $searchData['quick_keyword'] ?? '';
        if (! empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('storage_date', 'LIKE', "%{$keyword}%")
                    ->orWhere('retrieval_date', 'LIKE', "%{$keyword}%")
                    ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('first_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('car_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('model', 'LIKE', "%{$keyword}%")
                    ->orWhere('license', 'LIKE', "%{$keyword}%")
                    ->orWhere('maintenance_type', 'LIKE', "%{$keyword}%");
            });
        }
    }

    /**
     * 入庫日の検索条件を追加
     */
    private function addStorageDateCondition($query, array $searchData)
    {
        $y = $searchData['storage_date_y'] ?? '';
        $m = $searchData['storage_date_m'] ?? '';
        $d = $searchData['storage_date_d'] ?? '';

        if (! empty($y) && ! empty($m) && ! empty($d)) {
            // 年月日すべて指定
            $storageDate = "{$y}-{$m}-{$d}";
            $query->where('storage_date', $storageDate);
        } elseif (! empty($y) && ! empty($m) && empty($d)) {
            // 年月のみ指定
            $storageDate = "{$y}-{$m}-";
            $query->where('storage_date', 'LIKE', "{$storageDate}%");
        } elseif (! empty($y) && empty($m) && empty($d)) {
            // 年のみ指定
            $storageDate = "{$y}-";
            $query->where('storage_date', 'LIKE', "{$storageDate}%");
        } elseif (empty($y) && ! empty($m) && ! empty($d)) {
            // 月日のみ指定
            $storageDate = "-{$m}-{$d}";
            $query->where('storage_date', 'LIKE', "%{$storageDate}");
        } elseif (empty($y) && ! empty($m) && empty($d)) {
            // 月のみ指定
            $storageDate = "-{$m}-";
            $query->where('storage_date', 'LIKE', "%{$storageDate}%");
        }
    }

    /**
     * 納車予定日の検索条件を追加
     */
    private function addRetrievalDateCondition($query, array $searchData)
    {
        $y = $searchData['retrieval_date_y'] ?? '';
        $m = $searchData['retrieval_date_m'] ?? '';
        $d = $searchData['retrieval_date_d'] ?? '';

        if (! empty($y) && ! empty($m) && ! empty($d)) {
            $retrievalDate = "{$y}-{$m}-{$d}";
            $query->where('retrieval_date', $retrievalDate);
        } elseif (! empty($y) && ! empty($m) && empty($d)) {
            $retrievalDate = "{$y}-{$m}-";
            $query->where('retrieval_date', 'LIKE', "{$retrievalDate}%");
        } elseif (! empty($y) && empty($m) && empty($d)) {
            $retrievalDate = "{$y}-";
            $query->where('retrieval_date', 'LIKE', "{$retrievalDate}%");
        } elseif (empty($y) && ! empty($m) && ! empty($d)) {
            $retrievalDate = "-{$m}-{$d}";
            $query->where('retrieval_date', 'LIKE', "%{$retrievalDate}");
        } elseif (empty($y) && ! empty($m) && empty($d)) {
            $retrievalDate = "-{$m}-";
            $query->where('retrieval_date', 'LIKE', "%{$retrievalDate}%");
        }
    }

    /**
     * 車検証の有効期限の検索条件を追加
     */
    private function addInspectionDateCondition($query, array $searchData)
    {
        $y = $searchData['inspection_date_y'] ?? '';
        $m = $searchData['inspection_date_m'] ?? '';
        $d = $searchData['inspection_date_d'] ?? '';

        if (! empty($y) && ! empty($m) && ! empty($d)) {
            $inspectionDate = "{$y}-{$m}-{$d}";
            $query->where('inspection_date', $inspectionDate);
        } elseif (! empty($y) && ! empty($m) && empty($d)) {
            $inspectionDate = "{$y}-{$m}-";
            $query->where('inspection_date', 'LIKE', "{$inspectionDate}%");
        } elseif (! empty($y) && empty($m) && empty($d)) {
            $inspectionDate = "{$y}-";
            $query->where('inspection_date', 'LIKE', "{$inspectionDate}%");
        } elseif (empty($y) && ! empty($m) && ! empty($d)) {
            $inspectionDate = "-{$m}-{$d}";
            $query->where('inspection_date', 'LIKE', "%{$inspectionDate}");
        } elseif (empty($y) && ! empty($m) && empty($d)) {
            $inspectionDate = "-{$m}-";
            $query->where('inspection_date', 'LIKE', "%{$inspectionDate}%");
        }
    }

    /**
     * お客様情報の検索条件を追加
     */
    private function addCustomerConditions($query, array $searchData)
    {
        if (! empty($searchData['last_name'])) {
            $query->where('last_name', $searchData['last_name']);
        }
        if (! empty($searchData['first_name'])) {
            $query->where('first_name', $searchData['first_name']);
        }
        if (! empty($searchData['tel'])) {
            $query->where('tel', $searchData['tel']);
        }
        if (! empty($searchData['mailaddress'])) {
            $query->where('mailaddress', $searchData['mailaddress']);
        }
    }

    /**
     * 車両情報の検索条件を追加
     */
    private function addVehicleConditions($query, array $searchData)
    {
        if (! empty($searchData['car_name'])) {
            $query->where('car_name', $searchData['car_name']);
        }
        if (! empty($searchData['license'])) {
            $query->where('license', $searchData['license']);
        }
    }

    /**
     * 整備情報の検索条件を追加
     */
    private function addMaintenanceConditions($query, array $searchData)
    {
        if (! empty($searchData['maintenance_type'])) {
            $maintenanceTypes = is_array($searchData['maintenance_type'])
                ? $searchData['maintenance_type']
                : [$searchData['maintenance_type']];

            foreach ($maintenanceTypes as $value) {
                $query->where('maintenance_type', 'LIKE', "%{$value}%");
            }
        }

        if (! empty($searchData['maintenance_detail'])) {
            $query->where('maintenance_detail', 'LIKE', "%{$searchData['maintenance_detail']}%");
        }

        if (! empty($searchData['wash'])) {
            $query->where('wash', $searchData['wash']);
        }

        if (! empty($searchData['clean'])) {
            $query->where('clean', $searchData['clean']);
        }
    }

    /**
     * 特記事項の検索条件を追加
     */
    private function addNoticesConditions($query, array $searchData)
    {
        if (! empty($searchData['notices'])) {
            $notices = is_array($searchData['notices'])
                ? $searchData['notices']
                : [$searchData['notices']];

            foreach ($notices as $value) {
                $query->where('notices', 'LIKE', "%{$value}%");
            }
        }

        if (! empty($searchData['notices_detail'])) {
            $query->where('notices_detail', 'LIKE', "%{$searchData['notices_detail']}%");
        }
    }

    /**
     * 検索条件が存在するかチェック
     */
    private function hasSearchConditions(array $searchData): bool
    {
        // 空の配列の場合は検索条件なし
        if (empty($searchData)) {
            return false;
        }

        // 日付関連の検索条件
        $dateFields = [
            'storage_date_y',
            'storage_date_m',
            'storage_date_d',
            'retrieval_date_y',
            'retrieval_date_m',
            'retrieval_date_d',
            'inspection_date_y',
            'inspection_date_m',
            'inspection_date_d',
        ];

        foreach ($dateFields as $field) {
            $value = $searchData[$field] ?? '';
            if (! empty($value) && $value !== '' && $value !== '-') {
                return true;
            }
        }

        // その他の検索条件
        $otherFields = [
            'last_name',
            'first_name',
            'tel',
            'mailaddress',
            'car_name',
            'model',
            'license',
            'maintenance_detail',
            'wash',
            'clean',
            'notices_detail',
            'quick_keyword',
        ];

        foreach ($otherFields as $field) {
            $value = $searchData[$field] ?? '';
            if (! empty($value) && $value !== '') {
                return true;
            }
        }

        // 配列フィールド
        if (! empty($searchData['maintenance_type'] ?? []) && is_array($searchData['maintenance_type'])) {
            $maintenanceTypes = array_filter($searchData['maintenance_type'], function ($value) {
                return ! empty($value);
            });
            if (! empty($maintenanceTypes)) {
                return true;
            }
        }

        if (! empty($searchData['notices'] ?? []) && is_array($searchData['notices'])) {
            $notices = array_filter($searchData['notices'], function ($value) {
                return ! empty($value);
            });
            if (! empty($notices)) {
                return true;
            }
        }

        return false;
    }
}
