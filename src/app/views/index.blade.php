@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
 - {{trans('pages.indexTitle')}}
@stop

{{-- Content --}}
@section('content')
<style type="text/css">
* {
    margin: 0;
    padding: 0;
    outline: 0
}
body, html {
    height: 100%;
    margin: 0;
    padding: 0
}
.clear {
    clear: both
}
.shell {
    margin: 0 auto;
    width: 858px
}
p {
    margin: 0;
    padding: 0;
    letter-spacing: 0px
}
p, h1, h2, h3, h4, h5, h6, h7, span, #headline, #sub-headline {
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word
}
body {
    font-size: 18px;
    line-height: 26px;
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 400;
    color: #4f4f4f;
    background: #fcfcfc;
    background: url('https://lh4.ggpht.com/ViyKqDeXvm9w8l76-vdGfvnXI56Y0F30nngyUaUbp0anEp2D1GUEQENeQrFxpexyE6GuoebE_8KkRmQVVpOT=s0') 0 0 repeat
}
header {
    padding: 10px 0;
    margin: 0 auto;
    width: 950px
}
.logo {
    cursor: pointer;
    border: none;
    padding-top: 12px
}
#container{
    padding-top: 80px;
}

#headline {
    font-size: 40px;
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 600;
    color: #39a0e1;
    text-align: center;
    letter-spacing: -1px;
    padding-bottom: 10px;
    line-height: 36px
}
#sub-headline {
    font-size: 24px;
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 600;
    color: #777777;
    text-align: center;
    letter-spacing: 0px;
    margin-bottom: 10px;
    line-height: 36px
}
.video-holder {
    width: 858px;
    padding-bottom: 50px;
    background: url('https://lh4.ggpht.com/b7UqYgp07dqQPeKQjtKoiQMjkxJzSTy8J9LGtmqUyyA5zWjGj0djB1hlQ1PsYAVZlDqBN11hFSpQ89_mBRNO=s0') 0 bottom no-repeat;
    background-size: 100%;
    text-align: center;
    position: relative;
    margin: 10px auto
}
.video-holder img {
    z-index: 2;
    position: relative
}
div.video-holder>div {
    margin: 0 auto
}
div.video-holder>div[id|=leadplayer_video_element_] {
    margin: 0 auto
}
div#video>div[id|=leadplayer_video_element_] {
    margin: 0 auto
}
a.btn {
    background: url('https://lh6.ggpht.com/mTSGwWOVzYPdtld9KhPI145UTwEQiRuPimKe-Ln2kfQxOgsgZECkbJ9owXFi5B5CZUXuJAW5_jpvXGcv2wpn6g=s0') repeat-x scroll 0 0 transparent;
    background-color: #f9d300;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 5px 5px 5px 5px;
    color: #C5A200;
    display: block;
    font-size: 36px;
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 600;
    margin: 0px auto 20px;
    width: 858px;
    text-align: center;
    text-decoration: none;
    line-height: 40px;
    overflow: hidden;
    box-shadow: inset 0px 1px 0px 1px rgba(250,250,250,0.4);
    padding: 20px 0;
    width: 95%
}
a.btn:hover {
    background-color: #fcdc20
}
a.btn span.arrow {
    margin: 0;
    padding: 0;
    width: 20px;
    height: 20px;
    background: url('https://lh5.ggpht.com/zRaWaxjJl92hYMaQEFkQIxSMuNfed6I9Gar9nvScbjWuFi4SnaBiqdKQt7peFC930Lu99lA_tNLgyIOzTQy54w=s0') 0 center no-repeat
}
#fade-box {
    filter: none!important
}
#guarantee {
    width: 858px;
    margin: 20px 0
}
.cnt {
    float: left;
    padding: 0;
    margin: 12px 0 0 10px
}
#guarantee .cnt h1 {
    font-size: 36px;
    font-family: 'Source Sans Pro', sans-serif;
    margin: 0;
    padding: 0;
    line-height: 28px
}
#guarantee .cnt h2 {
    font-size: 16px;
    font-family: 'Source Sans Pro', sans-serif;
    margin: 0;
    padding: 5px 0 0 0;
    line-height: 20px
}
#guarantee .cnt p {
    font-size: 12px;
    color: #0d8eb9;
    margin: 0;
    padding: 0;
    line-height: 16px
}
#guarantee .cnt {
    max-width: 250px
}
#secure .cnt {
    max-width: 130px
}
#money-back {
    float: left;
    width: 40%
}
#money-back img {
    float: left
}
#secure {
    float: left;
    margin-left: 10px;
    width: 30%
}
#secure img {
    float: left
}
#cards {
    float: right;
    margin-top: 10px;
    width: 240px
}
footer {
    min-height: 50px;
    margin-top: 10px;
    overflow: hidden
}
footer p {
    font-size: 14px;
    text-align: center;
    font-family: 'Source Sans Pro', sans-serif;
    margin: 0;
    padding-top: 0;
    color: #414141
}
footer p.legal {
    margin: 0px auto;
    padding-bottom: 10px
}
footer p a {
    color: #414141;
    text-decoration: underline
}

