<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                    
                        <form action="{{ route('admin.settings.update.action', $values->id) }}" method="post" autocomplete="off">
                            @csrf
                            <div class="border p-3 rounded">

                                <div class="mb-3">
                                    <label class="form-label" for="name">No. of Days</label>
                                    <input type="text" name="data" id="data" class="form-control"
                                        placeholder="Building name" value="{{ $values->value }}" />
                                    <span class="text-danger d-block pt-2" id="nameerror"></span>
                                    @if ($errors->has('data'))
                                    <span class="text-danger">{{ $errors->first('data') }}</span>
                                    @endif
                                </div>

                                <div class="sbg">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit"
                                        value="Submit" />
                                    <a href="{{ route('admin.subscription.list') }}" class="btn btn-dark">Back</a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-securityfooter />