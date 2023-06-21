<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Update Your Details</h5>
                      <span class="text-success">{{ Session::get('profile_update') }}</span>
                        <form action="{{ route('admin.profile.update', $id) }}" method="post" autocomplete="off"
                            onsubmit="return valid();">
                            @csrf
                            <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label class="form-label" for="client_id">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $detail->name }}"
                                        id="">

                                    <span class="text-danger d-block pt-2" id="client_iderror"></span>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                 <div class="mb-3">
                                    <label class="form-label" for="client_id">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $detail->email }}"
                                        id="">

                                    <span class="text-danger d-block pt-2" id="client_iderror"></span>
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                
                                <div class="sbg">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit"
                                        value="Submit" />
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