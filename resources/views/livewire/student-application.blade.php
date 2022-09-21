<div class="card">
    <div class="card-body">
        <form>

            @include('frontend.pages.partial.ssc-info')
            @include('frontend.pages.partial.current-college')
            @include('frontend.pages.partial.addmit-college')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Subjects
                    </h3>
                </div>
                <div class="card-body border border-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">Eiin</label>
                                <input type="text" class="form-control" id="fname">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother">College Name</label>
                                <input type="email" class="form-control" id="mother">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother">Post office</label>
                                <input type="email" class="form-control" id="mother">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fname">Upazila</label>
                                <input type="text" class="form-control" id="fname">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother">District</label>
                                <input type="email" class="form-control" id="mother">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mother">Division</label>
                                <input type="email" class="form-control" id="mother">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
