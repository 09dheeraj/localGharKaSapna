@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{asset('public/assets/newCss/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<style>
    .iti.iti--allow-dropdown {
        width: 100% !important;
    }
</style>

<div id="overlay-box">

</div>
<div class="wrapper ovh">
    <div class="preloader"></div>


    <div class="dashboard__main_custom pl0-md">
        <div class="dashboard__content property-page post-property-page bgc-f7">
            <div class="row pb40 d-block d-lg-none"> </div>
            <div class="row align-items-center pb40">
                <div class="col-lg-12">
                    <div class="dashboard_title_area">


                        <h2>Post Your Property</h2>
                        <a href="{{route('logout')}}"> Logout</a>
                    </div>
                </div>
            </div>
            <div class="first-section mt20">
                <form action="{{route('submit.property')}}" method="post" id="property-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 pt30 mb30 overflow-hidden position-relative">
                                <div class="navtab-style1">
                                    <div class="tab-content" id="nav-tabContent">

                                        <div class="first-tab-fields">

                                            <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                                <div class="ff-heading fw600 mb10 custom-basic-title first-tab-post-property">Add Basic Details</div>
                                                <hr>
                                                <!-- form tag -->
                                                <div class="row first-tab-post-property">
                                                    <div class="row-left">
                                                        <div class="ff-heading fw600 mb10">Property Type <span class="mandatoryMarker">*</span></div>

                                                        <div class="row">

                                                            <div class="col-xl-4 col-sm-4 mb25 margin-left-techo">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="residential" name="property_type" checked value="residential">
                                                                    <label class="form-check-label fw600" for="residential">Residential</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="commercial" name="property_type" value="commercial">
                                                                    <label class="form-check-label fw600" for="commercial">Commercial</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-right">

                                                        <div class="ff-heading text-color-black fw600 mb20">Looking to<span class="mandatoryMarker">*</span></div>
                                                        <span id="alert-error-looking_to" class="post-property"></span>
                                                        <div class="col-xl-4 col-sm-4 mb25 margin-left-techo">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="looking_to" value="rent" id="rent-radio">
                                                                <label class="form-check-label fw600" for="rent-radio">Rent</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="looking_to" value="sell" id="sell-radio">
                                                                <label class="form-check-label fw600" for="sell-radio">Sell</label>
                                                            </div>
                                                            <div class="form-check form-check-inline pg-section">
                                                                <input class="form-check-input" type="radio" name="looking_to" value="pg" id="pg-living">
                                                                <label class="form-check-label fw600" for="pg-living">PG/Co-living</label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="row">
                                                    @if(!session()->get('id'))
                                                    <div class="col-sm-4 col-xl-3 mb25 custom-display-inline">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb20">Phone<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-phone_number" class="post-property"></span>
                                                        </div>
                                                        <input type="number" class="form-control" name="phone_number" id="mobile-number" placeholder="Enter phone number">
                                                        <input type="hidden" name="update_number" id="mobile-number-hidden">
                                                    </div>
                                                    @endif

                                                    <div class="col-sm-4 col-xl-3 mb25 custom-display-inline">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb20">Search City<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-search_city" class="post-property"></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="search_city" id="search-city" placeholder="Search City">
                                                    </div>
                                                    <div class="col-sm-6 col-xl-6 mb25 building-width">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Building/Project/Society <span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-project_society" class="post-property"></span>

                                                        </div>
                                                        <input type="text" class="form-control" name="project_society" id="building-project" placeholder="Building/Project/Society">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25 building-width">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Locality <span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-locality" class="post-property"></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="locality" id="Locality" placeholder="Locality">
                                                    </div>

                                                </div>

                                                <!---------------- paying-guest-------------------- -->
                                                <div class="pg-living-section d-none">
                                                    <div class="row">
                                                        <div class="fw600 mb10 custom-basic-title">PG DETAILS</div>
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">PG Name<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-pg_name" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="pg_name" id="pg-name" placeholder="PG Name">
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Total Beds<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-total_beds" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" name="total_beds" id="total-beds" placeholder="Total Beds">
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">PG is for<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-pg_for" class="post-property"></span>

                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="pg_for" value="girls" id="pg-girls">
                                                                <label class="form-check-label fw600" for="pg-girls">Girls</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="pg_for" value="boys" id="pg-boys">
                                                                <label class="form-check-label fw600" for="pg-boys">Boys</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Best suited for<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-suited_for" class="post-property"></span>
                                                            </div>

                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="suited_for" value="students" id="suited-students">
                                                                <label class="form-check-label fw600" for="suited-students">Students</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="suited_for" value="professionals" id="suited-professionals">
                                                                <label class="form-check-label fw600" for="suited-professionals">Professionals</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Meals Available <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-meals" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="meals" value="yes" id="pg-meals-yes">
                                                                <label for="pg-meals-yes" class="form-check-label fw600">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="meals" value="no" id="pg-meals-no">
                                                                <label for="pg-meals-no" class="form-check-label fw600">No</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 secled-meals-yes d-none">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Meal Offerings<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-meal_offerings" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="checkbox" name="meal_offerings[]" value="breakfast" id="breakfast">
                                                                <label class="form-check-label fw600" for="breakfast">Breakfast</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_offerings[]" value="lunch" id="lunch">
                                                                <label class="form-check-label fw600" for="lunch">Lunch</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_offerings[]" value="dinner" id="dinner">
                                                                <label class="form-check-label fw600" for="dinner">Dinner</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 secled-meals-yes d-none">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Meal Speciality (Optional)<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-meal_speciality" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="punjabi" id="punjabi">
                                                                <label class="form-check-label fw600" for="punjabi">Punjabi</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="south indian" id="south-indian">
                                                                <label class="form-check-label fw600" for="south-indian">South Indian</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="andhra" id="andhra">
                                                                <label class="form-check-label fw600" for="andhra">Andhra</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="north indian" id="north-indian">
                                                                <label class="form-check-label fw600" for="north-indian">North Indian</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="others" id="meal-others">
                                                                <label class="form-check-label fw600" for="meal-others">Others</label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10"> Notice Period (Days) <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-notice_period" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" name="notice_period" id="notice-period" placeholder="Notice Period (Days)" oninput="displayDuration('notice-period', 'notice-period-display')">
                                                            <span id="notice-period-display"></span>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Lock in Period (Days) <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-lock_period" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" name="lock_period" id="lock-period" placeholder="Lock in Period (Days)" oninput="displayDuration('lock-period', 'lock-period-display')">
                                                            <span id="lock-period-display"></span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="ff-heading fw600 mb10">Common Areas <span class="mandatoryMarker">*</span></div><br>
                                                        <span id="alert-error-common_areas" class="post-property"></span>

                                                        <div class="col-sm-6 col-xl-12 mb25">

                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="living-room" value="living room">
                                                                <label class="form-check-label fw600" for="living-room">Living Room</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="kitchen" value="kitchen">
                                                                <label class="form-check-label fw600" for="kitchen">Kitchen</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="dining-hall" value="dining hall">
                                                                <label class="form-check-label fw600" for="dining-hall">Dining Hall</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="study-library" value="study room library">
                                                                <label class="form-check-label fw600" for="study-library">Study Room / Library</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="breakout-room" value="breakout room">
                                                                <label class="form-check-label fw600" for="breakout-room">Breakout Room</label>
                                                            </div>

                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="ff-heading fw600 mb10 custom-basic-title">OWNER / CARETAKER DETAILS <span class="mandatoryMarker">*</span></div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Property Managed By</label><br>
                                                                <span id="alert-error-property_manage" class="post-property"></span>
                                                            </div>

                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="property_manage" value="landlord" id="landlord">
                                                                <label class="form-check-label fw600" for="landlord">Landlord</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_manage" value="caretaker" id="caretaker">
                                                                <label class="form-check-label fw600" for="caretaker">Caretaker</label>
                                                            </div>

                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="property_manage" value="dedicated professional" id="dedicated-professional">
                                                                <label class="form-check-label fw600" for="dedicated-professional">Dedicated Professional</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Property Manager stays at Property <span class="mandatoryMarker">*</span></label><br>

                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="stays_property" value="yes" id="property-manger-yes">
                                                                <label class="form-check-label fw600" for="property-manger-yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="stays_property" value="no" id="property-manger-no">
                                                                <label class="form-check-label fw600" for="property-manger-no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="ff-heading fw600 mb10 custom-basic-title">PG RULES</div>
                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Non Veg Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="non_veg" value="yes" id="pg-non-vegYes">
                                                                <label class="form-check-label fw600" for="pg-non-vegYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="non_veg" value="no" id="pg-non-vegno">
                                                                <label class="form-check-label fw600" for="pg-non-vegno">No</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Opposite Sex Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="pg_sex" value="yes" id="pg-sexYes">
                                                                <label class="form-check-label fw600" for="pg-sexYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="pg_sex" value="no" id="pg-sexNo">
                                                                <label class="form-check-label fw600" for="pg-sexNo">No</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Any Time Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="pg_time_allowed" value="yes" id="any-timeYes">
                                                                <label class="form-check-label fw600" for="any-timeYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="pg_time_allowed" value="no" id="any-timeNo">
                                                                <label class="form-check-label fw600" for="any-timeNo">No</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Visitors Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="visitors_allowed" value="yes" id="visitors-Yes">
                                                                <label class="form-check-label fw600" for="visitors-Yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="visitors_allowed" value="no" id="visitors-No">
                                                                <label class="form-check-label fw600" for="visitors-No">No</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Guardian Allowed<span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="guardian_allowed" value="yes" id="guardian-yes">
                                                                <label class="form-check-label fw600" for="guardian-yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="guardian_allowed" value="no" id="guardian-no">
                                                                <label class="form-check-label fw600" for="guardian-no">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Drinking - Smoking Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="drin_smok_allowed" value="yes" id="pg-smokingYes">
                                                                <label class="form-check-label fw600" for="pg-smokingYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="drin_smok_allowed" value="no" id="pg-smokingNo">
                                                                <label class="form-check-label fw600" for="pg-smokingNo">No</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="custom-basic-title ff-heading fw600 mb10">Add Room Details</div>
                                                    <div class="row">
                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Room Type <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-room_type" class="post-property"></span>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="private room" id="private-room">
                                                                <label class="form-check-label fw600" for="private-room">Private Room</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="double sharing" id="double_sharing">
                                                                <label class="form-check-label fw600" for="double_sharing">Double Sharing</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="triple sharing" id="triple_sharing">
                                                                <label class="form-check-label fw600" for="triple_sharing">Triple Sharing</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="three plus sharing" id="three-plus-sharing">
                                                                <label class="form-check-label fw600" for="three-plus-sharing">3+ Sharing</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 ">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Total Beds in this Room (Optional)</label><br>
                                                                <span id="alert-error-total_beds_this_room" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Total Beds in this Room" id="pg-total-bad" name="total_beds_this_room">
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Bathroom Style</label><br>
                                                                <span id="alert-error-bath_style" class="post-property"></span>

                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="bathStyle-Western" name="bath_style[]" value="western">
                                                                <label class="form-check-label fw600" for="bathStyle-Western">Western</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="bathStyle-Indian" name="bath_style[]" value="indian">
                                                                <label class="form-check-label fw600" for="bathStyle-Indian">Indian</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="ff-heading fw600 mb10 property-type-heading d-none first-tab-post-property">Property Type <span class="mandatoryMarker">*</span></div>
                                                <span id="alert-error-category_type" class="post-property"></span>
                                                <div class="col-6 col-sm-6 mb25 first-tab-post-property">
                                                    <div class="residential-property d-none">

                                                        <div class="form-check form-check-inline margin-left-techo">
                                                            <input class="form-check-input" type="radio" name="category_type" value="apartment" id="apartment">
                                                            <label class="form-check-label fw600" for="apartment" id="apartment-width">

                                                                <span>Apartment</span>
                                                            </label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="category_type" value="independent floor" id="independent-floor">
                                                            <label class="form-check-label fw600" for="independent-floor">

                                                                <span>Independent Floor</span>
                                                            </label>
                                                        </div>


                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="category_type" value="independent house" id="independent-house">
                                                            <label class="form-check-label fw600" for="independent-house">

                                                                <span>Independent House</span>
                                                            </label>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories residential-plot">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="plot" id="plot-resi">
                                                                <label class="form-check-label fw600" for="plot-resi">
                                                                    <span>Plot</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="commercial-property d-none">

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="plot" id="plot-comm">
                                                                <label class="form-check-label fw600" for="plot-comm">
                                                                    <span>Plot</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="office" id="office">
                                                                <label class="form-check-label fw600" for="office">
                                                                    <span>Office</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="retail shop" id="reatail-shop">
                                                                <label class="form-check-label fw600" for="reatail-shop">
                                                                    <span>Retail Shop</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="showroom" id="showroom">
                                                                <label class="form-check-label fw600" for="showroom">
                                                                    <span>Showroom</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="warehouse" id="warehouse">
                                                                <label class="form-check-label fw600" for="warehouse">
                                                                    <span>Warehouse</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="second-section mt20 d-none">

                                            <div class="ff-heading fw600 mb10 custom-basic-title add-property-title">Add Property Details</div>
                                            <!--------------------------------- residential-property-type ------------------------>
                                            <div class="row residential-property-section ">
                                                <div class="row plot-section">
                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Plot Area<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-plot_area" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Plot Area" name="plot_area" id="plot-area">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb15">
                                                        <div class="mb20">
                                                            <label for="phone" class="ff-heading fw600 mb10">Area Unit</label><br>
                                                            <div class="location-area">
                                                                <select class="selectpicker" id="area-unit" name="area_unit">
                                                                    <option value="sqft">sq. ft.</option>
                                                                    <option value="sqyd">sq. yd.</option>
                                                                    <option value="sqmt">sq. mt.</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Length</label><br>
                                                            <span id="alert-error-plot_length" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Length" name="plot_length" id="plot-length">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Width</label><br>
                                                            <span id="alert-error-plot_width" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Width" name="plot_width" id="plot-width">
                                                    </div>
                                                </div>


                                                <div class="residential-property-type">
                                                    <div class="row residential-property-select">
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">BHK <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-total_property" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" value="1 RK" id="one-rk">
                                                                <label class="form-check-label fw600" for="one-rk">1 RK</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" value="1" id="one-bhk">
                                                                <label class="form-check-label fw600" for="one-bhk">1 BHK</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" value="2" id="two-bhk">
                                                                <label class="form-check-label fw600" for="two-bhk">2 BHK</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" id="three-bhk" value="3">
                                                                <label class="form-check-label fw600" for="three-bhk">3 BHK</label>
                                                            </div>

                                                            <div class="form-check form-check-inline three-plus-bhk">
                                                                <input class="form-check-input" type="radio" name="total_property" id="plus-three-bhk">
                                                                <label class="form-check-label fw600" for="plus-three-bhk">3+ BHK</label>
                                                            </div>

                                                            <div class="after-3bhk d-none">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="4" id="four-bhk">
                                                                    <label class="form-check-label fw600" for="four-bhk">4 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="5" id="five-bhk">
                                                                    <label class="form-check-label fw600" for="five-bhk">5 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="6" id="six-bhk">
                                                                    <label class="form-check-label fw600" for="six-bhk">6 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="7" id="seven-bhk">
                                                                    <label class="form-check-label fw600" for="seven-bhk">7 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="8" id="eight-bhk">
                                                                    <label class="form-check-label fw600" for="eight-bhk">8 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="9" id="nine-bhk">
                                                                    <label class="form-check-label fw600" for="nine-bhk">9 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="10" id="ten-bhk">
                                                                    <label class="form-check-label fw600" for="ten-bhk">10 BHK</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 built-up-area-width">
                                                            <div class="location-area">
                                                                <label for="built-up-area" class="ff-heading fw600 mb10 ">Built Up Area <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-built_up_area" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" name="built_up_area" id="built-up-area" placeholder="Built Up Area" oninput="showSqft(this)">
                                                        </div>

                                                        <div class="col-sm-4 col-xl-3 mb25 custom-display-inline bathroom-section-width">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb20">Number of Bathooms<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-bath" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="bath" id="bath" placeholder="Number of Bathooms" value="">
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25  bathroom-section-width">
                                                            <div class="location-area">
                                                                <label for="number" class="ff-heading fw600 mb10">Number of Balconies <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-balconies" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" name="balconies" id="balconies" placeholder="Number of Balconies">
                                                        </div>

                                                        <div class="col-sm-4 col-xl-4 mb25  bathroom-section-width ">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Age of property<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-age_of_property" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="0-1" id="age-of-property0-1">
                                                                <label class="form-check-label fw600" for="age-of-property0-1">0-1 years</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="1-5" id="age-of-property1-5">
                                                                <label class="form-check-label fw600" for="age-of-property1-5">1-5 years</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="5-10" id="age-of-property5-10">
                                                                <label class="form-check-label fw600" for="age-of-property5-10">5-10 years</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="10" id="age-of-property10plus">
                                                                <label class="form-check-label fw600" for="age-of-property10plus">10+ years</label>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="residential-property-type residential-property-select">
                                                    <div class="row ">
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Furnish Type<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-furnishing" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="furnishing" value="fully furnished" id="fully-furnished">
                                                                <label class="form-check-label fw600" for="fully-furnished">Fully Furnished</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="furnishing" value="semi furnished" id="semi-furnished">
                                                                <label class="form-check-label fw600" for="semi-furnished">Semi Furnished</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="furnishing" value="unfurnished" id="unfurnished">
                                                                <label class="form-check-label fw600" for="unfurnished">Unfurnished</label>
                                                            </div>

                                                            <a class="login-info d-flex align-items-center" data-bs-toggle="modal" href="#add-amenities" role="button"><span class=" d-xl-block">+ Add Furnishings / Amenities</span></a>
                                                            <div class="css-1m8aqr3">
                                                                <div>
                                                                    <div class="flat-furnishings">

                                                                    </div>

                                                                    <input type="hidden" name="residential_amenities" id="residential-amenities">

                                                                    <div class="society-amenities">
                                                                        <!-- Society Amenities checkboxes -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="css-1m8aqr3">

                                                    </div>

                                                </div>


                                            </div>

                                            <div class="commercial-property-type">

                                                <div class="secleted-office">
                                                    <div class="row">
                                                        <div class="custom-basic-title ff-heading fw600 mb10"> ABOUT THE PROPERTY</div>

                                                        <div class="col-sm-6 col-xl-6 mb25 zone-width">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10" id="about-property-zone">Suitable For<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-zone_type" class="post-property"></span>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="industrial" id="zone-industrial">
                                                                <label class="form-check-label fw600" for="zone-industrial">Industrial</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="commercial" id="zone-commercial">
                                                                <label class="form-check-label fw600" for="zone-commercial">Commercial</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="residential" id="zone-residential">
                                                                <label class="form-check-label fw600" for="zone-residential">Residential</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="open spaces" id="zone-spaces">
                                                                <label class="form-check-label fw600" for="zone-spaces">Open Spaces</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="agricultural zone" id="zone-agricultural">
                                                                <label class="form-check-label fw600" for="zone-agricultural">Agricultural zone</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="jewwllery" id="zone-jewwllery">
                                                                <label class="form-check-label fw600" for="zone-jewwllery">Jewellery</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="gym" id="zone-gym">
                                                                <label class="form-check-label fw600" for="zone-gym">Gym</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="grocery" id="zone-grocery">
                                                                <label class="form-check-label fw600" for="zone-grocery">Grocery</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="footwear" id="zone-footwear">
                                                                <label class="form-check-label fw600" for="zone-footwear">Footwear</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="clinic" id="zone-clinic">
                                                                <label class="form-check-label fw600" for="zone-clinic">Clinic</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="electronics" id="zone-electronics">
                                                                <label class="form-check-label fw600" for="zone-electronics">Electronics</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="clothing" id="zone-clothing">
                                                                <label class="form-check-label fw600" for="zone-clothing">Clothing</label>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 location-hub-width">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Location Hub<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-location_hub" class="post-property"></span>

                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="it park" id="location-it">
                                                                <label class="form-check-label fw600" for="location-it">IT Park</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="business park" id="location-business">
                                                                <label class="form-check-label fw600" for="location-business">Business Park</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="mall" id="lHub-mall">
                                                                <label class="form-check-label fw600" for="lHub-mall">Mall</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="commercial project" id="lHub-commercial">
                                                                <label class="form-check-label fw600" for="lHub-commercial">Commercial Project</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="residential project" id="lHub-residential">
                                                                <label class="form-check-label fw600" for="lHub-residential">Residential Project</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="market high street" id="lHub-market">
                                                                <label class="form-check-label fw600" for="lHub-market">Market/High Street</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="custom-basic-title ff-heading fw600 mb10">POSSESSTION INFO</div>

                                                    <div class="row">
                                                        <div class="col-sm-6 col-xl-6 mb25 location-page-width">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Posession status<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-property_status" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_status" id="ready-to-move-commerical" value="ready to move">
                                                                <label class="form-check-label fw600" for="ready-to-move-commerical">Ready to move</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_status" id="under-construction-commerical" value="under construction">
                                                                <label class="form-check-label fw600" for="under-construction-commerical">Under construction</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 location-page-width property-condition">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Property Condition<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-property_condition" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_condition" id="commerical-ready-to-use" value="ready to use">
                                                                <label class="form-check-label fw600" for="commerical-ready-to-use">Ready to use</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="commerical-bare-shell" name="property_condition" value="bare shell">
                                                                <label class="form-check-label fw600" for="commerical-bare-shell">Bare shell</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 location-page-width located-near d-none">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Located Near<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-located_near" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="located_near[]" id="shop-entrance" value="entrance">
                                                                <label class="form-check-label fw600" for="shop-entrance">Entrance</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="located_near[]" id="shop-elevator" value="elevator">
                                                                <label class="form-check-label fw600" for="shop-elevator">Elevator</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="shop-stairs" name="located_near[]" value="stairs">
                                                                <label class="form-check-label fw600" for="shop-stairs">Stairs</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-3 col-xl-3 mb25 built-up-area">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Built Up Area <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_built_up" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Built Up Area" name="comm_built_up" oninput="showSqft(this)" id="comm-built-up">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="seclected-Retail-Shop">
                                                    <div class="row">


                                                        <div class="col-sm-3 col-xl-3 mb25 commerical-available-from">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10" id="comm-avail-from">Available From<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-available_from" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control datepicker" placeholder="Available From" name="available_from" id="available-from">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 age-of-property-commerical d-none">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Age of Property (in years)<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_age_property" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Age of Property (in years)" name="comm_age_property">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 carpet-area-commerical d-none">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Carpet Area<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-carpet_area" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Carpet Area" name="carpet_area" id="carpet-area">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 entrance-width-in-feet d-none">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Entrance width in feet<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_area_width" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Entrance width in feet" name="comm_area_width" id="com-area-width">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 ceiling-height-in-feet d-none">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Ceiling height in feet<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_area_height" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Ceiling height in feet" name="comm_area_height" id="comm-area-height">
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-4 col-xl-4 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Ownership<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-ownership" class="post-property"></span>

                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="freehold" id="own-freehold">
                                                            <label class="form-check-label fw600" for="own-freehold">Freehold</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="leasehold" id="own-leasehold">
                                                            <label class="form-check-label fw600" for="own-leasehold">Leasehold</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="cooperative society" id="own-cooperative">
                                                            <label class="form-check-label fw600" for="own-cooperative">Cooperative society</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="power attorney" id="own-attorney">
                                                            <label class="form-check-label fw600" for="own-attorney">Power of attorney</label>
                                                        </div>
                                                    </div>

                                                    <!-- <div class=" custom-basic-title ff-heading fw600 mb10"> FINANCIALS</div> -->

                                                    <!-- <div class=""> -->


                                                    <div class="col-sm-3 col-xl-3 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Negotiable</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="negotiable-Yes" name="negotiable" value="yes">
                                                            <label class="form-check-label fw600" for="negotiable-Yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="negotiable-No" name="Negotiable" value="no">
                                                            <label class="form-check-label fw600" for="negotiable-No">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xl-3 mb25 dg-ups-charge-include">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10" id="dg-ups-charge">DG & UPS Charge included?</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="ups-charge-yes" name="dg_ups_charge" value="yes">
                                                            <label class="form-check-label fw600" for="ups-charge-yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="ups-charge-No" name="dg_ups_charge" value="no">
                                                            <label class="form-check-label fw600" for="ups-charge-No">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xl-3 mb25 electricity-charges">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Electricity charges included?</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="electricity-yes" name="electricity_charges" value="yes">
                                                            <label class="form-check-label fw600" for="electricity-yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="electricity-No" name="electricity_charges" value="no">
                                                            <label class="form-check-label fw600" for="electricity-No">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xl-3 mb25 water-charges">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Water charges included?</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="waterChar-Yes" name="water_charges" value="yes">
                                                            <label class="form-check-label fw600" for="waterChar-Yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="waterChar-No" name="water_charges" value="no">
                                                            <label class="form-check-label fw600" for="waterChar-No">No</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row plot-seclet floors-data">
                                                    <div class=" custom-basic-title ff-heading fw600 mb10">FLOORS AVAILABLE</div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Total Floors<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-total_floors" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Total Floors" name="total_floors" id="total-floors">

                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Your Floor</label><br>
                                                            <span id="alert-error-your_floor" class="post-property"></span>
                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Your Floor" name="your_floor" id="your-floor">

                                                    </div>
                                                </div>

                                                <div class="secleted-office plot-seclet custom-lifts-staircases">
                                                    <div class="row">
                                                        <div class="custom-basic-title ff-heading fw600 mb10">LIFTS & STAIRCASES</div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Number of staircase</label><br>
                                                                <span id="alert-error-staircase" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="staircase" name="staircase" id="staircase">

                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Passengers Lifts<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-passenger_lift" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Passengers Lifts" name="passenger_lift" id="passenger-lift">

                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Service Lifts<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-service_lift" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Service Lifts" name="service_lift" id="service-lift">

                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Conference Room</label><br>
                                                                <span id="alert-error-conference_room" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Conference Room" name="conference_room" id="conference-room">

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="plot-seclet">


                                                    <div class="custom-basic-title ff-heading fw600 mb10">FACILITIES</div>

                                                    <div class="secleted-office custom-office-facilities">
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">Min. Number of seats<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-min_seat" class="post-property"></span>
                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Min. Number of seats" name="min_seat" id="min-seat">

                                                            </div>
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">please enter maximum seats<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-max_seat" class="post-property"></span>
                                                                </div>
                                                                <input type="number" class="form-control" placeholder="please enter maximum seats" name="max_seat" id="max-seat">

                                                            </div>
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">Number of Cabins<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-number_of_cabins" class="post-property"></span>

                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Number of Cabins" name="number_of_cabins" id="cabins">

                                                            </div>
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">Number of Meeting Rooms<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-meeting_rooms" class="post-property"></span>

                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Number of Meeting Rooms" name="meeting_rooms" id="meeting-room">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ff-heading fw600 mb10"></div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Private Parking</label><br>
                                                                <span id="alert-error-private_parking" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Private Parking" name="private_parking" id="private-parking">

                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Public Parking</label><br>
                                                                <span id="alert-error-public_parking" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Public Parking" name="public_parking" id="public-parking">

                                                        </div>
                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Private Washrooms<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-private_washrooms" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Private Washrooms" name="private_washrooms" id="private-washroom">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Public Washrooms<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-public_washrooms" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Public Washrooms" name="public_washrooms" id="public-washroom">
                                                        </div>




                                                    </div>

                                                    <a class="login-info d-flex align-items-center" data-bs-toggle="modal" href="#add-amenities-commerical" role="button"><span class=" d-xl-block">+ Add Furnishings / Amenities</span></a>

                                                    <div class="css-1m8aqr3">
                                                        <div>
                                                            <div class="flat-furnishings-comm">
                                                                <!-- Flat Furnishings checkboxes -->
                                                            </div>

                                                            <input type="hidden" name="commerical_amenities" id="commercial-amenities">

                                                            <div class="society-amenities-comm">
                                                                <!-- Society Amenities checkboxes -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="thirds-section d-none">

                <div class="select-residential-sell ">
                    <div class="row">
                        <div class="custom-basic-title ff-heading fw600 mb10">Add Price Details</div>

                        <div class="col-sm-4 col-xl-4 mb25">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10" id="property-price">Price<span class="mandatoryMarker">*</span></label><br>
                                <span id="alert-error-price" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter price" id="price" name="price" oninput="formatRent(this)">
                            <span class="formatted-rent"></span>
                        </div>



                        <div class="col-sm-4 col-xl-4 mb25 select-available-from d-none">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Available From</label><br>
                                <span id="alert-error-available_date" class="post-property"></span>

                            </div>
                            <input type="text" class="form-control datepicker" placeholder="Available From" name="available_date" id="available-date">
                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-security-deposite-text d-none">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Security Deposit</label><br>
                                <span id="alert-error-security_deposit" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Security Deposit" id="security-deposite" name="security_deposit" oninput="secuirtyForment(this)">
                            <span class="secuirtyForment"></span>
                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-possion-status">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Posession status</label><br>
                                <span id="alert-error-posession_status_comm" class="post-property"></span>

                            </div>


                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="immediate" name="posession_status_comm" value="immediate">
                                <label class="form-check-label fw600" for="immediate">Immediate</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="in-future" name="posession_status_comm" value="in future">
                                <label class="form-check-label fw600" for="in-future">In Future</label>
                            </div>

                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-possion-status-residential d-none">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Posession status</label><br>
                                <span id="alert-error-posession_status_resi" class="post-property"></span>

                            </div>


                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="ready-to-move" name="posession_status_resi" value="ready to move">
                                <label class="form-check-label fw600" for="ready-to-move">Ready to Move</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="under-costruction" name="posession_status_resi" value="under construction">
                                <label class="form-check-label fw600" for="under-costruction">Under Construction</label>
                            </div>

                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-possiession-date d-none">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Possession Date </label><br>
                                <span id="alert-error-possession_date" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control datepicker" placeholder="Possession Date" name="possession_date">
                        </div>

                        <div class="col-sm-3 col-xl-3 mb25 meal-charege-per-month d-none">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Meal Charges per Month (Optional)</label><br>
                                <span id="alert-error-meal_charges_month" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Meal Charges per Month" name="meal_charges_month" id="meal-charge">
                        </div>

                        <div class="col-sm-3 col-xl-3 mb25 electricity-charge-per-month d-none">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Electricity Charges per Month (Optional)</label><br>
                                <span id="alert-error-electricity_charges_month" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Electricity Charges per Month" name="electricity_charges_month" id="electricity-charge">
                        </div>




                    </div>
                </div>





                <div class="checked-commerical-sell-rent">
                    <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                        <h4 class="text-color-black fz17 mb30">Upload photos of your property</h4>
                        <span id="images-uploaderror" class="text-danger"></span>
                        <div class="col-lg-12">
                            <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">

                                <div class="icon mb30"><span class="flaticon-upload"></span></div>
                                <h4 class="text-color-black fz17 mb10">Upload photos of your property</h4>
                                <label for="photo-upload" class="ud-btn btn-white">
                                    Browse Files<input id="photo-upload" type="file" name="property_img[]" multiple style="display: none;">
                                    <i class="fal fa-arrow-right-long"></i>
                                </label>


                            </div>

                            <div id="image-preview-container" class="image-preview-container"></div>


                        </div>
                        <div class="col-lg-5">
                            <div class="profile-box position-relative d-md-flex align-items-end mb50" id="image-preview-container">
                                <div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="text-color-black fz17 mb30">Upload Videos of your property</h4>
                            <span id="videos-uploaderror" class="text-danger"></span>


                            <div class="col-lg-12">
                                <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">

                                    <div class="icon mb30"><span class="flaticon-upload"></span></div>
                                    <h4 class="text-color-black fz17 mb10">Upload Videos of your property</h4>
                                    <p class="text-color-black mb25">Add videos of your property</p>
                                    <label for="video-upload" class="ud-btn btn-white">
                                        Upload Videos<input id="video-upload" type="file" name="property_video[]" style="display: none;">
                                        <i class="fal fa-arrow-right-long"></i>
                                        <div id="file-names-container"></div>
                                    </label>

                                </div>
                            </div>
                            <div id="video-player" style="text-align: center;"></div>

                        </div>
                    </div>


                </div>

            </div>

            <div class="col-md-12 first-btn">
                <div class="d-sm-flex justify-content-between">
                    <a class="ud-btn btn-dark" id="continue-btn" role="button">Continue<i class="fal fa-arrow-right-long"></i></a>
                </div>
            </div>

            </form>


        </div>
    </div>

</div>







<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>

<div class="signup-modal">
    <div class="modal fade" id="otpModal" aria-hidden="true" aria-labelledby="otpModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Welcome to Ghar Ka Sapna</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="log-reg-form">
                        <div class="navtab-style2">
                            <div class="tab-content" id="nav-tabContent2">
                                <div class="form-style1">
                                    <h5 class="modal-title" id="otp-message"></h5>
                                    <span class="text-danger" id="error-message"></span>

                                    <div class="mb25">
                                        <label class="form-label fw600">OTP</label>
                                        <input type="text" id="otp-input" class="form-control" placeholder="Enter OTP" required>
                                    </div>


                                    <div class="d-grid mb20">
                                        <button class="ud-btn btn-dark" id="verify-otp-btn">Verify OTP<i class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body text-center">
                <span><i class="fa-solid fa-circle-xmark"></i></span>

                <p class="mb-4">Please fill this to continue</p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add-amenities" aria-hidden="true" aria-labelledby="add-amenitiesLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Add Furnishings and Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="log-reg-form">
                    <div class="navtab-style2">
                        <div class="tab-content" id="nav-tabContent2">
                            <div class="form-style1">
                                <div class="ff-heading fw600 mb10">Flat Furnishings</div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Dining Table" id="amenities-dining">
                                    <label class="form-check-label fw600" for="amenities-dining">Dining Table</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Washing Machine" id="amenities-washMachine">
                                    <label class="form-check-label fw600" for="amenities-washMachine">Washing Machine</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Sofa" id="amenities-sofa">
                                    <label class="form-check-label fw600" for="amenities-sofa">Sofa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Microwave" id="amenities-Microwave">
                                    <label class="form-check-label fw600" for="amenities-Microwave">Microwave</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Stove" id="amenities-stove">
                                    <label class="form-check-label fw600" for="amenities-stove">Stove</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Fridge" id="amenities-fridge">
                                    <label class="form-check-label fw600" for="amenities-fridge">Fridge</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Water Purifier" id="amenities-waterPurifier">
                                    <label class="form-check-label fw600" for="amenities-waterPurifier">Water Purifier</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Gas Pipeline" id="amenities-GasPipeline">
                                    <label class="form-check-label fw600" for="amenities-GasPipeline">Gas Pipeline</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="AC" id="amenities-ac">
                                    <label class="form-check-label fw600" for="amenities-ac">AC</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Bed" id="amenities-bed">
                                    <label class="form-check-label fw600" for="amenities-bed">Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="TV" id="amenities-tv">
                                    <label class="form-check-label fw600" for="amenities-tv">TV</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Cupboard" id="amenities-Cupboard">
                                    <label class="form-check-label fw600" for="amenities-Cupboard">Cupboard</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishings[]" value="Geyser" id="amenities-Geyser">
                                    <label class="form-check-label fw600" for="amenities-Geyser">Geyser</label>
                                </div>


                                <div class="ff-heading fw600 mb10">Society Amenities</div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Lift" id="amenities-lift">
                                    <label class="form-check-label fw600" for="amenities-lift">Lift</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="CCTV" id="amenities-CCTV">
                                    <label class="form-check-label fw600" for="amenities-CCTV">CCTV</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Gym" id="amenities-gym">
                                    <label class="form-check-label fw600" for="amenities-gym">Gym</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Garden" id="amenities-Garden">
                                    <label class="form-check-label fw600" for="amenities-Garden">Garden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="kids Area" id="amenities-kids">
                                    <label class="form-check-label fw600" for="amenities-kids">Kids Area</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Sports" id="amenities-Sports">
                                    <label class="form-check-label fw600" for="amenities-Sports">Sports</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Swimming Pool" id="amenities-Swimming">
                                    <label class="form-check-label fw600" for="amenities-Swimming">Swimming Pool</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Intercom" id="amenities-Intercom">
                                    <label class="form-check-label fw600" for="amenities-Intercom">Intercom</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Gated Community" id="amenities-Gated">
                                    <label class="form-check-label fw600" for="amenities-Gated">Gated Community</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Club House" id="amenities-Club">
                                    <label class="form-check-label fw600" for="amenities-Club">Club House</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Community Hall" id="amenities-Hall">
                                    <label class="form-check-label fw600" for="amenities-Hall">Community Hall</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Regular Water Supply" id="amenities-Water_Supply">
                                    <label class="form-check-label fw600" for="amenities-Water_Supply">Regular Water Supply</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Power Backup" id="amenities-Power">
                                    <label class="form-check-label fw600" for="amenities-Power">Power Backup</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenities[]" value="Pet Allowed" id="amenities-pet">
                                    <label class="form-check-label fw600" for="amenities-pet">Pet Allowed</label>
                                </div>
                                <div class="css-0"><button class="css-1rk44f" onclick="saveSelection()">Save</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add-amenities-commerical" aria-hidden="true" aria-labelledby="add-amenities-commericalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Add Furnishings and Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="log-reg-form">
                    <div class="navtab-style2">
                        <div class="tab-content" id="nav-tabContent2">
                            <div class="form-style1">
                                <div class="ff-heading fw600 mb10">Flat Furnishings</div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Dining Table" id="Furnishings-dining">
                                    <label class="form-check-label fw600" for="Furnishings-dining">Dining Table</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Washing Machine" id="Furnishings-washMachine">
                                    <label class="form-check-label fw600" for="Furnishings-washMachine">Washing Machine</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Sofa" id="Furnishings-sofa">
                                    <label class="form-check-label fw600" for="Furnishings-sofa">Sofa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Microwave" id="Furnishings-Microwave">
                                    <label class="form-check-label fw600" for="Furnishings-Microwave">Microwave</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Stove" id="Furnishings-stove">
                                    <label class="form-check-label fw600" for="Furnishings-stove">Stove</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Fridge" id="Furnishings-fridge">
                                    <label class="form-check-label fw600" for="Furnishings-fridge">Fridge</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Water Purifier" id="Furnishings-waterPurifier">
                                    <label class="form-check-label fw600" for="Furnishings-waterPurifier">Water Purifier</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Gas Pipeline" id="Furnishings-GasPipeline">
                                    <label class="form-check-label fw600" for="Furnishings-GasPipeline">Gas Pipeline</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="AC" id="Furnishings-ac">
                                    <label class="form-check-label fw600" for="Furnishings-ac">AC</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Bed" id="Furnishings-bed">
                                    <label class="form-check-label fw600" for="Furnishings-bed">Bed</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="TV" id="Furnishings-tv">
                                    <label class="form-check-label fw600" for="Furnishings-tv">TV</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Cupboard" id="Furnishings-Cupboard">
                                    <label class="form-check-label fw600" for="Furnishings-Cupboard">Cupboard</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="furnishingscomm[]" value="Geyser" id="Furnishings-Geyser">
                                    <label class="form-check-label fw600" for="Furnishings-Geyser">Geyser</label>
                                </div>


                                <div class="ff-heading fw600 mb10">Society Amenities</div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Lift" id="Furnishings-lift">
                                    <label class="form-check-label fw600" for="Furnishings-lift">Lift</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="CCTV" id="Furnishings-CCTV">
                                    <label class="form-check-label fw600" for="Furnishings-CCTV">CCTV</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Gym" id="Furnishings-gym">
                                    <label class="form-check-label fw600" for="Furnishings-gym">Gym</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Garden" id="Furnishings-Garden">
                                    <label class="form-check-label fw600" for="Furnishings-Garden">Garden</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="kids Area" id="Furnishings-kids">
                                    <label class="form-check-label fw600" for="Furnishings-kids">Kids Area</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Sports" id="Furnishings-Sports">
                                    <label class="form-check-label fw600" for="Furnishings-Sports">Sports</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Swimming Pool" id="Furnishings-Swimming">
                                    <label class="form-check-label fw600" for="Furnishings-Swimming">Swimming Pool</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Intercom" id="Furnishings-Intercom">
                                    <label class="form-check-label fw600" for="Furnishings-Intercom">Intercom</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Gated Community" id="Furnishings-Gated">
                                    <label class="form-check-label fw600" for="Furnishings-Gated">Gated Community</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Club House" id="Furnishings-Club">
                                    <label class="form-check-label fw600" for="Furnishings-Club">Club House</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Community Hall" id="Furnishings-Hall">
                                    <label class="form-check-label fw600" for="Furnishings-Hall">Community Hall</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Regular Water Supply" id="Furnishings-Water_Supply">
                                    <label class="form-check-label fw600" for="Furnishings-Water_Supply">Regular Water Supply</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Power Backup" id="Furnishings-Power">
                                    <label class="form-check-label fw600" for="Furnishings-Power">Power Backup</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="society_amenitiescomm[]" value="Pet Allowed" id="Furnishings-pet">
                                    <label class="form-check-label fw600" for="Furnishings-pet">Pet Allowed</label>
                                </div>
                                <div class="css-0"><button class="css-1rk44f" onclick="saveSelectioncomm()">Save</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
    $(document).ready(function() {

        $('#residential').click(function() {
            $('#commercial').prop('checked', false);
            $('#pg-living').prop('disabled', false);
            $('.second-section').addClass('d-none');
            $('.thirds-section').addClass('d-none');


        });

        $('#commercial').click(function() {
            $('#residential').prop('checked', false);
            $('#pg-living').prop('disabled', true);
            $('.second-section').addClass('d-none');
            $('.thirds-section').addClass('d-none');
        });


        $('#pg-living').click(function() {
            $('#commercial').prop('disabled', true);
            $('#rent-radio').prop('checked', false);
            $('#sell-radio').prop('checked', false);
            $('.thirds-section').addClass('d-none');

        });

        $('#rent-radio').click(function() {
            $('#pg-living').prop('checked', false);
            $('#sell-radio').prop('checked', false);
            $('#commercial').prop('disabled', false);
            $('.second-section').addClass('d-none');
            $('.thirds-section').addClass('d-none');
        });

        $('#sell-radio').click(function() {
            $('#pg-living').prop('checked', false);
            $('#rent-radio').prop('checked', false);
            $('#commercial').prop('disabled', false);
            $('.second-section').addClass('d-none');
            $('.thirds-section').addClass('d-none');
        });

        $('#in-future').click(function() {
            $('.select-possiession-date').removeClass('d-none');
        });

        $('#immediate').click(function() {
            $('.select-possiession-date').addClass('d-none');
        });

       // $('#custom-security').click(function() {
        //    $('.select-security-deposite-text').removeClass('d-none');
       // });

        // $('#two-month-security, #one-month-security, #none-security').click(function() {
        //     $('.select-security-deposite-text').addClass('d-none');

        // });
        $('#under-costruction').click(function() {
            $('.select-possiession-date').removeClass('d-none');
        });

        $('#ready-to-move').click(function() {
            $('.select-possiession-date').addClass('d-none');
        });
        $('#ready-to-move-commerical').click(function() {
            $('.age-of-property-commerical').removeClass('d-none');
        });

        $('#under-construction-commerical').click(function() {
            $('.age-of-property-commerical').addClass('d-none');
            $('.commerical-available-from').removeClass('d-none');

        });

        $('#commerical-ready-to-use').click(function() {
            $('.carpet-area-commerical').removeClass('d-none');
        });

        $('#commerical-bare-shell').click(function() {
            $('.carpet-area-commerical').addClass('d-none');
        });

        $('#pg-meals-yes').click(function() {
            $('.secled-meals-yes').removeClass('d-none');
            $('.meal-charege-per-month').removeClass('d-none');
        });

        $('#pg-meals-no').click(function() {
            $('.secled-meals-yes').addClass('d-none');
            $('.meal-charege-per-month').addClass('d-none');
        });



        $('#residential, #rent-radio, #commercial, #pg-living, #sell-radio, #apartment, #independent-floor, #independent-house, #plot-resi, #plot-comm, #office, #reatail-shop, #showroom, #warehouse').on('change click', function() {


            var residentialChecked = $('#residential').is(':checked');
            var commercialChecked = $('#commercial').is(':checked');
            var payingGuestsChecked = $('#pg-living').is(':checked');
            var sellChecked = $('#sell-radio').is(':checked');
            var rentChecked = $('#rent-radio').is(':checked');

            if (residentialChecked && rentChecked) {
                $('.property-type-heading').removeClass('d-none');
                $('.residential-property').removeClass('d-none');
                $('.residential-plot').addClass('d-none');
                $('.commercial-property').addClass('d-none');
                $('.plot-section').addClass('d-none');


            }

            if (residentialChecked && sellChecked) {
                $('.residential-property').removeClass('d-none');
                $('.residential-plot').removeClass('d-none');
                $('.commercial-property').addClass('d-none');
                $('.property-type-heading').removeClass('d-none');
                $('.plot-section').removeClass('d-none');
            }

            if (commercialChecked && rentChecked) {
                $('.property-type-heading').removeClass('d-none');
                $('.residential-property').addClass('d-none');
                $('.residential-plot').addClass('d-none');
                $('.commercial-property').removeClass('d-none');
            }

            if (commercialChecked && sellChecked) {
                $('.property-type-heading').removeClass('d-none');
                $('.residential-property').addClass('d-none');
                $('.residential-plot').addClass('d-none');
                $('.commercial-property').removeClass('d-none');
            }

            if (payingGuestsChecked) {
                $('.property-type-heading').addClass('d-none');
                $('.residential-property').addClass('d-none');
            }



            // categories checked section  -----


            var apartment = $('#apartment').is(':checked');
            var independentFloor = $('#independent-floor').is(':checked');
            var independentHouse = $('#independent-house').is(':checked');
            var plotResi = $('#plot-resi').is(':checked');
            var plotComm = $('#plot-comm').is(':checked');
            var office = $('#office').is(':checked');
            var reatailShop = $('#reatail-shop').is(':checked');
            var showroom = $('#showroom').is(':checked');
            var warehouse = $('#warehouse').is(':checked');

            // residential categories --------

            if (residentialChecked && rentChecked && (apartment || independentFloor || independentHouse)) {

                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.plot-section').addClass('d-none');
                $('.residential-property-select').removeClass('d-none');
                let labelElement = document.getElementById("property-price");
                labelElement.innerText = "Monthly rent";
                $('#price').attr('placeholder', 'Monthly rent');
                $('.select-available-from').removeClass('d-none');
                // $('.select-security-deposit').removeClass('d-none');
                $('.select-security-deposite-text').removeClass('d-none');
                $('.select-possiession-date').addClass('d-none');
                $('.select-possion-status').addClass('d-none');
                $('.commercial-property-type').addClass('d-none');


            }

            if (residentialChecked && sellChecked && (apartment || independentFloor || independentHouse)) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.plot-section').addClass('d-none');
                $('.residential-property-select').removeClass('d-none');
                let labelElement = document.getElementById("property-price");
                labelElement.innerText = "Cost";
                $('#price').attr('placeholder', 'property cost');
                $('.select-available-from').addClass('d-none');
                // $('.select-security-deposit').addClass('d-none');
                $('.select-security-deposite-text').addClass('d-none');
                $('.select-possion-status-residential').removeClass('d-none');
                $('.select-possion-status').addClass('d-none');
                $('.commercial-property-type').addClass('d-none');
            }

            if (residentialChecked && sellChecked && plotResi) {
                $('.first-tab-post-property').addClass('d-none');
                $('.plot-section').removeClass('d-none');
                $('.residential-property-select').addClass('d-none');
                $('.select-possiession-date').addClass('d-none');
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.commercial-property-type').addClass('d-none');
            }


            // commerical categories ---------------

            if (commercialChecked && rentChecked && office) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('#zone-jewwllery, #zone-gym, #zone-grocery, #zone-footwear, #zone-clinic, #zone-electronics, #zone-clothing').parent().addClass('d-none');
                $('#zone-industrial, #zone-commercial, #zone-residential, #zone-spaces, #zone-agricultural').parent().removeClass('d-none');

                let labelElement = document.getElementById('about-property-zone');
                labelElement.innerText = "Zone Type";
                $('#lHub-mall, #lHub-commercial, #lHub-residential, #lHub-market').parent().addClass('d-none');
                $('#location-it, #location-business').parent().removeClass('d-none');

                $('.select-security-deposite-text').removeClass('d-none');
                $('.select-possion-status').addClass('d-none');
                $('.residential-property-section').addClass('d-none');
                $('.add-property-title').addClass('d-none');

                $('.custom-office-facilities').removeClass('d-none');
                $('.custom-lifts-staircases').removeClass('d-none');
            }

            if (commercialChecked && sellChecked && office) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('#zone-jewwllery, #zone-gym, #zone-grocery, #zone-footwear, #zone-clinic, #zone-electronics, #zone-clothing').parent().addClass('d-none');
                $('#zone-industrial, #zone-commercial, #zone-residential, #zone-spaces, #zone-agricultural').parent().removeClass('d-none');

                let labelElement = document.getElementById('about-property-zone');
                labelElement.innerText = "Zone Type";
                $('#lHub-mall, #lHub-commercial, #lHub-residential, #lHub-market').parent().addClass('d-none');
                $('#location-it, #location-business').parent().removeClass('d-none');

                $('.commerical-available-from').addClass('d-none');
                let availableElement = document.getElementById('comm-avail-from');
                availableElement.innerText = 'Possession Date';
                $('#available-from').attr('placeholder', 'Possession Date');
                $('.select-possion-status').addClass('d-none');
                $('.residential-property-section').addClass('d-none');
                $('.add-property-title').addClass('d-none');

                $('.custom-office-facilities').removeClass('d-none');
                $('.custom-lifts-staircases').removeClass('d-none');

            }

            if (commercialChecked && rentChecked && (reatailShop || showroom || warehouse)) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.residential-property-section').addClass('d-none');
                $('.add-property-title').addClass('d-none');

                $('#zone-industrial, #zone-commercial, #zone-residential, #zone-spaces, #zone-agricultural').parent().addClass('d-none');
                $('#zone-jewwllery, #zone-gym, #zone-grocery, #zone-footwear, #zone-clinic, #zone-electronics, #zone-clothing').parent().removeClass('d-none');

                $('#location-it, #location-business').parent().addClass('d-none');
                $('#lHub-mall, #lHub-commercial, #lHub-residential, #lHub-market').parent().removeClass('d-none');

                $('.property-condition').addClass('d-none');

                $('.located-near').removeClass('d-none');
                $('.carpet-area-commerical').removeClass('d-none');
                $('.entrance-width-in-feet').removeClass('d-none');
                $('.ceiling-height-in-feet').removeClass('d-none');
                let dg_ups_chargeElement = document.getElementById('dg-ups-charge');
                dg_ups_chargeElement.innerText = "Tax & Govt. charge included?";
                $('.custom-lifts-staircases').addClass('d-none');
                $('.custom-office-facilities').addClass('d-none');
                $('.select-security-deposite-text').removeClass('d-none');
                $('.select-possion-status').addClass('d-none');

            }

            if (commercialChecked && sellChecked && (reatailShop || showroom || warehouse)) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.residential-property-section').addClass('d-none');
                $('.add-property-title').addClass('d-none');

                $('#zone-industrial, #zone-commercial, #zone-residential, #zone-spaces, #zone-agricultural').parent().addClass('d-none');
                $('#zone-jewwllery, #zone-gym, #zone-grocery, #zone-footwear, #zone-clinic, #zone-electronics, #zone-clothing').parent().removeClass('d-none');

                $('#location-it, #location-business').parent().addClass('d-none');
                $('#lHub-mall, #lHub-commercial, #lHub-residential, #lHub-market').parent().removeClass('d-none');


                $('.property-condition').addClass('d-none');
                $('.located-near').removeClass('d-none');
                $('.carpet-area-commerical').removeClass('d-none');
                $('.entrance-width-in-feet').removeClass('d-none');
                $('.ceiling-height-in-feet').removeClass('d-none');
                let dg_ups_chargeElement = document.getElementById('dg-ups-charge');
                dg_ups_chargeElement.innerText = "Tax & Govt. charge included?";
                $('.electricity-charges').addClass('d-none');
                $('.water-charges').addClass('d-none');
                $('.custom-lifts-staircases').addClass('d-none');
                $('.custom-office-facilities').addClass('d-none');
                $('.select-possion-status').addClass('d-none');
            }

            if (commercialChecked && rentChecked && plotComm) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.add-property-title').addClass('d-none');
                let zonetypeElement = document.getElementById('about-property-zone');
                zonetypeElement.childNodes[0].nodeValue = 'Zone Type';
                $('#zone-jewwllery, #zone-gym, #zone-grocery, #zone-footwear, #zone-clinic, #zone-electronics, #zone-clothing').parent().addClass('d-none');
                $('.location-hub-width').addClass('d-none');
                $('.location-page-width').addClass('d-none');
                $('.built-up-area').addClass('d-none');
                $('.plot-section').removeClass('d-none');
                $('.dg-ups-charge-include').addClass('d-none');
                $('.water-charges').addClass('d-none');
                $('.floors-data').addClass('d-none');
                $('.custom-lifts-staircases').addClass('d-none');
                $('.plot-seclet').addClass('d-none');
                $('.residential-property-select').addClass('d-none');
                $('.select-security-deposite-text').removeClass('d-none');
                $('.select-possion-status').addClass('d-none');
            }

            if (commercialChecked && sellChecked && plotComm) {
                $('.second-section').removeClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.residential-property-select').addClass('d-none');
                let zonetypeElement = document.getElementById('about-property-zone');
                zonetypeElement.childNodes[0].nodeValue = 'Zone Type';
                $('#zone-jewwllery, #zone-gym, #zone-grocery, #zone-footwear, #zone-clinic, #zone-electronics, #zone-clothing').parent().addClass('d-none');
                $('.location-hub-width').addClass('d-none');
                $('.location-page-width').addClass('d-none');
                $('.built-up-area').addClass('d-none');
                $('.dg-ups-charge-include').addClass('d-none');
                $('.water-charges').addClass('d-none');
                $('.floors-data').addClass('d-none');
                $('.custom-lifts-staircases').addClass('d-none');
                $('.plot-seclet').addClass('d-none');
                $('.select-possion-status').addClass('d-none');
            }

            //  paying guest -----------------------
            if (residentialChecked && payingGuestsChecked) {
                $('.pg-living-section').removeClass('d-none');
                $('.property-type-heading').addClass('d-none');
                $('.first-tab-post-property').addClass('d-none');
                $('.thirds-section').removeClass('d-none');
                $('.select-security-deposite-text').removeClass('d-none');
                $('.select-possion-status').addClass('d-none');
                $('.electricity-charge-per-month').removeClass('d-none');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: false,
            todayHighlight: true,
            showButtonPanel: true,
            showOnFocus: false,
            clearBtn: true,
            calendarWeeks: true,
            startDate: new Date(),
            todayBtn: false
        });


        $('#plus-three-bhk').click(function() {
            $('.after-3bhk').removeClass('d-none');
            $('.three-plus-bhk').addClass('d-none');
        });

    });

    // custom-add-features

    function saveSelection() {
        $('#add-amenities').modal('hide');
        var flatFurnishings = document.querySelectorAll('input[name="furnishings[]"]:checked');
        var societyAmenities = document.querySelectorAll('input[name="society_amenities[]"]:checked');
        var flatFurnishingsList = "";
        var societyAmenitiesList = "";

        flatFurnishings.forEach(function(checkbox) {
            flatFurnishingsList += checkbox.value + ", ";
        });

        societyAmenities.forEach(function(checkbox) {
            societyAmenitiesList += checkbox.value + ", ";
        });

        flatFurnishingsList = flatFurnishingsList.slice(0, -2);
        societyAmenitiesList = societyAmenitiesList.slice(0, -2);

        document.getElementById('residential-amenities').value = flatFurnishingsList + "; " + societyAmenitiesList;

        document.querySelector('.flat-furnishings').innerHTML = "<b>Flat Furnishings Selected:</b> " + flatFurnishingsList;
        document.querySelector('.society-amenities').innerHTML = "<b>Society Amenities Selected:</b> " + societyAmenitiesList;
    }


    function saveSelectioncomm() {
        $('#add-amenities-commerical').modal('hide');
        var flatFurnishings = document.querySelectorAll('input[name="furnishingscomm[]"]:checked');
        var societyAmenities = document.querySelectorAll('input[name="society_amenitiescomm[]"]:checked');
        var flatFurnishingsList = "";
        var societyAmenitiesList = "";
        flatFurnishings.forEach(function(checkbox) {
            flatFurnishingsList += checkbox.value + ", ";
        });
        societyAmenities.forEach(function(checkbox) {
            societyAmenitiesList += checkbox.value + ", ";
        });
        flatFurnishingsList = flatFurnishingsList.slice(0, -2);
        societyAmenitiesList = societyAmenitiesList.slice(0, -2);
        document.getElementById('commercial-amenities').value = flatFurnishingsList + "; " + societyAmenitiesList;
        document.querySelector('.flat-furnishings-comm').innerHTML = "<b>Flat Furnishings Selected:</b> " + flatFurnishingsList;
        document.querySelector('.society-amenities-comm').innerHTML = "<b>Society Amenities Selected:</b> " + societyAmenitiesList;
    }


    function showSqft(input) {
        var value = input.value;
        var displayArea = input.nextElementSibling;
        if (!displayArea || !displayArea.classList.contains('sqft-display')) {
            displayArea = document.createElement('span');
            displayArea.classList.add('sqft-display');
            input.parentNode.appendChild(displayArea);
        }
        displayArea.textContent = value + ' sq.ft';
    }

    function formatRent(input) {
        var rent = input.value.replace(/\D/g, '');
        rent = parseFloat(rent);

        if (!isNaN(rent)) {
            if (rent >= 10000000) {
                rent = (rent / 10000000).toFixed(2) + " Cr";
            } else if (rent >= 100000) {
                rent = (rent / 100000).toFixed(2) + " Lac";
            } else if (rent >= 1000) {
                rent = (rent / 1000).toFixed(2) + " K";
            } else {
                rent = rent.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        } else {
            rent = "";
        }

        var formattedRentSpans = document.getElementsByClassName("formatted-rent");
        for (var i = 0; i < formattedRentSpans.length; i++) {
            formattedRentSpans[i].textContent = rent;
        }
    }

    function secuirtyForment(input) {
        var security = input.value.replace(/\D/g, '');
        security = parseFloat(security);

        if (!isNaN(security)) {
            if (security >= 10000000) {
                security = (security / 10000000).toFixed(2) + " Cr";
            } else if (security >= 100000) {
                security = (security / 100000).toFixed(2) + " Lac";
            } else if (security >= 1000) {
                security = (security / 1000).toFixed(2) + " K";
            } else {
                security = security.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        } else {
            security = "";
        }

        var formattedRentSpans = document.getElementsByClassName("secuirtyForment");
        for (var i = 0; i < formattedRentSpans.length; i++) {
            formattedRentSpans[i].textContent = security;
        }
    }


    document.getElementById('plot-area').addEventListener('input', calculateLengthAndWidth);

    function calculateLengthAndWidth() {
        const plotArea = parseFloat(document.getElementById('plot-area').value);
        const areaUnit = document.getElementById('area-unit').value;
        let conversionFactor;
        switch (areaUnit) {
            case 'sqft':
                conversionFactor = 1;
                break;
            case 'sqyd':
                conversionFactor = 9; // 1 square yard = 9 square feet
                break;
            case 'sqmt':
                conversionFactor = 10.7639; // 1 square meter = 10.7639 square feet
                break;
            default:
                conversionFactor = 1;
        }

        const length = Math.sqrt(plotArea * conversionFactor);
        const width = plotArea / length;

        document.getElementById('plot-length').value = length.toFixed(2);
        document.getElementById('plot-width').value = width.toFixed(2);
    }


    document.getElementById('photo-upload').addEventListener('change', function(e) {
        const files = e.target.files;
        const previewContainer = document.getElementById('image-preview-container');

        let rowContainer = previewContainer.lastElementChild;

        if (!rowContainer || rowContainer.children.length >= 4) {
            rowContainer = document.createElement('div');
            rowContainer.classList.add('row');
            previewContainer.appendChild(rowContainer);
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            const imageContainer = document.createElement('div');
            imageContainer.classList.add('col-lg-3', 'mb-3');

            const imgElement = document.createElement('img');
            imgElement.classList.add('img-thumbnail');
            imgElement.style.width = '100%';
            imgElement.style.height = '150px';
            imgElement.style.objectFit = 'cover';

            const fileNameElement = document.createElement('p');
            fileNameElement.textContent = file.name;

            const deleteButton = document.createElement('button');
            deleteButton.innerHTML = '<span class="fas fa-trash-can"></span>';
            deleteButton.setAttribute('aria-label', 'Delete Item');
            deleteButton.classList.add('btn', 'btn-danger', 'mt-1', 'delete-button');
            deleteButton.addEventListener('click', function() {
                imageContainer.parentNode.removeChild(imageContainer);
            });

            reader.onload = function(e) {
                imgElement.src = e.target.result;
            };
            reader.readAsDataURL(file);

            imageContainer.appendChild(imgElement);
            imageContainer.appendChild(fileNameElement);
            imageContainer.appendChild(deleteButton);

            rowContainer.appendChild(imageContainer);

            if (rowContainer.children.length >= 4) {
                rowContainer = document.createElement('div');
                rowContainer.classList.add('row');
                previewContainer.appendChild(rowContainer);
            }
        }
    });


    document.getElementById('video-upload').addEventListener('change', function() {
        var files = this.files;
        var fileNames = '';

        for (var i = 0; i < files.length; i++) {
            fileNames += files[i].name + '<br>';
        }
        document.getElementById('file-names-container').innerHTML = fileNames;

        var videoPlayer = document.getElementById('video-player');
        videoPlayer.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var video = document.createElement('video');
            video.controls = true;
            video.style.width = '100%';
            video.style.marginBottom = '10px';
            var source = document.createElement('source');
            source.src = URL.createObjectURL(files[i]);
            video.appendChild(source);
            videoPlayer.appendChild(video);
        }
    });


    const phoneInputField = document.querySelector("#mobile-number");
    const phoneNumberHiddenInput = document.querySelector("#mobile-number-hidden");
    const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "in",
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });


    phoneInputField.addEventListener("countrychange", function() {
        const selectedCountry = phoneInput.getSelectedCountryData();
    });

    phoneInputField.addEventListener("blur", function() {
        phoneNumberHiddenInput.value = phoneInput.getNumber();
    });
