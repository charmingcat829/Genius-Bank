@extends('layouts.user')


@section('content')

        <div class="col-lg-9">
            <div class="account-box">
              <div class="header-area">
                <h4 class="title">
                    {{ __('Referral Informations') }}
                </h4>

              </div>
              <div class="content">

                <div class="table-responsive referral">
                <table>

                  <tr class="spacer">
                    <td width="40%">
                        {{ __('Your Referral Link') }}
                        <br>
                        <small>{{ __('This is your referral link just copy the link and paste anywhere you want.') }}</small>
                    </td>
                    <td width="60%">
                        {{ url('/').'?reff='.$user->affilate_code}}
                    </td>
                  </tr>


                  <tr class="spacer">
                    <td width="40%">
                        {{ __('Referral Banner')}}
                        <br>
                        <small>{{ __('This is your referral banner Preview') }}</small>
                    </td>
                    <td width="60%">
                        <img width="100%" src="{{asset('assets/images/'.$gs->affilate_banner)}}">
                    </td>
                  </tr>


                  <tr class="spacer">
                    <td width="40%">
                        {{ __('Referral Banner HTML Code') }}
                        <br>
                        <small>{{ __('This is your referral banner html code just copy the code and paste anywhere you want.') }}</small>
                    </td>
                    <td width="60%">
                        <textarea class="form-control" rows="5" name="address" disabled="" placeholder="{{__('Address')}} *" row="5"><a href="{{ url('/').'?reff='.$user->affilate_code}}" target="_blank"><img src="{{asset('assets/images/'.$gs->affilate_banner)}}"></a></textarea>
                    </div>
                    </td>
                  </tr>


                </table>
                </div>
              </div>
            </div>

        </div>


@endsection

