@extends('layouts.app')

@section('content')

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Creator
                    <small>UniDescription Creator</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ SITEROOT }}">Home</a>
                    </li>
                    <li class="active">Creator</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

      <div class="page-header">
        <h3>
          UniDescription Builder
        </h3>
        <div>
          <div>
            <span style="line-height: 1.428571429;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis lobortis sodales. Donec dictum ipsum eget vehicula semper. Nullam at neque faucibus, consequat massa nec, bibendum metus. Phasellus eget elit leo. In gravida ipsum non turpis mollis, in malesuada turpis lobortis. Quisque vestibulum massa felis, nec consectetur nulla sodales vel. Maecenas viverra leo lacus, non egestas turpis iaculis ut. Suspendisse diam urna, laoreet vel efficitur sit amet, bibendum id justo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas nec sollicitudin magna. Suspendisse potenti. Integer non nibh quam. Nulla scelerisque faucibus vehicula. Duis vulputate lorem diam, sed semper felis luctus sed. Proin a cursus est, a rhoncus lorem.</span>
            <br>
          </div>
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-md-12">
          <h3>
            Standards for Audio Descriptions
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Describe what you see</a>
            <a class="list-group-item disabled">Describe objectively</a>
            <a class="list-group-item disabled">Hearing the Dialogue</a>
            <a class="list-group-item disabled">Trust the Listener</a>
            <a class="list-group-item disabled">Censorship</a>
            <a class="list-group-item disabled">Consistent Language</a>
            <a class="list-group-item disabled">Race, Ethnicity and Nationality</a>
            <a class="list-group-item disabled">The Listeners' Perspective</a>
            <a class="list-group-item disabled">Good Techniques</a>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-8">
          <h3>
            Table of Contents
          </h3>
          <ul class="list-group">
            <li class="list-group-item">
              <span class="label label-success pull-right">Success</span>
              1. 30 second overview
            </li>
            <li class="list-group-item">
              <span class="label label-success pull-right">Success</span>
              2. Description
            </li>
            <li class="list-group-item">
              <span class="label label-warning pull-right">1 warning</span>
              3. Planning your visit
            </li>
            <li class="list-group-item">
              <span class="label label-warning pull-right"></span>
              &nbsp; &nbsp; 3a. Geographic Orientation
            </li>
            <li class="list-group-item">
              <span class="label label-warning pull-right"></span>
              &nbsp; &nbsp; 3b. Activities in the park
            </li>
            <li class="list-group-item">
              <span class="label label-success pull-right">Success</span>
              4. Accessibility
            </li>
            <li class="list-group-item">
              <span class="label label-danger pull-right">1 alert</span>
              5. Site highlights
            </li>
            <li class="list-group-item">
              <span class="label label-warning pull-right">3 warnings</span>
              6. For more information
            </li>
            <li class="list-group-item">
              <span class="label label-danger pull-right">2 alerts</span>
              7. Contact Information
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h3>
            Lorem Ipsum
          </h3>
          <p>
            Lorem ipsum dolor site amet, consectetur adipiscing elit.
          </p>
          <p>
            Project progress
          </p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
            aria-valuemax="100" style="width: 60%;">
              60%
            </div>
          </div>
<!--
          <div>
            Select which of the following audiences this description is written for.
          </div>
          <form>
            <label class="checkbox">
              <input type="checkbox">
              Blind
            </label>
            <label class="checkbox">
              <input type="checkbox">
              Low vision
            </label>
            <label class="checkbox">
              <input type="checkbox">
              Print disabled
            </label>
            <label class="checkbox">
              <input type="checkbox">
              Multimodal learner
            </label>
          </form>
          <div>
            <hr>
            Select a voice to use.<br />
            <select name="voice" id="choose_voice">
            </select>
          </div>
-->
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                30 Second Overview
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-success">
                <h3>
                  Success!
                </h3>
                <p>
                  Your content looks good.
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" placeholder="A 30 second overview description of the site"
              style="margin: 0px -1px 0px 0px; width: 464px; height: 173px;" name="" id="30_second_textarea"></textarea>
            </label>
          </div>
          <button type="submit" class="btn btn-default" onclick="playId(this, '30_second_textarea')">
            <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Play Audio
          </button>
          <button type="submit" class="btn btn-default" onclick="downloadId(this, '30_second_textarea')">
            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download Audio
          </button>
        </div>
        <div class="col-md-6">
          <h3>
            Standards for 30 Second Overview
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                Description
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-success">
                <h3>
                  Success!
                </h3>
                <p>
                  Your content looks good.
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" placeholder="Description placeholder" style="margin: 0px -1px 0px 0px; width: 464px; height: 173px;" id="description_textarea"
              name=""></textarea>
            </label>
          </div>
          <button type="submit" class="btn btn-default" onclick="playId(this, 'description_textarea')">
            <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
          </button>
        </div>
        <div class="col-md-6">
          <h3>
            Standards for 30 the General Description
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                Planning your visit
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-warning">
                <h3>
                  Warning!
                </h3>
                <p>
                  The content seems to short. Please verify.
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" style="margin: 0px -1px 10px 0px; width: 464px; height: 173px;" id="planning_textarea"></textarea>
              <button type="submit" class="btn btn-default" onclick="playId(this, 'planning_textarea')">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
              </button>
              <hr>
              <div class="form-group">
                <label>
                  Title
                </label>
                <input type="text" class="form-control" style="margin-bottom: 10px;" placeholder="Geographic orientation" id="geographic_textarea">
                <button type="submit" class="btn btn-default" onclick="playId(this, 'geographic_textarea')">
                  <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
                </button>
              </div>
              <div class="form-group">
                <label>
                  Description
                </label>
                <textarea class="form-control" style="margin-bottom: 10px;" id="geographic2_textarea"></textarea>
                <button type="submit" class="btn btn-default" onclick="playId(this, 'geographic2_textarea')">
                  <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
                </button>
              </div>
              <hr>
              <div class="form-group">
                <label>
                  Title
                </label>
                <input type="text" class="form-control" placeholder="Activities in the park" style="margin-bottom: 10px;" id="activities_textarea">
                <button type="submit" class="btn btn-default" onclick="playId(this, 'activities_textarea')">
                  <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
                </button>
                <div class="form-group">
                  <label>
                    Description:
                  </label>
                  <textarea class="form-control" style="margin-bottom: 10px;" id="activities2_textarea"></textarea>
                  <button type="submit" class="btn btn-default" onclick="playId(this, 'activities2_textarea');">
                    <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
                  </button>
                </div>
              </div>
            </label>
          </div>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2"
            data-toggle="dropdown" aria-expanded="true">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Add sub-category
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
              <li role="presentation" class="disabled">
                <a role="menuitem" tabindex="-1" href="#">Geographic orientation</a>
              </li>
              <li role="presentation" class="disabled">
                <a role="menuitem" tabindex="-1" href="#">Activities in the park</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Amenities in the park</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Time issues</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Safety messages</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Tips</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <h3>
            Standards for Planning your visit
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                <div>
                  <span style="line-height: 1.1;">Accessibility</span>
                  <br>
                </div>
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-success">
                <h3>
                  Success!
                </h3>
                <p>
                  Your content looks good.
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" style="margin: 0px -1px 10px 0px; width: 464px; height: 173px;" id="accessibility_textarea"></textarea>
              <button type="submit" class="btn btn-default" onclick="playId(this, 'accessibility_textarea');">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
              </button>
            </label>
          </div>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3"
            data-toggle="dropdown" aria-expanded="true">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Add sub-category
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Amenities in the park</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">What's accessible?</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Accessibile parking</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <h3>
            Standards for Accessibility
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                <div>
                  <span style="line-height: 1.1;">Site highlights</span>
                  <br>
                </div>
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-danger">
                <h3>
                  Alert!
                </h3>
                <p>
                  This is not a test
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" style="margin: 0px -1px 10px 0px; width: 464px; height: 173px;" id="highlights_textarea"></textarea>
              <button type="submit" class="btn btn-default" onclick="playId(this, 'highlights_textarea');">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
              </button>
            </label>
          </div>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu4"
            data-toggle="dropdown" aria-expanded="true">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Add sub-category
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Popular attractions</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">History</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Distinctions</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <h3>
            Standards for Site highlights
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                <div>
                  <span style="line-height: 1.1;">For more information</span>
                  <br>
                </div>
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-warning">
                <h3>
                  Alert!
                </h3>
                <p>
                  This is not a test
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" style="margin: 0px -1px 10px 0px; width: 464px; height: 173px;" id="for_more_info_textarea"></textarea>
              <button type="submit" class="btn btn-default" onclick="playId(this, 'for_more_info_textarea');">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
              </button>
            </label>
          </div>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu5"
            data-toggle="dropdown" aria-expanded="true">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Add sub-category
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu5">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Links</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <h3>
            Standards For more information
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h3>
                <div>
                  <span style="line-height: 1.1;">Contact Information</span>
                  <br>
                </div>
              </h3>
              <p>
                Lorem ipsum dolor site amet, consect.
              </p>
            </div>
            <div class="col-md-6">
              <div class="alert alert-danger">
                <h3>
                  Alert!
                </h3>
                <p>
                  This is not a test
                </p>
              </div>
            </div>
          </div>
          <div class="form-group has-success">
            <label>
              Your response:
              <textarea class="form-control" style="margin: 0px -1px 10px 0px; width: 464px; height: 173px;" id="contact_textarea"></textarea>
              <button type="submit" class="btn btn-default" onclick="playId(this, 'contact_textarea');">
                <span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
              </button>
            </label>
          </div>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu6"
            data-toggle="dropdown" aria-expanded="true">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Add sub-category
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu6">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Address</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Phone Number</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Directions</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">Website</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <h3>
            Standards for Contact Information
          </h3>
          <p>
            Click on the subjects below to read more about best practices for audio
            descriptions.
          </p>
          <div class="list-group">
            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal"
            style="cursor: pointer">Lorem ipsum dolor site amet</a>
            <a class="list-group-item disabled">site amet consectetur</a>
            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
            <a class="list-group-item disabled">Donec dictum ipsum</a>
            <a class="list-group-item disabled">Nullam at neque</a>
          </div>
          <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            Want to discuss this issue more? Join our forum!
          </button>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="whatyouseeModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">
              Basics
            </h4>
          </div>
          <div class="modal-body">
            <h3>
              Describe what you see.
            </h3>
            <p>
              This is the first rule of description: what you see is what you describe.
              One sees physical appearances and actions; one does not see motivations
              or intentions. Never describe what you think you see.
            </p>
            <div class="well">
              We see “Mary clenches her fists.” We do not see “Mary is angry”—or worse,
              “Mary is angry with John.”
            </div>
            <p>
              Preview the material with an eye toward including the visual information
              that is inaccessible to people who are blind or have low vision. These
              include key plot elements, people, places, actions, objects, unknown sound
              sources, etc. not mentioned in the dialogue or made obvious by what one
              hears. Concentrate on that which is the most significant and least obvious
              from the dialogue or other audio information. Describing everything is
              impossible—describe what is essential in the allowable time.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    

    <hr>


    
