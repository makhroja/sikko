@if (count($errors->all()) > 0)
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class=""><i class="fa fa-ban"></i> Error</h4>
        <span class="message ">Please check the form below for errors</span>
        <ul class="">
            @foreach ($errors->all() as $error)
                <li class=""><span>{{ $error }}</span></li>
            @endforeach
        </ul>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class=""><i class="fa fa-check"></i> Success</h4>
        <span class="message ">
            @if (is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
        </span>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4 class=""><i class="fa fa-ban"></i> Error</h4>
        <span class="message ">
            @if (is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
        </span>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class=""><i class="fa fa-exclamation-circle"></i> Warning</h4>
        <span class="message ">
            @if (is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
        </span>
    </div>
@endif

@if ($message = Session::get('notice'))
    <div class="alert alert-warning alert-dismissible fade show mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class=""><i class="fa fa-exclamation-circle"></i> Notice</h4>
        <span class="message ">
            @if (is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
        </span>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show mb-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class=""><i class="fa fa-info-circle"></i> Info</h4>
        <span class="message ">
            @if (is_array($message))
                @foreach ($message as $m)
                    {{ $m }}
                @endforeach
            @else
                {{ $message }}
            @endif
        </span>
    </div>
@endif
