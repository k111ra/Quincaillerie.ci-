@extends('layouts.layout')
@section('title', 'Accueil')
@section('content')
 <!-- page-title -->
 <div class="ttm-page-title-row">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="d-flex justify-content-between align-items-center">
                  <div class="page-title-heading">
                      <h1 class="title">Contact Us</h1>
                  </div>
                  <div class="breadcrumb-wrapper">
                      <span class="mr-1"><i class="ti ti-home"></i></span>
                      <a title="Homepage" href="index.html">Home</a>
                      <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                      <span class="ttm-textcolor-skincolor">Contact Us</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div><!-- page-title end-->


<!--site-main start-->
<div class="site-main">

<!--google_map-->
<div id="google_map" class="google_map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d63561.22251387402!2d-4.049367306268351!3d5.328565655363482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sci!4v1692205447969!5m2!1sfr!2sci" width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<!-- google_map end -->
<section class="contact-section bg-layer bg-layer-equal-height clearfix">
  <div class="container">
      <div class="row no-gutters">
          <div class="col-lg-8 col-md-7">
              <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-grey spacing-2">
                  <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                  <div class="layer-content">
                      <!-- section title -->
                      <div class="section-title style2">
                          <div class="title-header">
                              <h5>CONTACTEZ-NOUS</h5>
                              <h2 class="title">Formulaire de contact</h2>
                          </div>
                      </div><!-- section title end -->
                      <form id="ttm-contactform" class="ttm-contactform wrap-form clearfix" method="post" action="#">
                          <div class="row">
                              <div class="col-lg-6">
                                  <label>
                                      <span class="text-input"><i class="ttm-textcolor-darkgrey ti-user"></i><input name="your-name" type="text" value="" placeholder="Votre Nom" required="required"></span>
                                  </label>
                              </div>
                              <div class="col-lg-6">
                                  <label>
                                      <span class="text-input"><i class="ttm-textcolor-darkgrey ti-mobile"></i><input name="your-phone" type="text" value="" placeholder="telephone" required="required"></span>
                                  </label>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-6">
                                  <label>
                                      <span class="text-input"><i class="ttm-textcolor-darkgrey ti-email"></i><input name="email" type="email" value="" placeholder="Email" required="required"></span>
                                  </label>
                              </div>
                              <div class="col-lg-6">
                                  <label>
                                      <span class="text-input"><i class="ttm-textcolor-darkgrey ti-location-pin"></i><input name="venue" type="text" value="" placeholder="localisation" required="required"></span>
                                  </label>
                              </div>
                          </div>
                          <label>
                              <span class="text-input"><i class="ttm-textcolor-darkgrey ti-comment"></i><textarea name="message" rows="3" cols="40" placeholder="Message" required="required"></textarea></span>
                          </label>
                          <input name="submit" type="submit" id="submit" class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor" value="Envoyer">
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-5">
              <div class="ttm-col-bgcolor-yes ttm-bg ttm-bgcolor-skincolor spacing-3">
                  <div class="ttm-col-wrapper-bg-layer ttm-bg-layer"></div>
                  <div class="layer-content">
                      <div class="box-header">
                          <div class="box-icon">
                              <i class="fa fa-paper-plane"></i>
                          </div>
                      </div>
                      <h4>Coordonnées</h4>
                      <ul class="ttm_contact_widget_wrapper">
                          <li><i class="ttm-textcolor-highlight ti ti-location-pin"></i>Abidjan, Riviera V, Route ABATTA</li>
                          <li><i class="ttm-textcolor-highlight ti ti-headphone"></i>+225 05 94 77 56 90</li>
                          <li><i class="ttm-textcolor-highlight ti ti-whatsapp"></i>+225 07 47 10 45 13</li>
                          <li><i class="ttm-textcolor-highlight ti ti-email"></i><a href="mailto:Info@quincaillerie.ci">Info@quincaillerie.ci</a></li>
                      </ul>
                      <div class="social-icons circle social-hover">
                          <ul class="list-inline">
                              <li class="social-facebook"><a class="tooltip-top ttm-textcolor-skincolor" href="https://www.facebook.com/profile.php?id=100093290342789" data-tooltip="Facebook"><i class="ti ti-facebook" aria-hidden="true"></i></a></li>
                              <li class="social-linkedin"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="Facebook"><i class="ti ti-linkedin" aria-hidden="true"></i></a></li>
                              <li class="social-gplus"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="Google+"><i class="ti ti-google" aria-hidden="true"></i></a></li>
                              <li class="social-twitter"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="Twitter"><i class="ti ti-twitter-alt" aria-hidden="true"></i></a></li>
                              <li class="social-linkedin"><a class="tooltip-top ttm-textcolor-skincolor" href="#" data-tooltip="LinkedIn"><i class="ti ti-tumblr-alt" aria-hidden="true"></i></a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- row end -->
  </div>
</section>


</div><!--site-main end-->
@endsection
