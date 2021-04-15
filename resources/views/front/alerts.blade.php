@if(session()->has('success'))
    <div class="alert alert-success fade show" role="alert">
        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-inner--text"><strong>{{ trans('Success!') }}</strong> {{ session()->get('success') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('faild'))
    <div class="alert alert-danger fade show" role="alert">
        <span class="alert-inner--icon"><i class="fa fa-exclamation-circle"></i></span>
        <span class="alert-inner--text"><strong>{{ trans('Warning!') }}</strong> {{ session()->get('faild') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
