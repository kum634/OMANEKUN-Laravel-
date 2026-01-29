<div wire:key="history-search-component" id="history-search-component">
    {{-- メッセージ表示 --}}
    @if($message)
    <div class="alert alert-{{ $messageType }}">{{ $message }}</div>
    @endif

    {{-- 検索結果テーブル --}}
    <div class="result">
        @if(!empty($results))
            @if($results->total() > 0)
            <div class="result_title"><h2>該当件数 {{ $results->total() }} 件</h2></div>
            <div class="result_list">
                <div id="quick-search" class="d-flex justify-content-between">
                    <form action="/" class="form-inline d-flex justify-content-end">
                        <label>表示件数:　</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" wire:model.live.debounce.10ms="form.per_page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </form>
                    <form action="/" class="form-inline d-flex justify-content-end">
                        <label>検索:　</label>
                        <input type="search" name="quick_keyword" wire:model.live.debounce.10ms="form.quick_keyword" placeholder="キーワード" class="form-control">
                    </form>
                </div>
                <table style="font-size: 90%;" class="table table-striped text-left">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    {{-- {{ dd($currentSortColumn) }} --}}
                                    <span class="column-title">入庫日</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('storage_date', 'asc')" 
                                        class="{{ $currentSortColumn === 'storage_date' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('storage_date', 'desc')" 
                                        class="{{ $currentSortColumn === 'storage_date' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    <span class="column-title">納車予定日</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('retrieval_date', 'asc')" 
                                        class="{{ $currentSortColumn === 'retrieval_date' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('retrieval_date', 'desc')" 
                                        class="{{ $currentSortColumn === 'retrieval_date' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    <span class="column-title">お客様氏名</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('last_name', 'asc')" 
                                        class="{{ $currentSortColumn === 'last_name' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('last_name', 'desc')" 
                                        class="{{ $currentSortColumn === 'last_name' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    <span class="column-title">車種名</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('car_name', 'asc')" 
                                        class="{{ $currentSortColumn === 'car_name' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('car_name', 'desc')" 
                                        class="{{ $currentSortColumn === 'car_name' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    <span class="column-title">型式</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('model', 'asc')" 
                                        class="{{ $currentSortColumn === 'model' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('model', 'desc')" 
                                        class="{{ $currentSortColumn === 'model' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    <span class="column-title">登録番号</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('license', 'asc')" 
                                        class="{{ $currentSortColumn === 'license' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('license', 'desc')" 
                                        class="{{ $currentSortColumn === 'license' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="sortable">
                                <div class="d-flex">
                                    <span class="column-title">整備の種類</span>
                                    <span class="sort-icons">
                                        <button type="button" wire:click="sort('maintenance_type', 'asc')" 
                                        class="{{ $currentSortColumn === 'maintenance_type' && $currentSortOrder === 'asc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-up"></i>
                                        </button>
                                        <button type="button" wire:click="sort('maintenance_type', 'desc')" 
                                        class="{{ $currentSortColumn === 'maintenance_type' && $currentSortOrder === 'desc' ? 'current' : ''}}">
                                            <i class="fas fa-sort-down"></i>
                                        </button>
                                    </span>
                                </div>
                            </th>
                            <th class="table-fixed" scope="col"></th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach ($results as $row)

                        {{-- if ($row->tel == "0") $row->tel = '
                        if ($row->retrieval_date == "0000-00-00") $row->retrieval_date = '
                        if ($row->inspection_date == "0000-00-00") $row->inspection_date = ' --}}

                        <tr>
                            <td>{{$row->storage_date}}</td>
                            <td>{{$row->retrieval_date}}</td>
                            <td>{{$row->last_name}} {{$row->first_name}}</td>
                            <td>{{$row->car_name}}</td>
                            <td>{{$row->model}}</td>
                            <td>{{$row->license}}</td>
                            <td>{{$row->maintenance_type}}</td>
                            <td class="table-fixed">
                                <div class="d-flex">
                                    <button
                                        type="button"
                                        class="btn m-1 btn-lg btn-success"
                                        wire:click="$dispatch('open-detail-modal', {
                                            id: {{ $row->ID }},
                                            storage_date: '{{ $row->storage_date }}',
                                            retrieval_date: '{{ $row->retrieval_date }}',
                                            last_name: '{{ $row->last_name }}',
                                            first_name: '{{ $row->first_name }}',
                                            tel: '{{ $row->tel }}',
                                            mailaddress: '{{ $row->mailaddress }}',
                                            car_name: '{{ $row->car_name }}',
                                            model: '{{ $row->model }}',
                                            license: '{{ $row->license }}',
                                            inspection_date: '{{ $row->inspection_date }}',
                                            maintenance_type: '{{ $row->maintenance_type }}',
                                            maintenance_detail: '{{ $row->maintenance_detail }}',
                                            wash: '{{ $row->wash }}',
                                            clean: '{{ $row->clean }}',
                                            notices: '{{ $row->notices }}',
                                            notices_detail: '{{ $row->notices_detail }}',
                                            mode: 'detail',
                                            action: '{{ url('/edit') }}'
                                        })"
                                    >詳細</button>
                                    <button type="button" class="del btn m-1 btn-lg btn-danger"
                                        wire:click="$dispatch('delete-request', {
                                            id: {{ $row->ID }},
                                        })"
                                    >削除</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    </table>

                    <div class="modal fade" id="modal-detail" wire:ignore tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="label1"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            @include('parts.detail')
                            @include('parts.form')
                        </div>
                    </div>
                    </div>

                    {{ $results->links('livewire.paginate', data: ['scrollTo' => false]) }}
                    @else
                    <div class="result_title"><h2>一致する整備依頼がありません。</h2></div>
                    <div id="quick-search">
                        <form action="/" class="form-inline d-flex; justify-content-end">
                            <label for="text1">検索:　</label>
                            <input type="search" name="quick_keyword" wire:model.live.debounce.200ms="form.quick_keyword" placeholder="キーワード" class="form-control">
                        </form>
                    </div>
                    @endif
                @endif
        </div>
    </div>

    {{-- 検索モーダル（Livewire コンポーネント） --}}
    @include('livewire.history-search-form')


</div>
