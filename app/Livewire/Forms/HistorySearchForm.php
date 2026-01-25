<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class HistorySearchForm extends Form
{
    // 検索フォームのプロパティ
    public ?string $storage_date_y = '';

    public ?string $storage_date_m = '';

    public ?string $storage_date_d = '';

    public ?string $retrieval_date_y = '';

    public ?string $retrieval_date_m = '';

    public ?string $retrieval_date_d = '';

    public ?string $last_name = '';

    public ?string $first_name = '';

    public ?string $tel = '';

    public ?string $mailaddress = '';

    public ?string $car_name = '';

    public ?string $model = '';

    public ?string $license = '';

    public ?string $inspection_date_y = '';

    public ?string $inspection_date_m = '';

    public ?string $inspection_date_d = '';

    public ?array $maintenance_type = [];

    public ?string $maintenance_detail = '';

    public ?string $wash = '';

    public ?string $clean = '';

    public ?array $notices = [];

    public ?string $notices_detail = '';

    public ?string $quick_keyword = '';

    public ?int $per_page = 10;

    public ?string $column = '';

    public ?string $order = '';
}
