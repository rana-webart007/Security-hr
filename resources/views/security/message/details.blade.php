<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('security.message.reply', $message->message_id) }}" method="post" autocomplete="off"
                            >
                            <input type="hidden" name="updateid" id="updateid" value="">
                            @csrf

                            @php
                                $user = App\Models\User::whereId($message->guard_id)->first();
                            @endphp

                            <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Guard Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Guard name" value="{{ $user->name }}" readonly />
                                    <span class="text-danger d-block pt-2" id="nameerror"></span>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Guard Message</label>
                                    <textarea name="message" id="message" class="form-control" cols="30" rows="5" readonly>{!! $message->message !!}</textarea>
                                    <span class="text-danger d-block pt-2" id="emailerror"></span>

                                    @if ($errors->has('message'))
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Your Message / Reply Message</label>
                                    @if ($message->reply == null)
                                    <textarea name="reply" id="reply" class="form-control" cols="30" rows="5" >{{ old('reply') }}</textarea>
                                    @else
                                    <textarea name="reply" id="reply" class="form-control" cols="30" rows="5" readonly>{{ $message->reply }}</textarea>
                                    @endif
                                    
                                    <span class="text-danger d-block pt-2" id="emailerror"></span>

                                    @if ($errors->has('reply'))
                                    <span class="text-danger">{{ $errors->first('reply') }}</span>
                                    @endif
                                </div>
                                
                               
                                <div class="sbg">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit"
                                        value="Reply" />
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