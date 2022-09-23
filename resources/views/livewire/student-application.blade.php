@if (session()->has('success'))
    <div class="jumbotron">
        <h1 class="text-center text-danger text-uppercase pt-lg-5">{{ session('success') }}</h1>
    </div>
@else
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="submit">
                @include('frontend.pages.partial.ssc-info')
                @include('frontend.pages.partial.current-college')
                @include('frontend.pages.partial.addmit-college')
                @include('frontend.pages.partial.subjects', $subjectsArr)

                @if($hasSit)
                    <div class="jumbotron">
                        <h1 class="text-center text-danger text-uppercase">Sit Not available at {{$addColName}}</h1>
                    </div>
                @endif
            </form>

            @if (session()->has('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="card-footer">
            <div class="text-center">
                <button type="button" wire:click.prevent="submit" {{ $showDiv  ? '' : 'disabled' }} class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endif


