<x-securityheader />

<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <!-- <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center"> -->
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">Select Plane:</div>

                                        <div class="card-body">

                                            <div class="row">
                                                @foreach($plans as $plan)
                                                
                                                <div class="col-md-12">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            ${{ $plan->price }}/Mo
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $plan->name }}</h5>
                                                            <p class="card-text">Some quick example text to build on the
                                                                card title and make up the bulk of the card's content.
                                                            </p>

                                                            <a href="{{ route('plans.show', $plan->slug) }}"
                                                                class="btn btn-primary pull-right">Choose</a>

                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <!-- </div>
                        </div>



                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<x-securityfooter />