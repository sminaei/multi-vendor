<div>
@if(\Illuminate\Support\Facades\Session::get('fail'))
    <div class="alert alert-danger">
        {{ \Illuminate\Support\Facades\Session::get('fail') }}
        <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::get('info'))
        <div class="alert alert-info">
            {{ \Illuminate\Support\Facades\Session::get('info') }}
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
