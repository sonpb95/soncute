@extends('layouts.master')

@section('content')

  <div class="layout-2cols">
         <div class="grid_12 top-info">
             <h2 class="common-title big rs"><span class="fc-black">Kickstars</span> Blog</h2>
         </div>
         <div class="content grid_8">
             <div class="single-page">
                 <div class="box-single-content">
                     <h3 class="rs single-title">Ineteresting article</h3>
                     <p class="rs post-by">by <a href="profile.html">Jonh Doe</a></p>
                     <div class="editor-content">
                         <p>
                             <img class="img-desc" src="images/ex/th-552x152-1.jpg" alt="$DESCRIPTION">
                         </p>
                         <p>Nam sit amet est sapien, a faucibus purus. Sed commodo facilisis tempus. <span class="fc-orange">Pellentesque placerat elementum adipiscing.</span> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                         <p>Etiam quis libero odio. Donec laoreet diam sed arcu vehicula consequat. Proin faucibus pretium consequat. <span class="fw-b fc-black">Aliquam vulputate aliquet nisl</span>, a sagittis ipsum ultrices a. Nunc risus tellus, vulputate eget lobortis eget, facilisis et tortor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>

                     </div>
                 </div>
                 <div class="utility-post clearfix">
                     <div class="tag-cloud">
                         <span class="fc-gray sep">,</span>
                         <a href="#" class="fc-gray be-fc-orange">news</a><span class="fc-gray sep">,</span>
                         <a href="#" class="fc-gray be-fc-orange">media</a><span class="fc-gray sep">,</span>
                         <a href="#" class="fc-gray be-fc-orange">post</a>
                     </div>
                     <!-- AddThis Button BEGIN -->
                     <div class="social-sharing-outside">
                         <div class="addthis_toolbox addthis_default_style">
                         <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                         <a class="addthis_button_tweet"></a>
                         <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                         <a class="addthis_counter addthis_pill_style"></a>
                         </div>
                         <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
                     </div><!-- AddThis Button END -->
                 </div><!--end: .utility-post -->
                 <div class="wrapper-box box-list-comment">
                     <div class="clearfix">
                         <h4 class="rs title-box-outside">Comments  <span class="fc-gray">(12)</span></h4>
                         <a class="post-new-comment be-fc-orange" href="#"><i class="icon iPost"></i> Post a comment</a>
                     </div>
                     <div class="box-white">
                         <div class="media comment-item">
                             <a href="#" class="thumb-left">
                                 <img src="images/ex/th-90x90-1.jpg" alt="$TITLE">
                             </a>
                             <div class="media-body">
                                 <h4 class="rs comment-author">
                                     <a href="profile.html" class="be-fc-orange fw-b">John Doe</a>
                                     <span class="fc-gray">say:</span>
                                 </h4>
                                 <p class="rs comment-content"> Fusce tellus. Sed metus augue, convallis et, vehicula ut, pulvinar eu, ante. Integer orci tellus, tristique vitae, consequat nec, porta vel, lectus</p>
                                 <p class="rs time-post">
                                     5 days ago
                                     <a class="btn-reply fc-gray be-fc-orange" href="#">
                                         <i class="icon iReply"></i>
                                         Reply
                                     </a>
                                 </p>
                             </div>
                         </div><!--end: .comment-item -->
                         <div class="media comment-item">
                             <a href="#" class="thumb-left">
                                 <img src="images/ex/th-90x90-2.jpg" alt="$TITLE">
                             </a>
                             <div class="media-body">
                                 <h4 class="rs comment-author">
                                     <a href="#" class="be-fc-orange fw-b">Eminem</a>
                                     <span class="fc-gray">say:</span>
                                 </h4>
                                 <p class="rs comment-content">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In posuere felis nec tortor. Pellentesque faucibus. Ut accumsan ultricies elit.</p>
                                 <p class="rs time-post">
                                     5 days ago
                                     <a class="btn-reply fc-gray be-fc-orange" href="#">
                                         <i class="icon iReply"></i>
                                         Reply
                                     </a>
                                 </p>
                             </div>
                         </div><!--end: .comment-item -->
                         <div class="media comment-item lv2">
                             <a href="#" class="thumb-left">
                                 <img src="images/ex/th-90x90-3.jpg" alt="$TITLE">
                             </a>
                             <div class="media-body">
                                 <h4 class="rs comment-author">
                                     <a href="#" class="be-fc-orange fw-b">Snoop Dogg</a>
                                     <span class="fc-gray">say:</span>
                                 </h4>
                                 <p class="rs comment-content">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                                 <p class="rs time-post">
                                     5 days ago
                                     <a class="btn-reply fc-gray be-fc-orange" href="#">
                                         <i class="icon iReply"></i>
                                         Reply
                                     </a>
                                 </p>
                             </div>
                         </div><!--end: .comment-item -->
                         <div class="media comment-item lv2">
                             <a href="#" class="thumb-left">
                                 <img src="images/ex/th-90x90-4.jpg" alt="$TITLE">
                             </a>
                             <div class="media-body">
                                 <h4 class="rs comment-author">
                                     <a href="profile.html" class="be-fc-orange fw-b">Obama</a>
                                     <span class="fc-gray">say:</span>
                                 </h4>
                                 <p class="rs comment-content">Curabitur vel dolor ultrices ipsum dictum tristique. Praesent vitae lacus. Ut velit enim, vestibulum non, fermentum nec,</p>
                                 <p class="rs time-post">
                                     5 days ago
                                     <a class="btn-reply fc-gray be-fc-orange" href="#">
                                         <i class="icon iReply"></i>
                                         Reply
                                     </a>
                                 </p>
                             </div>
                         </div><!--end: .comment-item -->
                         <div class="media comment-item lv3">
                             <a href="#" class="thumb-left">
                                 <img src="images/no-avatar.png" alt="$TITLE">
                             </a>
                             <div class="media-body">
                                 <h4 class="rs comment-author">
                                     <a href="profile.html" class="be-fc-orange fw-b">Mark Lenon</a>
                                     <span class="fc-gray">say:</span>
                                 </h4>
                                 <p class="rs comment-content">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                                 <p class="rs time-post">
                                     5 days ago
                                     <a class="btn-reply fc-gray be-fc-orange" href="#">
                                         <i class="icon iReply"></i>
                                         Reply
                                     </a>
                                 </p>
                             </div>
                         </div><!--end: .comment-item -->
                         <div class="media comment-item">
                             <a href="#" class="thumb-left">
                                 <img src="images/ex/th-90x90-1.jpg" alt="$TITLE">
                             </a>
                             <div class="media-body">
                                 <h4 class="rs comment-author">
                                     <a href="#" class="be-fc-orange fw-b">Dr. Dre</a>
                                     <span class="fc-gray">say:</span>
                                 </h4>
                                 <p class="rs comment-content"> Morbi eget arcu. Morbi porta, libero id ullamcorper nonummy, nibh ligula pulvinar metus, eget consectetuer augue nisi quis lacus. Ut ac mi quis lacus mollis aliquam. Curabitur iaculis tempus eros. Curabitur vel mi sit amet magna malesuada ultrices</p>
                                 <p class="rs time-post">
                                     5 days ago
                                     <a class="btn-reply fc-gray be-fc-orange" href="#">
                                         <i class="icon iReply"></i>
                                         Reply
                                     </a>
                                 </p>
                             </div>
                         </div><!--end: .comment-item -->
                     </div>
                 </div><!--end: .box-list-comment -->
                 <div class="wrapper-box box-post-comment">
                     <h4 class="rs title-box-outside">Post comment</h4>
                     <div class="clear"></div>
                     <div class="box-white">
                         <form action="#">
                             <div class="form form-post-comment">
                                 <div class="left-input">
                                     <label for="txt_name_comment">
                                         <input id="txt_name_comment" type="text" class="txt fill-width txt-name" placeholder="Enter Your Name"/>
                                     </label>
                                     <label for="txt_email_comment">
                                         <input id="txt_email_comment" type="text" class="txt fill-width txt-email" placeholder="Enter Your Email" value="info@megadrupal.com"/>
                                     </label>
                                 </div>
                                 <div class="right-input">
                                     <label for="txt_content_comment">
                                         <textarea name="txt_content_comment" id="txt_content_comment" cols="30" rows="10" class="txt fill-width" placeholder="Your comment "></textarea>
                                     </label>
                                 </div>
                                 <div class="clear"></div>
                                 <p class="rs ta-r clearfix">
                                    <span class="thanks">Thanks for submitting your comment!<i class="pick-right"></i></span>
                                    <input type="submit" class="btn btn-white btn-submit-comment" value="Submit">
                                </p>
                             </div>
                         </form>
                     </div>
                 </div><!--end: .box-list-comment -->
             </div>
         </div><!--end: .content -->

         <div class="sidebar grid_4">
             <div class="box-gray project-author">
                 <h3 class="title-box">Project by</h3>
                 <div class="media">
                     <a href="profile.html" class="thumb-left">
                         <img src="images/ex/th-90x90-1.jpg" alt="$USER_NAME"/>
                     </a>
                     <div class="media-body">
                         <h4 class="rs pb10"><a href="profile.html" class="be-fc-orange fw-b">John Doe</a></h4>
                         <p class="rs">Chicago, IL</p>
                         <p class="rs fc-gray">5 projects</p>
                     </div>
                 </div>
                 <div class="author-action">
                     <a class="btn btn-red" href="profile.html">Contact me</a>
                     <a class="btn btn-white" href="profile.html">See full bio</a>
                 </div>
             </div><!--end: .project-author -->
             <div class="box-gray">
                 <h3 class="title-box">Text Widget</h3>
                 <p class="rs description pb20">Nam sollicitudin malesuada dapibus. Suspendisse mollis pellentesque eros. Aenean congue tempor neque, vel malesuada augue auctor in. In aliquam faucibus interdum.</p>
                 <a class="btn bigger fill-width btn-white" href="#">Large download button</a>
                 <a class="btn bigger fill-width btn-blue" href="#">Large download button</a>

             </div>
         </div><!--end: .sidebar -->
         <div class="clear"></div>
     </div>

@endsection
