@extends('layouts.admin1')
@section('title','inbox')
@section('content')
<div class="">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li><span>Merchant message</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<main role="main" class="col-md-12 pt-4">        
        <div class="message">
                <div class="container-fluid" id="mymsg">
                    <div class="row no-gutters">
                        @foreach ($message as $item)
                        @if ($item->receiver == Auth::user()->id)                          
                        <div class="card col-md-12">
                             <span hidden class="pro" data-id="{{$item->product_id}}"></span>
                            <div class="msg-left">   
                                <div class="col-md-12 msg-title">
                                        <p style="margin-bottom:0" class="username text-white py-2 text-left text-dark"><img src="{{ asset('asset/back/images/message/v.png') }}" width="5%" class="pic-msg"></p>
                                </div>
                                <div class="msg-here ml-5 mb-2">
                                        <div class="d-flex justify-content-start">                                                                                    
                                            <div class="usrmsg pb-2 rounded" style="background: #ddd">
                                              <span style="font-size:11px" class="px-2 pb-2 text-left">{{$item->message}}</span>
                                              <span hidden class="rcv" data-id="{{$item->sender}}"></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                         @else
                        <div class="card col-md-12 pb-2">
                            <div class="msg-right">
                                <div class="col-md-12 msg-title m-b-50">
                                        <p style="margin-bottom:0" class="username  py-2 text-right"><img src="{{ asset('asset/back/images/message/marchant.png') }}" width="5%" class="pic-msg"></p>
                                </div>
                                <div class="col-md-12">                                   
                                            <div class="em-msg   py-2 text-right " style="border-radius:4px">
                                                <span style="font-size:11px" class="text-white mr-4 p-2  bg-primary">{{$item->message}}</span>  
                                             </div>
                                </div>
                                <div class="msg-box pl-3">
                                  <p hidden class="idd" data-id="{{$id}}"></p>                                   
                                </div>
                            </div> 
                        </div>  
                        @endif    
                        @endforeach
                            <div class="card col-md-12 username2 pb-2" style="display:none">
                                <div class="msg-right">
                                    <div class="col-md-12 msg-title m-b-50">
                                            <p style="margin-bottom:0" class="username2  py-2 text-right"><img src="{{ asset('asset/back/images/message/marchant.png') }}" width="5%" class="pic-msg"></p>
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="em-msg adm mb-2 py-2 text-right username2" style="border-radius:4px;display:none">
                                                <span style="font-size:11px" class="messg text-white mr-4 p-2"></span>  
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-12"> 
                                <div class="">
                                        <div class="input-group">
                                                <input type="text" name="message" id="msg" class="form-control w-95 mr-2" placeholder="write message....">
                                            <div class="input-group-append">
                                                <button id="btn_msg" type="button" class="btn btn-success btn-sm" style="background:#8818fd;"><i class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                </div>
                           </div>
                    </div>
                </div>
            </div>
</main>        
@endsection
@section('script')
  <script>
  $('#btn_msg').click(function(e) {
      e.preventDefault();     
    var message=$('#msg').val();
    var rcv=$('.rcv').data("id");
    var pro=$('.pro').data("id"); 
    jQuery.ajax({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
               type: 'post',
               url:'{{route('admin.message_send')}}',	
               data: {
                   message:message,
                   rcv    :rcv,
                   pro    :pro
               },
               dataType : 'json',
               success: function(data) {
                       message=$('#msg').val("");
                       $('.username2').css('display','block')
                       $('.messg').css("background-color", "#007bff");
                       $('.messg').append(data.message)   
                       setTimeout(function()   {
                        location.reload();  //Refresh page
                    }, 400);                   

               }
           });      
    });

$(document).ready(function () {
    var a=$('.idd').data('id');
    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
          type: 'post',
          url: '/admin/message-status/'+a,
          data: {},
          dataType : 'json',
          success: function(data) {
           
            
           /* $(".close").click(function(){
             setTimeout(5000);
             location.reload();
           }); */
          }
      });
    
});
  </script>
@endsection