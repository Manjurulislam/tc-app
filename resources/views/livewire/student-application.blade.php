<div class="card">
    <div class="card-body">
        <form wire:submit.prevent="submit">
            @include('frontend.pages.partial.ssc-info')
            @include('frontend.pages.partial.current-college')
            @include('frontend.pages.partial.addmit-college')
            @include('frontend.pages.partial.subjects', $subject)
        </form>
    </div>
    <div class="card-footer">
        <div class="text-center">
            <button type="button" wire:click.prevent="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
