<div>
    @if ($message || session('success') || session('error'))
        <div
            class="alert alert-{{ $message ? $type : (session('success') ? 'success' : 'danger') }} alert-dismissible fade show"
            role="alert"
        >
            <strong>{{ $message ?? session('success') ?? session('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