@endsection

@section('js')


    <script type="text/javascript">
        function downloadId(caller, id)
        {
            var msg = $('#'+id).val();

            jQuery.ajax({
                url: 'http://api.montanab.com/tts/tts.php',
                type: 'get',
                dataType: 'json',
                data: 't='+msg,
                success:function(data)
                {
                    console.log(data); 
                    window.open(data.fn);
                } 
            });


        }

        function playId(caller, id)
        {
            if ( $('span', caller).attr('class') == 'glyphicon glyphicon-play') {
                $(caller).html('<span class="glyphicon glyphicon-stop" aria-hidden="true"></span>Stop Audio');
                var msg = new SpeechSynthesisUtterance( $('#'+id).val() );
                var voices = speechSynthesis.getVoices();
                msg.voice = voices[ $('#choose_voice').val() ];
console.log( $('#choose_voice').val() );
                //window.speechSynthesis.speak(msg);
                speechUtteranceChunker(msg, {
                    chunkLength: 120
                }, function () {
                    //some code to execute when done
                    console.log('done');
                });
            }
            else {
                $(caller).html('<span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio');
                speechSynthesis.cancel();
            }
        }

		var speechUtteranceChunker = function (utt, settings, callback) {
		    settings = settings || {};
		    var newUtt;
		    var txt = (settings && settings.offset !== undefined ? utt.text.substring(settings.offset) : utt.text);
		    if (utt.voice && utt.voice.voiceURI === 'native') { // Not part of the spec
		        newUtt = utt;
		        newUtt.text = txt;
		        newUtt.addEventListener('end', function () {
		            if (speechUtteranceChunker.cancel) {
		                speechUtteranceChunker.cancel = false;
		            }
		            if (callback !== undefined) {
		                callback();
		            }
		        });
		    }
		    else {
		        var chunkLength = (settings && settings.chunkLength) || 160;
		        var pattRegex = new RegExp('^[\\s\\S]{' + Math.floor(chunkLength / 2) + ',' + chunkLength + '}[.!?,]{1}|^[\\s\\S]{1,' + chunkLength + '}$|^[\\s\\S]{1,' + chunkLength + '} ');
		        var chunkArr = txt.match(pattRegex);
		
		        if (chunkArr[0] === undefined || chunkArr[0].length <= 2) {
		            //call once all text has been spoken...
		            if (callback !== undefined) {
		                callback();
		            }
		            return;
		        }
		        var chunk = chunkArr[0];
		        newUtt = new SpeechSynthesisUtterance(chunk);
		        var x;
		        for (x in utt) {
		            if (utt.hasOwnProperty(x) && x !== 'text') {
		                newUtt[x] = utt[x];
		            }
		        }
		        newUtt.addEventListener('end', function () {
		            if (speechUtteranceChunker.cancel) {
		                speechUtteranceChunker.cancel = false;
		                return;
		            }
		            settings.offset = settings.offset || 0;
		            settings.offset += chunk.length - 1;
		            speechUtteranceChunker(utt, settings, callback);
		        });
		    }
		
		    if (settings.modifier) {
		        settings.modifier(newUtt);
		    }
		    console.log(newUtt); //IMPORTANT!! Do not remove: Logging the object out fixes some onend firing issues.
		    //placing the speak invocation inside a callback fixes ordering and onend issues.
		    setTimeout(function () {
		        var voices = speechSynthesis.getVoices();
		        newUtt.voice = voices[ $('#choose_voice').val() ];
		        speechSynthesis.speak(newUtt);
		    }, 0);
		};

		$( document ).ready(function() { 
		    $('.dropdown-menu').dropdown() 
		    if ('speechSynthesis' in window) {
		        // Supported
		        window.speechSynthesis.onvoiceschanged = function() {
		                var voices = window.speechSynthesis.getVoices();
		                if ($('#choose_voice option').size() < 1) {
		                    //console.log(voices);
		                    for (i = 0, len = voices.length; i < len; i++) {
		                        $('#choose_voice')
		                                .append($("<option></option>")
		                                .attr("value",i)
		                                .text(voices[i]['name'])); 
		                    }
		                    $('#choose_voice').val(0);
		                }
		
		        };
		    }
		    else {
		        alert('Speech Systhesis not supported in your browser. Use Chrome for the prototype');
		    }
		
		});
    </script>

@endsection