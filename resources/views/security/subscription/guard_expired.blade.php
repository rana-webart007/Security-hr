<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-9">
                <div class="card p-2 m-5">

                    <div class="card text-center">
                        <div class="card-header">
                            <h2>Attention !!</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Guard Added Expired</h5>
                            <p class="card-text">Sorry! Your maximum limit for guards has expired, please chose a plan to upgrade your limit
                            </p>
                            <a href="{{ url('security/plans') }}" class="btn btn-primary">Updrade Now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<x-securityfooter />