</script>



<script>
    //  validation section  ----------------------------------------

    $(document).ready(function() {


        function firstTabRadio(name, errorMessage) {
            if ($(`input[name="${name}"]:checked`).length === 0) {
                $(`#alert-error-${name}`).text(errorMessage);
                return errorMessage;
            } else {
                $(`#alert-error-${name}`).text('');
                return '';
            }
        }

        function firstTabText(name, errorMessage) {

            const value = $(`input[name="${name}"]`).val().trim();
            if (value === '') {
                $(`#alert-error-${name}`).text(errorMessage);
                return errorMessage;
            } else if (name === 'phone_number' && value.length < 10) {
                $(`#alert-error-${name}`).text('Phone number must be at least 10 digits.');
                return 'Phone number must be at least 10 digits.';
            } else {
                $(`#alert-error-${name}`).text('');
                return '';
            }
        }

        function firstTabCheckbox(name, errorMessage) {
            if ($(`input[name="${name}[]"]:checked`).length === 0) {
                $(`#alert-error-${name}`).text(errorMessage);
                return errorMessage;
            } else {
                $(`#alert-error-${name}`).text('');
                return '';
            }
        }



        function FirsttabValidation() {
            const errors = [];


            //  Commercial validate 

            if ($('#commercial').is(':checked')) {

                errors.push(firstTabRadio('looking_to', 'Please select the purpose'));
                errors.push(firstTabText('search_city', 'Please select the city'));
                errors.push(firstTabText('project_society', 'Please fill this to continue'));
                errors.push(firstTabText('locality', 'Please select a valid locality'));
                if (!<?php echo session()->get('id') ? 'true' : 'false'; ?>) {
                    errors.push(firstTabText('phone_number', 'Please enter a valid phone number'));
                }

                if ($('#rent-radio').is(':checked') || $('#sell-radio').is(':checked')) {

                    errors.push(firstTabRadio('category_type', 'Please select the property type'));
                }

                //  office ----------

                if (($('#rent-radio').is(':checked') || $('#sell-radio').is(':checked')) && $('#office').is(':checked')) {

                    errors.push(firstTabRadio('zone_type', 'Please select a zone type to continue.'));
                    errors.push(firstTabRadio('location_hub', 'Please select location hub'));
                    errors.push(firstTabRadio('property_status', 'Please select posession status'));
                    errors.push(firstTabRadio('property_condition', 'Please choose the type of property condition'));
                    errors.push(firstTabText('comm_built_up', 'Saleable area should be between 150 and 1500'));
                    errors.push(firstTabRadio('ownership', 'Please select ownership'));
                    errors.push(firstTabText('total_floors', 'Please enter the total number of floors.'));
                    errors.push(firstTabText('your_floor', 'Please enter your floor number.'));
                    errors.push(firstTabText('staircase', 'Please indicate if there is a staircase available.'));
                    errors.push(firstTabText('passenger_lift', 'Please indicate if there is a passenger lift available.'));
                    errors.push(firstTabText('service_lift', 'Please indicate if there is a service lift available.'));
                    errors.push(firstTabText('conference_room', 'Please indicate if there is a conference room available.'));
                    errors.push(firstTabText('min_seat', 'Please enter the minimum number of seats.'));
                    errors.push(firstTabText('max_seat', 'Please enter the maximum number of seats.'));
                    errors.push(firstTabText('number_of_cabins', 'Please enter the number of cabins.'));
                    errors.push(firstTabText('meeting_rooms', 'Please enter the number of meeting rooms.'));
                    errors.push(firstTabText('private_parking', 'Please indicate if private parking is available.'));
                    errors.push(firstTabText('public_parking', 'Please indicate if public parking is available.'));
                    errors.push(firstTabText('private_washrooms', 'Please indicate if private washrooms are available.'));
                    errors.push(firstTabText('public_washrooms', 'Please indicate if public washrooms are available.'));
                    errors.push(firstTabText('price', 'Please enter the price'));

                }

                if ($('#rent-radio').is(':checked') && $('#office').is(':checked')) {
                    errors.push(firstTabText('available_from', 'Please enter valid date'));
                    errors.push(firstTabText('security_deposit', 'Please enter the security deposit'));
                }

                //  Plot ----

                if ($('#rent-radio').is(':checked') && $('#plot-comm').is(':checked')) {

                    errors.push(firstTabText('security_deposit', 'Please enter the security deposit'));
                }

                if (($('#rent-radio').is(':checked') || $('#sell-radio').is(':checked')) && $('#plot-comm').is(':checked')) {
                    errors.push(firstTabText('plot_area', 'Saleable area should be between 150 and 230000'));
                    errors.push(firstTabText('plot_length', 'Length should be between 1 and 10000'));
                    errors.push(firstTabText('plot_width', 'Width should be between 1 and 10000'));
                    errors.push(firstTabRadio('zone_type', 'Please select a zone type to continue.'));
                    errors.push(firstTabText('available_from', 'Please enter valid date'));
                    errors.push(firstTabRadio('ownership', 'Please select ownership'));
                    errors.push(firstTabText('price', 'Please enter the price'));

                }


                if ($('#rent-radio').is(':checked') && ($('#reatail-shop').is(':checked') || $('#showroom').is(':checked') || $('#warehouse').is(':checked'))) {
                    errors.push(firstTabText('security_deposit', 'Please enter the security deposit'));
                }

                if (($('#rent-radio').is(':checked') || $('#sell-radio').is(':checked')) && ($('#reatail-shop').is(':checked') || $('#showroom').is(':checked') || $('#warehouse').is(':checked'))) {

                    errors.push(firstTabRadio('zone_type', 'Please select a zone type to continue.'));
                    errors.push(firstTabRadio('location_hub', 'Please select location hub'));
                    errors.push(firstTabRadio('property_status', 'Please select posession status'));
                    errors.push(firstTabCheckbox('located_near', 'Please select an option for the location proximity.'));
                    errors.push(firstTabText('comm_built_up', 'Saleable area should be between 150 and 1500'));
                    errors.push(firstTabText('available_from', 'Please enter valid date'));
                    errors.push(firstTabText('carpet_area', 'Please enter the carpet area'));
                    errors.push(firstTabText('comm_area_width', 'Width should be between 1 and 10000'));
                    errors.push(firstTabText('comm_area_height', 'Length should be between 1 and 10000'));
                    errors.push(firstTabRadio('ownership', 'Please select ownership'));
                    errors.push(firstTabText('total_floors', 'Please enter the total number of floors.'));
                    errors.push(firstTabText('your_floor', 'Please enter your floor number.'));
                    errors.push(firstTabText('private_parking', 'Please indicate if private parking is available.'));
                    errors.push(firstTabText('public_parking', 'Please indicate if public parking is available.'));
                    errors.push(firstTabText('private_washrooms', 'Please indicate if private washrooms are available.'));
                    errors.push(firstTabText('public_washrooms', 'Please indicate if public washrooms are available.'));
                    errors.push(firstTabText('price', 'Please enter the price'));
                }
            }

            //  Residential validate

            if ($('#residential').is(':checked')) {

                errors.push(firstTabRadio('looking_to', 'Please select the purpose'));
                errors.push(firstTabText('search_city', 'Please select the city'));
                errors.push(firstTabText('project_society', 'Please fill this to continue'));
                errors.push(firstTabText('locality', 'Please select a valid locality'));

                if (!<?php echo session()->get('id') ? 'true' : 'false'; ?>) {

                    errors.push(firstTabText('phone_number', 'Please enter a valid phone number'));
                }

                if ($('#rent-radio').is(':checked') || $('#sell-radio').is(':checked')) {

                    errors.push(firstTabRadio('category_type', 'Please select the property type'));
                }

                if (($('#rent-radio').is(':checked') || $('#sell-radio').is(':checked')) && ($('#apartment').is(':checked') || $('#independent-floor').is(':checked') || $('#independent-house').is(':checked'))) {

                    errors.push(firstTabRadio('total_property', 'Please select the BHK'));
                    errors.push(firstTabText('built_up_area', 'Saleable area should be between 150 and 1500'));
                    errors.push(firstTabText('bath', 'Please specify the number of bathrooms'));
                    errors.push(firstTabText('balconies', 'Please specify the number of balconies'));
                    errors.push(firstTabRadio('age_of_property', 'Please select the age of the property'));
                    errors.push(firstTabRadio('furnishing', 'Please select the furnish type'));

                }
                if ($('#rent-radio').is(':checked') && ($('#apartment').is(':checked') || $('#independent-floor').is(':checked') || $('#independent-house').is(':checked'))) {
                    errors.push(firstTabText('price', 'Price should be between 1500 and 20 Lakhs'));
                    errors.push(firstTabText('available_date', 'Please enter valid date'));
                    errors.push(firstTabText('security_deposit', 'Please enter the security deposit'));
                }

                if ($('#sell-radio').is(':checked') && ($('#apartment').is(':checked') || $('#independent-floor').is(':checked') || $('#independent-house').is(':checked'))) {
                    errors.push(firstTabText('price', 'Price should be between 1 Lakh and 200 Crore'));
                    errors.push(firstTabRadio('posession_status_resi', 'Please select a valid possession status'));

                    if ($('#under-costruction').is(':checked')) {
                        errors.push(firstTabText('possession_date', 'Please enter valid date'))
                    }
                }

                if ($('#sell-radio').is(':checked') && $('#plot-resi').is(':checked')) {
                    errors.push(firstTabText('plot_area', 'Saleable area should be between 150 and 230000'));
                    errors.push(firstTabText('plot_length', 'Length should be between 1 and 10000'));
                    errors.push(firstTabText('plot_width', 'Width should be between 1 and 10000'));
                    errors.push(firstTabText('price', 'Price should be between 1 Lakh and 200 Crore'));
                    errors.push(firstTabRadio('posession_status_comm', 'Please select a valid possession status'));

                    if ($('#in-future').is(':checked')) {
                        errors.push(firstTabText('possession_date', 'Please enter valid date'))
                    }
                }


                if ($('#pg-living').is(':checked')) {

                    errors.push(firstTabText('pg_name', 'Please enter the PG name.'));
                    errors.push(firstTabText('total_beds', 'Please enter the total number of beds.'));
                    errors.push(firstTabRadio('pg_for', 'Please select who the PG is for.'));
                    errors.push(firstTabRadio('suited_for', 'Please select who the PG is suited for.'));
                    errors.push(firstTabRadio('meals', 'Please select if meals are provided.'));


                    if ($('#pg-meals-yes').is(':checked')) {
                        errors.push(firstTabCheckbox('meal_offerings', 'Please select the meal offerings.'));
                        errors.push(firstTabCheckbox('meal_speciality', 'Please select the meal speciality.'));
                        errors.push(firstTabText('meal_charges_month', 'Please enter the monthly meal charges.'));

                    }

                    errors.push(firstTabText('notice_period', 'Please enter the notice period.'));
                    errors.push(firstTabText('lock_period', 'Please enter the lock period.'));
                    errors.push(firstTabCheckbox('common_areas', 'Please select if common areas are available.'));
                    errors.push(firstTabRadio('property_manage', 'Please select if the property is managed.'));
                    errors.push(firstTabRadio('stays_property', ''));
                    errors.push(firstTabRadio('non_veg', ''));
                    errors.push(firstTabRadio('pg_sex', ''));
                    errors.push(firstTabRadio('pg_time_allowed', ''));
                    errors.push(firstTabRadio('visitors_allowed', ''));
                    errors.push(firstTabRadio('guardian_allowed', ''));
                    errors.push(firstTabRadio('drin_smok_allowed', ''));
                    errors.push(firstTabRadio('room_type', 'Please select the room type.'));
                    errors.push(firstTabText('total_beds_this_room', 'Please enter the total number of beds for this room.'));
                    errors.push(firstTabCheckbox('bath_style', 'Please select the bath style.'));
                    errors.push(firstTabText('price', 'Please enter the price'));
                    errors.push(firstTabText('security_deposit', 'Please enter the security deposit'));
                    errors.push(firstTabText('electricity_charges_month', 'Please enter the monthly electricity charges.'));




                }


            }



            const filteredErrors = errors.filter(error => error !== '');

            if (filteredErrors.length > 0) {
                return filteredErrors.join('\n');
            }
            return '';
        }


        function handelInputerror(fileId, errorID) {
            $(fileId).on('input', function() {
                var value = $(this).val().trim();
                if (value !== '') {
                    $(errorID).text('');
                }
            })
        }



        function handleRadioError(groupId, errorID) {
            $('input[name="' + groupId + '"]').on('change', function() {
                if ($('input[name="' + groupId + '"]:checked').length > 0) {
                    $(errorID).text('');
                }
            });
        }

        function handleCheckboxError(groupName, errorID) {
            $('input[name="' + groupName + '[]"]').on('change', function() {
                if ($('input[name="' + groupName + '[]"]:checked').length > 0) {
                    $(errorID).text('');
                }
            });
        }

        handleRadioError('looking_to', '#alert-error-looking_to');
        handleRadioError('category_type', '#alert-error-category_type');
        handelInputerror('#mobile-number', '#alert-error-phone_number');
        handelInputerror('#search-city', '#alert-error-search_city');
        handelInputerror('#building-project', '#alert-error-project_society');
        handelInputerror('#Locality', '#alert-error-locality');
        handleRadioError('total_property', '#alert-error-total_property');
        handelInputerror('#built-up-area', '#alert-error-built_up_area');
        handelInputerror('#bath', '#alert-error-bath');
        handelInputerror('#balconies', '#alert-error-balconies');
        handleRadioError('age_of_property', '#alert-error-age_of_property');
        handleRadioError('furnishing', '#alert-error-furnishing');
        handelInputerror('#price', '#alert-error-price');
        handelInputerror('#available-date', '#alert-error-available_date');
        handelInputerror('#security-deposite', '#alert-error-security_deposit');
        handleRadioError('posession_status_resi', '#alert-error-posession_status_resi');
        handelInputerror('#plot-area', '#alert-error-plot_area');
        handelInputerror('#plot-length', '#alert-error-plot_length');
        handleRadioError('posession_status_comm', '#alert-error-posession_status_comm');
        handelInputerror('#plot-width', '#alert-error-plot_width');
        handleRadioError('zone_type', '#alert-error-zone_type');
        handleRadioError('location_hub', '#alert-error-location_hub');
        handleRadioError('property_status', '#alert-error-property_status');
        handleRadioError('property_condition', '#alert-error-property_condition');
        handelInputerror('#comm-built-up', '#alert-error-comm_built_up');
        handelInputerror('#available-from', '#alert-error-available_from');
        handleRadioError('ownership', '#alert-error-ownership');
        handelInputerror('#total-floors', '#alert-error-total_floors');
        handelInputerror('#your-floor', '#alert-error-your_floor');
        handelInputerror('#staircase', '#alert-error-staircase');
        handelInputerror('#passenger-lift', '#alert-error-passenger_lift');
        handelInputerror('#service-lift', '#alert-error-service_lift');
        handelInputerror('#conference-room', '#alert-error-conference_room');
        handelInputerror('#min-seat', '#alert-error-min_seat');
        handelInputerror('#max-seat', '#alert-error-max_seat');
        handelInputerror('#cabins', '#alert-error-number_of_cabins');
        handelInputerror('#meeting-room', '#alert-error-meeting_rooms');
        handelInputerror('#private-parking', '#alert-error-private_parking');
        handelInputerror('#public-parking', '#alert-error-public_parking');
        handelInputerror('#private-washroom', '#alert-error-private_washrooms');
        handelInputerror('#public-washroom', '#alert-error-public_washrooms');
        handelInputerror('#carpet-area', '#alert-error-carpet_area');
        handelInputerror('#com-area-width', '#alert-error-comm_area_width');
        handelInputerror('#comm-area-height', '#alert-error-comm_area_height');
        handelInputerror('#pg-name', '#alert-error-pg_name');
        handelInputerror('#total-beds', '#alert-error-total_beds');
        handleRadioError('pg_for', '#alert-error-pg_for');
        handleRadioError('suited_for', '#alert-error-suited_for');
        handleRadioError('meals', '#alert-error-meals');
        handleCheckboxError('meal_offerings', '#alert-error-meal_offerings');
        handleCheckboxError('meal_speciality', '#alert-error-meal_speciality');
        handleCheckboxError('bath_style', '#alert-error-bath_style');
        handleCheckboxError('common_areas', '#alert-error-common_areas');
        handelInputerror('#notice-period', '#alert-error-notice_period');
        handelInputerror('#lock-period', '#alert-error-lock_period');
        handleRadioError('property_manage', '#alert-error-property_manage');
        handleRadioError('room_type', '#alert-error-room_type');
        handelInputerror('#pg-total-bad', '#alert-error-total_beds_this_room');
        handelInputerror('#meal-charge', '#alert-error-meal_charges_month');
        handelInputerror('#electricity-charge', '#alert-error-electricity_charges_month');
        handleCheckboxError('located_near', '#alert-error-located_near');


        $('#continue-btn').click(function() {

            const errorMessage = FirsttabValidation();
            var phone = $('#mobile-number').val();
            var updateNumber = $('#mobile-number-hidden').val();
            var hasSessionId = <?php echo session()->get('id') ? 'true' : 'false' ?>;


            if (errorMessage !== '') {

                $('#errorModal').modal('show');


                setTimeout(function() {
                    $('#errorModal').modal('hide');

                    const windowHeight = window.innerHeight;
                    const modalHeight = $('#errorModal .modal-dialog').outerHeight();
                    const scrollToPosition = Math.max(0, (windowHeight - modalHeight) / 2);

                    window.scrollTo({
                        top: scrollToPosition,
                        behavior: 'smooth'
                    });
                }, 1000);

            } else {
                

                if (phone && updateNumber && !hasSessionId) {

                    $.ajax({
                        url: "{{route('create.vendor')}}",
                        type: "POST",
                        data: {
                            number: updateNumber,
                            "_token": "{{ csrf_token()}}"
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                $('#otp-message').text(response.success);
                                $('#otpModal').modal('show');
                            } else {
                                $('#errorModal').modal('show');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error:", error);
                        }
                    });
                }else{
                    $('#property-form').submit();
                }
               
            }
        });

        $('#verify-otp-btn').click(function() {
            var otp = $('#otp-input').val();

            $.ajax({
                url: "{{ route('verify.otp') }}",
                type: "POST",
                data: {
                    otp: otp,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('#property-form').submit();
                        //  alert('success');
                    } else {
                        $('#error-message').text(response.message);
                        $('#otpModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>






@endsection