@extends('layouts.master')

@section('content')

      <div class="layout-2cols">
          <div class="blog-page">
              <div class="grid_12 top-info">
                  <h2 class="blog-title rs"><span class="fc-black">Kickstars</span> Blog</h2>
                  <ul class="nav nav-menu-blog clearfix">
                      <li><a href="#">News</a></li>
                      <li class="sep"></li>
                      <li><a href="#">Data</a></li>
                      <li class="sep"></li>
                      <li><a href="#">PROFILES</a></li>
                      <li class="sep"></li>
                      <li><a href="#">Q&As</a></li>
                      <li class="sep"></li>
                      <li><a href="#">Calendar</a></li>
                      <li class="sep"></li>
                      <li><a href="#">Video</a></li>
                      <li class="sep"></li>
                      <li><a href="#">Tips</a></li>
                  </ul>
                  <ul id="sys-nav-menu-blog" class="alternate-menu-blog">
                      <li><a href="#">News</a></li>
                      <li><a href="#">Data</a></li>
                      <li><a href="#">PROFILES</a></li>
                      <li><a href="#">Q&As</a></li>
                      <li><a href="#">Calendar</a></li>
                      <li><a href="#">Video</a></li>
                      <li><a href="#">Tips</a></li>
                  </ul>
              </div>
              <div class="clear"></div>
              <div class="content grid_8 main-info">
                  <h3 class="rs title-detail"><a href="post.html">Kickstars blog - how its work?</a></h3>
                  <div class="box-text-content">
                      <h4 class="rs title-in-box">Lorem ipsum dolor.</h4>
                      <p class="rs">Nam sit amet est sapien, a faucibus purus. Sed commodo facilisis tempus. Pellentesque placerat elementum adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                  </div>
                  <div class="box-text-content">
                      <h4 class="rs title-in-box">Etiam ultricies nisi vel augue</h4>
                      <p class="rs">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                  </div>
                  <div class="box-white grp-info-box clearfix">
                      <div class="box-text-content">
                          <div class="wrap-info">
                              <h4 class="rs title-in-box"><a href="#" class="be-fc-orange">Lorem ipsum.</a></h4>
                              <p class="rs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam debitis eum quae quo sit tenetur voluptates!</p>
                              <a class="btn btn-red" href="#">Learn more</a>
                          </div>
                      </div>
                      <div class="box-text-content">
                          <div class="wrap-info">
                              <h4 class="rs title-in-box"><a href="#" class="be-fc-orange">Lorem ipsum.</a></h4>
                              <p class="rs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam debitis eum quae quo sit tenetur voluptates!</p>
                              <a class="btn btn-black" href="#">Learn more</a>
                          </div>
                      </div>
                      <div class="box-text-content">
                          <div class="wrap-info">
                              <h4 class="rs title-in-box"><a href="#" class="be-fc-orange">Lorem ipsum.</a></h4>
                              <p class="rs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam debitis eum quae quo sit tenetur voluptates!</p>
                              <a class="btn btn-white" href="#">Learn more</a>
                          </div>
                      </div>
                  </div>
                  <div class="box-text-content">
                      <h4 class="rs title-in-box">Lorem ipsum dolor.</h4>
                      <p class="rs">Nam sit amet est sapien, a faucibus purus. Sed commodo facilisis tempus. Pellentesque placerat elementum adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                  </div>
                  <div class="wrap-last-post">
                      <h3 class="title">Latest posts</h3>
                      <div id="list-blog-ajax" class="list-last-post">
                          <div class="media other-post-item">
                              <a href="#" class="thumb-left">
                                  <img src="images/ex/th-90x90-1.jpg" alt="$TITLE">
                              </a>
                              <div class="media-body">
                                  <h4 class="rs title-other-post">
                                      <a href="#" class="be-fc-orange fw-b">Lorem ipsum dolor</a>
                                  </h4>
                                  <p class="rs fc-gray time-post pb10">posted 2 days ago</p>
                                  <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                              </div>
                          </div><!--end: . other-post-item -->
                          <div class="media other-post-item">
                              <a href="#" class="thumb-left">
                                  <img src="images/ex/th-90x90-2.jpg" alt="$TITLE">
                              </a>
                              <div class="media-body">
                                  <h4 class="rs title-other-post">
                                      <a href="#" class="be-fc-orange fw-b">Lorem ipsum dolor</a>
                                  </h4>
                                  <p class="rs fc-gray time-post pb10">posted 3 days ago</p>
                                  <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                              </div>
                          </div><!--end: . other-post-item -->
                          <div class="media other-post-item">
                              <a href="#" class="thumb-left">
                                  <img src="images/ex/th-90x90-3.jpg" alt="$TITLE">
                              </a>
                              <div class="media-body">
                                  <h4 class="rs title-other-post">
                                      <a href="#" class="be-fc-orange fw-b">Maecenas interdum ipsum</a>
                                  </h4>
                                  <p class="rs fc-gray time-post pb10">posted 4 days ago</p>
                                  <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                              </div>
                          </div><!--end: . other-post-item -->
                          <div class="media other-post-item">
                              <a href="#" class="thumb-left">
                                  <img src="images/ex/th-90x90-4.jpg" alt="$TITLE">
                              </a>
                              <div class="media-body">
                                  <h4 class="rs title-other-post">
                                      <a href="#" class="be-fc-orange fw-b">Nam nec sem ac risus</a>
                                  </h4>
                                  <p class="rs fc-gray time-post pb10">posted 5 days ago</p>
                                  <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                              </div>
                          </div><!--end: . other-post-item -->
                          <div class="media other-post-item">
                              <a href="#" class="thumb-left">
                                  <img src="images/ex/th-90x90-1.jpg" alt="$TITLE">
                              </a>
                              <div class="media-body">
                                  <h4 class="rs title-other-post">
                                      <a href="#" class="be-fc-orange fw-b">Lorem ipsum dolor</a>
                                  </h4>
                                  <p class="rs fc-gray time-post pb10">posted 6 days ago</p>
                                  <p class="rs description">Nam nec sem ac risus congue varius. Maecenas interdum ipsum tempor ipsum fringilla eu vehicula urna vehicula.</p>
                              </div>
                          </div><!--end: .other-post-item -->
                      </div>
                      <p class="rs ta-c">
                          <a id="showmorepost" class="btn btn-black btn-load-more" href="#">Show more posts</a>
                      </p>
                  </div>
              </div><!--end: .content -->

              <div class="sidebar grid_4">
                              <div class="box-white popular-post">
                                  <h3 class="title-box">Most popular posts</h3>
                                  <ul class="rs pb10 list-popular-post">
                                      <li>
                                          <a class="be-fc-orange mark" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange mark" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange mark" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                      <li>
                                          <a class="be-fc-orange" href="#">Nam sit amet est sapien a faucibus</a>
                                          <p class="rs fc-gray">March 13, 2013 </p>
                                      </li>
                                  </ul>
                                  <p class="rs">
                                      <a class="btn btn-red" href="#">Show more</a>
                                  </p>
                              </div>
                          </div><!--end: .sidebar -->
                          <div class="clear"></div>
@endsection
