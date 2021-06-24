@if($type == 'error')
    <span class="invalid-feedback d-block">
        <span class="d-block">
            <span class="form-error-icon badge badge-danger text-uppercase">{{ __('text.info.error') }}</span>
            <span class="form-error-message">{{ $message }}</span>
        </span>
    </span>
@else
    <span class="valid-feedback d-block">
        <span class="d-block">
            <span class="form-error-icon badge badge-success text-uppercase">{{ __('text.info.success') }}</span>
            <span class="form-error-message">{{ $message }}</span>
        </span>
    </span>
@endif

