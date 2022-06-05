<div>
    <div class="section-header tw-rounded-lg tw-text-black lg:tw-hidden">
        <h4 class="tw-text-lg">Data Project Non PO</h4>
    </div>

    <div class="section-body lg:tw-mt-[-30px]">
        <div class="tw-mt-[-10px] mb-3">
            <h6 class="section-title tw-text-sm">Data Project Non PO</h6>
            <p class="section-lead tw-text-xs">Tidak diketahui.</p>
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
											<th class="p-3" width="7%"><i class="far fa-align-center"></i></th>
											<th class="p-3" width="15%">Deskripsi</th>
											<th class="p-3" width="7%">Qty</th>
											<th class="p-3">PO</th>
											<th class="p-3">Amount({{ __('messages.currency') }})</th>
											<th class="p-3">Total({{ __('messages.currency') }})</th>
											<th class="p-3">Department</th>
											<th class="p-3">Status</th>
											<th class="p-3">
												@if($checkedId)
													<button class="btn btn-danger btn-sm ml-auto" wire:click="deleteData()">
														<i class="fas fa-trash"></i> 
														({{ count($checkedId) }})
													</button>
												@endif
											</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($data as $row)
										<tr class="tw-bg-white text-uppercase tw-border tw-border-gray-200 hover:tw-bg-gray-50 {{ $this->isChecked($row->id) }}">
											<td class="p-3 text-center">
												<input type="checkbox" value="{{ $row->id }}" wire:model="checkedId">
											</td>
											<td class="p-3">{{ $row->description }}</td>
											<td class="p-3 text-center">{{ $row->qty }}</td>
											<td class="p-3 text-center">{{ $row->po }}</td>
											<td class="p-3 text-right">
												{{ number_format((int)$row->amount, 0, ',', '.') }},00
											</td>
											<td class="p-3 text-right">
												{{ number_format((int)$row->total, 0, ',', '.') }},00
											</td>
											<td class="p-3 text-center">{{ $row->department }}</td>
											<td class="p-3 text-center">{{ $row->status }}</td>
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
											<td class="p-3" colspan="9">
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
		{{-- Button for open "Insert Data Modal" --}}
			<button
				class="tw-fixed tw-right-[30px] tw-bottom-[50px] tw-w-14 tw-h-14 tw-shadow-2xl tw-rounded-full tw-bg-slate-600 tw-z-40 text-white hover:tw-bg-slate-900 hover:tw-border-slate-600"
				data-toggle="modal" data-target="#tambahDataModal">
				<i class="far fa-plus"></i>
			</button>
		{{-- Button for open "Insert Data Modal" --}}
    </div>

    {{-- Insert Data Modal --}}
		<div class="modal fade" wire:ignore.self id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="tambahDataModalLabel">Tambah Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form>
						<div class="modal-body">
							<div class="form-group">
								<label for="description">Deskripsi</label>
								<input type="text" wire:model="description" id="description" class="form-control">
								@error('description')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="qty">Qty</label>
										<input type="number" wire:model="qty" id="qty" class="form-control">
										@error('qty')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="po">PO</label>
										<input type="text" wire:model="po" id="po" class="form-control">
										@error('po')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="amount">Amount</label>
								<input type="number" wire:model="amount" id="amount" class="form-control">
								@error('amount')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
								<small class="form-text text-muted">
									{{ __('messages.currency') }}{{ number_format((int)$amount, 0, ',', '.') }},00
								</small> 
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="department">Department</label>
										<input type="text" wire:model="department" id="department" class="form-control">
										@error('department')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>	
								</div>
								<div class="col-lg-6">	
									<div class="form-group">
										<label for="status">Status</label>
										<input type="text" wire:model="status" id="status" class="form-control">
										@error('status')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" wire:click.prevent="store()" wire:loading.attr="disabled" class="btn btn-primary">Save Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	{{-- Insert Data Modal --}}

    {{-- Update Data Modal --}}
		<div class="modal fade" wire:ignore.self id="ubahDataModal" tabindex="-1" aria-labelledby="ubahDataModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="ubahDataModalLabel">Edit Data</h5>
						<button type="button" wire:click.prevent='cancel()' class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form>
						<div class="modal-body">
							<input type="hidden" wire:model='dataId'>
							<div class="form-group">
								<label for="description">Deskripsi</label>
								<input type="text" wire:model="description" id="description" class="form-control">
								@error('description')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="qty">Qty</label>
										<input type="number" wire:model="qty" id="qty" class="form-control">
										@error('qty')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="po">PO</label>
										<input type="text" wire:model="po" id="po" class="form-control">
										@error('po')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="amount">Amount</label>
								<input type="number" wire:model="amount" id="amount" class="form-control">
								@error('amount')
									<small class="form-text text-muted">
										{{ $message }}
									</small> 
								@enderror
								<small class="form-text text-muted">
									{{ __('messages.currency') }}{{ number_format((int)$amount, 0, ',', '.') }},00
								</small> 
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="department">Department</label>
										<input type="text" wire:model="department" id="department" class="form-control">
										@error('department')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>	
								</div>
								<div class="col-lg-6">	
									<div class="form-group">
										<label for="status">Status</label>
										<input type="text" wire:model="status" id="status" class="form-control">
										@error('status')
											<small class="form-text text-muted">
												{{ $message }}
											</small> 
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" wire:click.prevent='cancel()' class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button wire:click.prevent="update()" wire:loading.attr="disabled" type="button" class="btn btn-primary">Save Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    {{-- Update Data Modal --}}


</div>