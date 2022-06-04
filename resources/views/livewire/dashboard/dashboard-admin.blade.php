<div>
	<div class="section-header tw-rounded-lg tw-text-black">
        <h4 class="tw-text-lg">Dashboard </h4>
    </div>

	<div class="section-body">

		<div class="tw-mt-[-10px] mb-3">
            <h6 class="section-title tw-text-sm">{{ __('messages.summary.summary') }}
            <p class="section-lead tw-hidden tw-text-xs lg:tw-block">{{ __('messages.summary.income') }}</p>
            <p class="section-lead tw-text-xs lg:tw-hidden">Ringkasan transaksi pada hari ini</p>
        </div>
        <div class="tw-grid tw-gap-x-2 tw-grid-cols-2 md:tw-grid-cols-3 tw-text-black tw-text-xs md:tw-text-sm">

            <div class="card tw-rounded-lg tw-mb-[7px]">
                <div class="card-body text-center px-3 py-1 lg:tw-p-3">
                    <p>Total Invoice</p><hr>
                    <h6 class="tw-text-base mt-2 mb-2 lg:tw-text-base tw-font-bold">{{ __('messages.currency') }}0</h6>
                </div>
            </div>
            <div class="card tw-rounded-lg tw-mb-[7px]">
                <div class="card-body text-center px-3 py-1 lg:tw-p-3">
                    <p>Total Outstand.</p><hr>
                    <h6 class="tw-text-base mt-2 mb-2 lg:tw-text-base tw-font-bold">{{ __('messages.currency') }}0</h6>
                </div>
            </div>
            <div class="card tw-rounded-lg tw-mb-[7px]">
                <div class="card-body text-center px-3 py-1 lg:tw-p-3">
                    <p>Total Assets</p><hr>
                    <h6 class="tw-text-base mt-2 mb-2 lg:tw-text-base tw-font-bold">{{ __('messages.currency') }}0</h6>
                </div>
            </div>

			<div class="card tw-rounded-lg tw-mb-[7px]">
                <div class="card-body text-center px-3 py-1 lg:tw-p-3">
                    <p>Outstand Fabrikasi</p><hr>
                    <h6 class="tw-text-base mt-2 mb-2 lg:tw-text-base tw-font-bold">{{ __('messages.currency') }}0</h6>
                </div>
            </div>
            <div class="card tw-rounded-lg tw-mb-[7px]">
                <div class="card-body text-center px-3 py-1 lg:tw-p-3">
                    <p>Outstand Cleaning</p><hr>
                    <h6 class="tw-text-base mt-2 mb-2 lg:tw-text-base tw-font-bold">{{ __('messages.currency') }}0</h6>
                </div>
            </div>
            <div class="card tw-rounded-lg tw-mb-[7px]">
                <div class="card-body text-center px-3 py-1 lg:tw-p-3">
                    <p>Outstand General</p><hr>
                    <h6 class="tw-text-base mt-2 mb-2 lg:tw-text-base tw-font-bold">{{ __('messages.currency') }}0</h6>
                </div>
            </div>

        </div>
		
	</div>
</div>
