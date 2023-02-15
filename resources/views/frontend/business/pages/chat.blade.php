@extends('frontend.business.includes.web')
@section('pageTitle')
{{'Tejarh - Business - Chat'}}
@endsection

@section('content')
<div class="chat-wrapper">
    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                <div class="chat-box-wrapper">
                    <div class="left-chat-box-wrapper">
                        <div class="button-group filters-button-group">
                            <button class="button is-checked" onclick="filterList('all');" id="showAll" >All</button>
                            <button class="button selling-color" onclick="filterList('selling');" data-filter=".selling">Selling</button>
                            <button class="button buying-color"  onclick="filterList('buying');"  data-filter=".buying">Buying</button>
                            <button class="button blocked-color" onclick="filterList('blocked');" data-filter=".blocked">Blocked</button>
                        </div>
                        <div class="chat-search">
                            <form action="">
                                <div class="input-group">
                                    <input type="search" placeholder="Search or start new chat" class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="grid" id="users">
                        </div>
   
                    </div>
                    <div class="right-chat-box-wrapper">
                        <div class="right-chat-content" id="chat-person1">
                            <div class="profile-pic-wrapper">
                                <div class="left-profile-pic-content">
                                    <img src="">
                                  <div class="pro-pic">
                                    <h5 id="title"></h5>
                                    <div class="product-rating">
                                        <!-- <img src="{{asset('assets/images/grey-star.png')}}">
                                        <img src="{{asset('assets/images/grey-star.png')}}">
                                        <img src="{{asset('assets/images/grey-star.png')}}">
                                        <img src="{{asset('assets/images/grey-star.png')}}">
                                        <img src="{{asset('assets/images/grey-star.png')}}"> -->
                                    </div>
                                    <address id="location" class="location"></address>
                                    </div>
                                    
                                </div>
                                <!-- @if('Block' == 'Block')
                                <div class="right-profile-pic-content"><button onclick="unBlockCurrentUser();" class="button blocked-color" >UnBlock</button></div>
                                @else
                                <div class="right-profile-pic-content"><button onclick="blockCurrentUser('true');" class="button blocked-color" >Block</button></div>
                                @endif -->
                            </div>
                            <div class="chat-content-wrapper">

                                <div id="message-box-wrraper" class="message-box-wrraper chat-content">
                                    <ul id="box"></ul>
                                    <div hidden id="preview-wrapper" class="preview-wrapper">
                                        <button class="preview-close-btn" onclick="closePreview();">Close</button>
                                        <img id="preview-image" class="preview-image" src="" alt="imagePreview" />
                                    </div>
                                </div>
                            </div>
                            <div class="send-msg-wrapper">
                                <div class="smile-icon-box">
                                    <a href="#"><i class="fa-regular fa-face-smile"></i></a>
                                </div>
                                <!-- <form> -->
                                    <div class="input-group">
                                        <!-- need buyer seller id here -->
                                        <input type="text" id="chat_message_text" placeholder="Write a message…" class="form-control">
                                        <input type="file" hidden accept=".jpg, .jpeg, .png" id="chat_message_media" >
                                    </div>
                                    <div class="form-group attachment">
                                        <button class="cm_attachment" onclick="clickFileInput();"><img src="{{asset('fronted/users_flow/assets/images/icon-attachment.png')}}"></button>
                                    </div>
                                    <div class="form-group submit">
                                        <input type="submit"  onclick="sendMessage();" class="btn btn-primary chat_message_button" value="Send">
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>

                        <div class="right-chat-content" id="">
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->
<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('assets/images/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img
                                    src="{{ asset('assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img
                                    src="{{ asset('assets/images/app-store.png') }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module" src="{{asset('fronted/business_flow/assets/js/constants.js')}}"></script>
<script type="text/javascript" src="{{asset('fronted/business_flow/assets/js/moment.min.js')}}"></script>
    <script type="module">
        window.onload=initialLoad({{$buyerId}});
        window.clickFileInput=function clickFileInput(){
            const fileInput = document.getElementById('chat_message_media');
            fileInput.click();
        }
        const fileSelector = document.getElementById('chat_message_media');
        fileSelector.addEventListener('change', (event) => {
            const file = event?.target?.files[0];
            createPreview(file);
        });

    </script>
@endsection
