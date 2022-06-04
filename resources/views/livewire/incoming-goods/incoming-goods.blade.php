<div>
    <div class="section-header tw-rounded-lg tw-text-black lg:tw-hidden">
        <h4 class="tw-text-lg">Master Items</h4>
    </div>

    <div class="section-body lg:tw-mt-[-30px]">
        <div class="tw-mt-[-10px] mb-3">
            <h6 class="section-title tw-text-sm">Master Items</h6>
            <p class="section-lead tw-text-xs">Item Master functions as a recap of all items.</p>
        </div>
        <div class="row">
			<div class="col-lg-3">
				<div class="card">
					<div class="card-body">
						<form>
							<div class="form-group">
								<label for="date">Tanggal Masuk</label>
								<input type="date" wire:model="date" id="date" class="form-control">
								@error('date')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
							</div>
							<div class="form-group">
								<label for="id_item">Pilih Barang</label>
								<div wire:ignore>
									<select wire:model="id_item" id="id_item" class="form-control select2">
										<option value="NULL" disabled>-- Pilih Barang --</option>
										@foreach($items as $item)
											<option value="{{ $item->id }}">{{ $item->item_code }} - {{ $item->name_of_goods }}</option>
										@endforeach
									</select>
								</div>
								@error('id_item')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
							</div>
							<div class="form-group">
								<label for="qty">Jumlah Barang</label>
								<input type="number" wire:model="qty" id="qty" class="form-control">
								@error('qty')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
							</div>
							<div class="form-group">
								<label for="purchase_price">Harga Beli</label>
								<input type="number" wire:model="purchase_price" id="purchase_price" class="form-control">
								@error('purchase_price')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
								<small class="form-text text-muted">
									{{ __('messages.currency') }}{{ number_format((int)$purchase_price, 0, ',', '.') }},00
								</small>
							</div>
							@if($updateMode)
								<button wire:click.prevent="update()" wire:loading.attr="disabled" type="button" class="btn btn-outline-warning form-control">Update Data</button>
							@else
								<button type="submit" wire:click.prevent="store()" wire:loading.attr="disabled" class="btn btn-outline-success form-control">Save Data</button>
							@endif
						</form>
					</div>
				</div>
			</div>
            <div class="col-lg-9">
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
											<th class="p-3" width="18%">Nama Barang</th>
											<th class="p-3" width="12%">Tanggal</th>
											<th class="p-3" width="13%">Satuan</th>
											<th class="p-3" width="7%">Qty</th>
											<th class="p-3" width="10%">Harga Beli</th>
											<th class="p-3 text-center" width="13%"></th>
										</tr>
									</thead>
									<tbody>
										@forelse ($data as $row)
										<tr class="tw-bg-white text-uppercase tw-border tw-border-gray-200 hover:tw-bg-gray-50 {{ $this->isUpdate($row->id) }}">
											<td class="p-3">{{ $row->name_of_goods }}</td>
											<td class="p-3 text-center">{{ $row->date }}</td>
											<td class="p-3 text-center">{{ $row->item_unit }}</td>
											<td class="p-3 text-right">{{ $row->qty }},00</td>
											<td class="p-3 text-right">
													{{ number_format($row->purchase_price, 0, ',', '.') }},00
											</td>
											<td class="p-3 text-center">
												<button class="btn btn-primary" data-toggle="modal" data-target="#ubahDataModal" wire:click="edit({{ $row->id }})">
													<i class="fas fa-edit"></i>
												</button>
												<button class="btn btn-danger" wire:click.prevent="deleteConfirm({{ $row->id }})">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										@empty
										<tr class="text-center">
											<td class="p-3" colspan="6">
												No data available in table
											</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
							<div class="table-responsive p-3">
								{{ $data->links() }}
							</div>
						{{-- Table --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
	<script>
		$(document).ready(function () {
        $('#id_item').select2();
        $('#id_item').on('change', function (e) {
            var data = $('#id_item').select2("val");
            @this.set('id_item', data);
        });
    });
	</script>
@endpush