@media only screen and (max-width:1000px) {
.video-holder {
    width: 100%;
    margin: 10px auto
}
#content, #video {
    width: 95%
}
#content .shell, header {
    width: 90%
}
#secure {
    width: 175px
}
#money-back {
    width: 343px
}
#cards {
    clear: both;
    margin: 20px auto;
    float: none;
    padding-top: 20px
}
#guarantee {
    width: 528px;
    display: block;
    margin: 0 auto
}
a.btn {
    width: 100%;
    background-position: center -30%
}
footer .shell {
    width: 100%
}
}

@media only screen and (max-width:660px) {
.video-holder {
    padding-bottom: 35px
}
a.btn {
    font-size: 34px;
    line-height: 36px
}
#guarantee {
    width: 343px
}
#money-back, #secure {
    float: none;
    display: block;
    margin: 20px auto
}
}

@media only screen and (max-width:500px) {
header {
    text-align: center;
    width: 100%
}
.video-holder {
    padding-bottom: 25px
}
.logo {
    margin: 0 auto
}
a.btn {
    font-size: 30px;
    line-height: 32px
}
}

@media only screen and (max-width:500px) {
#secure, #money-back, #guarantee {
    width: 100%
}
#secure img, #money-back img {
    float: none;
    display: block;
    margin: 0 auto 10px auto
}
#guarantee .cnt {
    text-align: center;
    width: 100%;
    max-width: 100%;
    margin: 0
}
#headline {
    font-size: 30px;
    line-height: 32px
}
}

@media only screen and (max-width:276px) {
.logo {
    display: block;
    margin: 0 auto;
    width: 83%;
    height: auto
}
}
.optin-holder {
    margin: 10px auto 30px auto;
    width: 630px;
    border: 4px dashed #d5d5d5
}
.optin-holder p {
    font-family: 'Source Sans Pro', sans-serif;
    font-weight: 400;
    font-size: 18px;
    line-height: 20px;
    text-align: center;
    padding: 0;
    margin-bottom: 3px;
    color: #676767
}
.btn-holder {
    width: 562px;
    min-height: 68px;
    background: url('https://lh6.ggpht.com/hTfPD4OJYNTlq8nGrptTZHWBFgPBHru0NufNspHRYPjqfetrL2mwQ7AJFffrIAB6HbcYUftUA3brmVGYL--jAg=s0') 0 0 no-repeat;
    margin: 5px auto 1px;
    padding: 10px 0
}
</style>
<div id="container">
    <section id="content" data-lead-id="content-id">
      <div class="shell" data-lead-id="shell-id">
        <p id="headline" class="leadstyle-text">"Welcome, Please Watch The Video Below"</p>
        <div class="video-holder leadstyle-video video" id="video" style="max-width: 857px; height: 602px;"><iframe style="height: 482px;" width="857" height=“482” src="//www.youtube.com/embed/E4GCruJtXqk?rel=0&autoplay=0&controls=1&modestbranding=0&showinfo=0" frameborder="0" allowfullscreen></iframe></div>
        
        <div class="optin-holder leadstyle-container">
            <div class="btn-holder" data-lead-id="btn-holder-id"> <a href="http://eliteprofits.co/app/index.php" class="btn leadstyle-link" target="_blank"> Step1: Work With Us Directly</a> </div>
          <p class="leadstyle-text">One time chance to work with us directly.</p>
          </div>    
      
        <div id="fade-box" class="leadstyle-container"> <a href="http://customerportal.co/billing/signup/nyk6qYOla" class="btn leadstyle-link" target="_blank"> Step2: Access The Training Area</a>    
        <div id="fade-box" class="leadstyle-container"> <a href="http://app.instanttrendsmachine.com/search" class="btn leadstyle-link"> Start Using Software Now!</a>
        </div>
      </div>
    </section>

    <br>
    <div class="text-center">To Reach Us Email : <a href="mailto:support@instanttrendsmachine.com">support@instanttrendsmachine.com</a></div>
    <br><br>
</div>
@stop
