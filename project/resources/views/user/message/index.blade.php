@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Support Ticket')}}
          </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            <a href="javascript:;" class="btn btn-primary w-100 apply-loan" data-bs-toggle="modal" data-bs-target="#modal-message">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              {{__('Create New Ticket')}}
          </a>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    @if (count($convs) == 0)
                        <h3 class="text-center py-5">{{__('No Data Found')}}</h3>
                    @else 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Subject') }}</th>
                                    <th>{{ __('Message') }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($convs as $conv)
                                    <tr class="conv">
                                      <input type="hidden" value="{{$conv->id}}">
                                      <td data-label="{{ __('Subject') }}">
                                        <div>
                                          {{$conv->subject}}
                                        </div>
                                      </td>
                                      <td data-label="{{ __('Message') }}">
                                        <div>
                                          {{$conv->message}}
                                        </div>
                                      </td>
      
                                      <td data-label="{{ __('Time') }}">
                                        <div>
                                          {{$conv->created_at->diffForHumans()}}
                                        </div>
                                      </td>
                                      <td data-label="{{ __('Action') }}">
                                        <div class="d-flex">
                                          <a href="{{route('user.message.show',$conv->id)}}" class="link view me-1 btn d-block btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                          <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="{{route('user.message.delete1',$conv->id)}}"class="link remove-btn btn d-block btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                      </td>
      
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $convs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>



<div class="modal modal-blur fade" id="modal-message" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{('Create Ticket')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="emailreply1">
          @csrf
          <div class="modal-body">
            <div class="form-group mb-2">
              <input type="text" class="form-control" name="subject" placeholder="{{ __('Subject') }}" autocomplete="off" required="">
            </div>
  
            <div class="form-group">
              <textarea class="form-control" name="message" name="message" placeholder="{{ __('Your Message') }}" rows="10"></textarea>
            </div>
          </div>
  
          <div class="modal-footer">
              <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
          </div>
      </form>
    </div>
  </div>
</div>


<div class="modal modal-blur fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-danger"></div>
      <div class="modal-body text-center py-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
        <h3>{{__('Are you sure')}}?</h3>
        <div class="text-muted">{{__("You are about to delete this Ticket.")}}</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                {{__('Cancel')}}
              </a></div>
            <div class="col">
              <a href="javascript:;" class="btn btn-danger w-100 btn-ok">
                {{__('Delete')}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


@endsection

@push('js')

<script type="text/javascript">
'use strict';

          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/user/admin/user/send/message')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                  },
            success: function( data) {
                      $('#subj1').prop('disabled', false);
                      $('#msg1').prop('disabled', false);
                      $('#subj1').val('');
                      $('#msg1').val('');
                      $('#emlsub1').prop('disabled', false);
                      if(data == 0)
                      $.notify("Oops Something Goes Wrong !!","error");
                      else
                      $.notify("Message Sent !!","success");
                      $('.close').click();
                      location.reload();
            }

        });
          return false;
        });

</script>

<script type="text/javascript">
    'use strict';

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

@endpush
