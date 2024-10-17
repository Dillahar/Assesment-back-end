
<div class="table-responsive  p-0">
    <div id="data_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="data_table_length"><label>Show <select
                            name="data_table_length" aria-controls="data_table"
                            class="form-select form-select-sm" wire:model.live='perPage'>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entries</label></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div id="data_table_filter" class="dataTables_filter"><label>Search:<input
                            type="search" class="form-control form-control-sm" placeholder=""
                            aria-controls="data_table" wire:model.live.debounce.500ms='search'></label></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="data_table_info" role="status"
                    aria-live="polite"></div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                </div>
            </div>
        </div>
    </div>
</div>