@extends('layouts.app')

@section('title', 'Course Details')

@section('page-header', 'Course Details')

@section('content')

  <!-- Display flashed session data on successful action -->
  @include('common.session-data')

  <div class="panel panel-info">
    <div class="panel-heading">
      <h4 class="panel-title">
        Basic Course Information
      </h4>
    </div>

    <div class="panel-body">
      <div class="col-xs-12 col-md-10">
        <div class="well">
            <h3>{{ $course->subject }} {{ $course->course }}-{{ $course->section }}</h3>
            <p><strong>Instructor:</strong> {{ $instructor->first_name }} {{ $instructor->last_name }}</p>
            <p><strong>Title:</strong> {{ $course->title }}</p>
        </div>
      </div>
      @if (Auth::user()->id == $instructor->id)
         <div class="col-xs-12 col-md-2">
              <form role="form" method="POST" action="{{ url('/course/' . $course->id) }}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
    
              <!-- Delete Button -->
              <div class="form-group">
                <button type="submit" class="btn btn-danger btn-lg btn-block">Delete</button>
              </div>
            </form>
         </div>
      @endif
    </div>
  </div>

  @if (Auth::user()->id == $instructor->id)
    <div class="panel panel-warning">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Edit Course Information</a>
        </h4>
      </div>

      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labellledby="headingOne">
        <div class="panel-body">
          <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div class="well">
              <form class="form-horizontal" role="form" method="POST" action="{{ url('course/' . $course->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <!-- Subject -->
                <div class="form-group{{ $errors->has('subject') ? ' has-error': '' }}">
                  <label class="col-md-3 control-label">Subject</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="subject" value="{{ old('subject') ? old('subject') : $course->subject }}">

                    @if ($errors->has('subject'))
                      <span class="help-block"><strong>{{ $errors->first('subject') }}</strong></span>
                    @endif
                  </div>
                </div>

                <!-- Title -->
                <div class="form-group{{ $errors->has('title') ? ' has-error': '' }}">
                  <label class="col-md-3 control-label">Title</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $course->title }}">

                    @if ($errors->has('title'))
                      <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                    @endif
                  </div>
                </div>

                <!-- Course -->
                <div class="form-group{{ $errors->has('course') ? ' has-error': '' }}">
                  <label class="col-md-3 control-label">Course</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="course" value="{{ old('course') ? old('course') : $course->course }}">

                    @if ($errors->has('course'))
                      <span class="help-block"><strong>{{ $errors->first('course') }}</strong></span>
                    @endif
                  </div>
                </div>

                <!-- Section -->
                <div class="form-group{{ $errors->has('section') ? ' has-error': '' }}">
                  <label class="col-md-3 control-label">Section</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="section" value="{{ old('section') ? old('section') : $course->section }}">

                    @if ($errors->has('section'))
                      <span class="help-block"><strong>{{ $errors->first('section') }}</strong></span>
                    @endif
                  </div>
                </div>

                <!-- Edit Button -->
                <div class="form-group">
                  <div class="col-md-4 col-md-offset-6">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection