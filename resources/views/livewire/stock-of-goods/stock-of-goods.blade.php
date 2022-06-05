<div>
    <div class="section-header tw-rounded-lg tw-text-black lg:tw-hidden">
        <h4 class="tw-text-lg">Stok Barang</h4>
    </div>

    <div class="section-body lg:tw-mt-[-30px]">
        <div class="tw-mt-[-10px] mb-3">
            <h6 class="section-title tw-text-sm">Stok Barang</h6>
            <p class="section-lead tw-text-xs">Merekap semua data stok barang.</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-body px-0">
						{{-- Search and Pagination --}}
							<div class="row mb-3 px-4">
								<div class="col-4 col-lg-2">
									<select class="form-control" wire:model='lengthData'>
										<option value="0" selected>-</option>
										<option value="1" selected>1</option>
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="250">250</option>
										<option value="500">500</option>
									</select>
								</div>
								<div class="col-8 col-lg-4 ml-auto">
									<input wire:model="searchTerm" type="search" class="form-control ml-auto"
										placeholder="Search here.." wire:model='searchTerm'>
								</div>
							</div>
						{{-- Search and Pagination --}}

						{{-- Table --}}
							<div class="table-responsive">
								<table class="tw-table-fixed tw-w-full tw-text-black tw-text-md mt-4 tw-border-collapse tw-border">
									<thead>
										<tr class="tw-border-b tw-text-xs text-center text-uppercase">
											<th class="p-3" width="50%">Nama Barang</th>
											<th class="p-3" width="17%">Kode Barang</th>
											<th class="p-3" width="12%">Satuan</th>
											<th class="p-3" width="15%">Stock</th>
											<th class="p-3 text-center" width="10%"></th>
										</tr>
									</thead>
									<tbody>
										@forelse ($data as $row)
										<tr class="tw-bg-white text-uppercase tw-border tw-border-gray-200 hover:tw-bg-gray-50">
											<td class="p-3">{{ $row->name_of_goods }}</td>
											<td class="p-3 text-center">{{ $row->item_code }}</td>
											<td class="p-3 text-center">{{ $row->item_unit }}</td>
											<td class="p-3 text-right">{{ $row->stock }},00</td>
											<td class="p-3 text-center">
												<button class="btn btn-primary" data-toggle="modal" data-target="#ubahDataModal" wire:click="view({{ $row->id }})">
													<i class="fas fa-edit"></i>
												</button>
											</td>
										</tr>
										@empty
										<tr class="text-center">
											<td class="p-3" colspan="5">
												No data available in table
											</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
							<div class="table-responsive p-3">
								{{ $data->appends(['goods' => $data->currentPage()])->links() }}
							</div>
						{{-- Table --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

	{{-- Update Data --}}
    <div class="modal fade" wire:ignore.self id="ubahDataModal" tabindex="-1" aria-labelledby="ubahDataModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog text-dark">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataModalLabel">Data Stok Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="modal-body">
					<p class="font-weight-bold">> Informasi Barang</p>
					<div class="card card-primary mt-2 tw-shadow-lg tw-rounded-lg">
						<div class="card-header">
							<p class="font-weight-bold tw-text-lg">{{ $item_code }}</p>
							<p class="ml-auto"><span class="font-weight-bold">Total Qty: </span>{{ $totalQty }}</p>
						</div>
						<div class="card-body">
							<p class="tw-text-sm font-weight-bold">{{ $name_of_goods }}</p>
							<p><b>Harga Barang:</b> {{ __('messages.currency') }}{{ number_format((int)$price_of_goods, 0, ',', '.') }},00</p>
						</div>
						<div class="px-0">
							<div class="table-responsive">
								<table class="tw-table-fixed tw-w-full tw-text-black tw-text-md tw-border-collapse tw-border">
									<thead>
										<tr class="tw-border-b tw-text-xs text-center text-uppercase">
											<th class="p-3">Stock Barang</th>
											<th class="p-3">Harga Beli</th>
										</tr>
									</thead>
									<tbody>
									@foreach($dataInventory as $inventories)
										<tr class="tw-bg-white tw-border tw-border-gray-200 hover:tw-bg-gray-50">
											<td class="p-3 text-center">{{ $inventories->qty }},00</td>
											<td class="p-3">{{ __('messages.currency') }}<span class="float-right">{{ number_format((int)$inventories->purchase_price, 0, ',', '.') }},00</span></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
							<div class="table-responsive p-3">
								{{ $dataInventory->appends(['inventories' => $dataInventory->currentPage()])->links() }}
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>

</div>