@extends('layouts.inner_page')
@section('content')
<link rel="stylesheet" href="{{asset('public/assets/newCss/style.css')}}">


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
                        @php $propertyName = substr($property->property_name, 0, strrpos($property->property_name, ' ')); @endphp

                        <h2>{{$propertyName}}</h2>
                    </div>
                </div>
            </div>
            <div class="first-section mt20">
                <form action="" method="post" id="property-form" enctype="multipart/form-data">
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
                                                                    <input class="form-check-input" type="radio" id="residential" name="property_type" value="residential" {{$property->property_type == 'residential' ? 'checked' : 'disabled'}}>
                                                                    <label class="form-check-label fw600" for="residential">Residential</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="commercial" name="property_type" value="commercial" {{$property->property_type == 'commercial' ? 'checked' : 'disabled'}}>
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
                                                                <input class="form-check-input" type="radio" name="looking_to" value="rent" id="rent-radio" {{$property->looking_to == 'rent' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="rent-radio">Rent</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="looking_to" value="sell" id="sell-radio" {{$property->looking_to == 'sell' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="sell-radio">Sell</label>
                                                            </div>
                                                            <div class="form-check form-check-inline pg-section">
                                                                <input class="form-check-input" type="radio" name="looking_to" value="pg" id="pg-living" {{$property->looking_to == 'pg' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="pg-living">PG/Co-living</label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-sm-4 col-xl-3 mb25 custom-display-inline">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb20">Search City<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-search_city" class="post-property"></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="search_city" id="search-city" placeholder="Search City" value="{{$property->city}}">
                                                    </div>
                                                    <div class="col-sm-6 col-xl-6 mb25 building-width">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Building/Project/Society <span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-project_society" class="post-property"></span>

                                                        </div>
                                                        <input type="text" class="form-control" name="project_society" id="building-project" placeholder="Building/Project/Society" value="{{$property->project_society}}">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25 building-width">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Locality <span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-locality" class="post-property"></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="locality" id="Locality" placeholder="Locality" value="{{$property->locality}}">
                                                    </div>

                                                    <div class="col-sm-12 col-xl-12 mb25 building-width" id="input-proprty-name">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Property Name <span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alerterrorlocality" class="post-property"></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="property_name" id="property-name" placeholder="Enter Property name" value="{{$property->property_name}}">
                                                    </div>


                                                </div>

                                                <!---------------- paying-guest-------------------- -->
                                                <div class="pg-living-section {{$property->looking_to == 'pg' ? '' : 'd-none'}}">
                                                    <div class="row">
                                                        <div class="fw600 mb10 custom-basic-title">PG DETAILS</div>
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Total Beds<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-total_beds" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" name="total_beds" id="total-beds" placeholder="Total Beds" value="{{$property->total_property}}">
                                                        </div>

                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">PG is for<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-pg_for" class="post-property"></span>

                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="pg_for" value="girls" id="pg-girls" {{$property->pg_for == 'girls' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-girls">Girls</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="pg_for" value="boys" id="pg-boys" {{$property->pg_for == 'boys' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-boys">Boys</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Best suited for<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-suited_for" class="post-property"></span>
                                                            </div>

                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="suited_for" value="students" id="suited-students" {{$property->suited_for == 'students' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="suited-students">Students</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="suited_for" value="professionals" id="suited-professionals" {{$property->suited_for == 'professionals' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="suited-professionals">Professionals</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-xl-4 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Meals Available <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-meals" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="meals" value="yes" id="pg-meals-yes" {{$property->meal == 'yes' ? 'checked' : ''}}>
                                                                <label for="pg-meals-yes" class="form-check-label fw600">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="meals" value="no" id="pg-meals-no" {{$property->meal == 'no' ? 'checked' : ''}}>
                                                                <label for="pg-meals-no" class="form-check-label fw600">No</label>
                                                            </div>
                                                        </div>
                                                        @php $mealOfferings = explode(',', $property->meal_offering); @endphp
                                                        <div class="col-sm-6 col-xl-6 mb25 secled-meals-yes ">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Meal Offerings<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-meal_offerings" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="checkbox" name="meal_offerings[]" value="breakfast" id="breakfast" {{ in_array('breakfast', $mealOfferings) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="breakfast">Breakfast</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_offerings[]" value="lunch" id="lunch" {{ in_array('lunch', $mealOfferings) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="lunch">Lunch</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_offerings[]" value="dinner" id="dinner" {{ in_array('dinner', $mealOfferings) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="dinner">Dinner</label>
                                                            </div>
                                                        </div>

                                                        @php $mealSpeciality = explode(',', $property->meal_speciality); @endphp

                                                        <div class="col-sm-6 col-xl-6 mb25 secled-meals-yes ">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Meal Speciality (Optional)<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-meal_speciality" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="punjabi" id="punjabi" {{in_array('punjabi', $mealSpeciality) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="punjabi">Punjabi</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="south indian" id="south-indian" {{in_array('south indian', $mealSpeciality) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="south-indian">South Indian</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="andhra" id="andhra" {{in_array('andhra', $mealSpeciality) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="andhra">Andhra</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="north indian" id="north-indian" {{in_array('north indian', $mealSpeciality) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="north-indian">North Indian</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="meal_speciality[]" value="others" id="meal-others" {{in_array('others', $mealSpeciality) ? 'checked' : ''}}>
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
                                                            <input type="number" class="form-control" name="notice_period" id="notice-period" placeholder="Notice Period (Days)" oninput="displayDuration('notice-period', 'notice-period-display')" value="{{$property->notice_period}}">
                                                            <span id="notice-period-display"></span>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Lock in Period (Days) <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-lock_period" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" name="lock_period" id="lock-period" placeholder="Lock in Period (Days)" oninput="displayDuration('lock-period', 'lock-period-display')" value="{{$property->lock_in_period}}">
                                                            <span id="lock-period-display"></span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="ff-heading fw600 mb10">Common Areas <span class="mandatoryMarker">*</span></div><br>
                                                        <span id="alert-error-common_areas" class="post-property"></span>
                                                        @php $commonAreas = explode(',', $property->amenities); @endphp

                                                        <div class="col-sm-6 col-xl-12 mb25">

                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="living-room" value="living room" {{in_array('living room', $commonAreas) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="living-room">Living Room</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="kitchen" value="kitchen" {{in_array('kitchen', $commonAreas) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="kitchen">Kitchen</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="dining-hall" value="dining hall" {{in_array('dining hall', $commonAreas) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="dining-hall">Dining Hall</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="study-library" value="study room library" {{in_array('study room library', $commonAreas) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="study-library">Study Room / Library</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="common_areas[]" id="breakout-room" value="breakout room" {{in_array('breakout room', $commonAreas) ? 'checked' : ''}}>
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
                                                                <input class="form-check-input" type="radio" name="property_manage" value="landlord" id="landlord" {{$property->ownership == 'landlord' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="landlord">Landlord</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_manage" value="caretaker" id="caretaker" {{$property->ownership == 'caretaker' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw600" for="caretaker">Caretaker</label>
                                                            </div>

                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="property_manage" value="dedicated professional" id="dedicated-professional" {{$property->ownership == 'dedicated professional' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw600" for="dedicated-professional">Dedicated Professional</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Property Manager stays at Property <span class="mandatoryMarker">*</span></label><br>

                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="stays_property" value="yes" id="property-manger-yes" {{$property->manager_stay == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="property-manger-yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline ">
                                                                <input class="form-check-input" type="radio" name="stays_property" value="no" id="property-manger-no" {{$property->manager_stay == 'no' ? 'checked' : ''}}>
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
                                                                <input class="form-check-input" type="radio" name="non_veg" value="yes" id="pg-non-vegYes" {{$property->non_veg == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-non-vegYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="non_veg" value="no" id="pg-non-vegno" {{$property->non_veg == 'no' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-non-vegno">No</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Opposite Sex Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="pg_sex" value="yes" id="pg-sexYes" {{$property->opposite_sex == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-sexYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="pg_sex" value="no" id="pg-sexNo" {{$property->opposite_sex == 'no' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-sexNo">No</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Any Time Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="pg_time_allowed" value="yes" id="any-timeYes" {{$property->any_time == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="any-timeYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="pg_time_allowed" value="no" id="any-timeNo" {{$property->any_time == 'no' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="any-timeNo">No</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Visitors Allowed <span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="visitors_allowed" value="yes" id="visitors-Yes" {{$property->visitors == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="visitors-Yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="visitors_allowed" value="no" id="visitors-No" {{$property->visitors == 'no' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="visitors-No">No</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4 col-xl-2 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Guardian Allowed<span class="mandatoryMarker">*</span></label><br>
                                                            </div>


                                                            <div class="form-check form-check-inline margin-left-techo">
                                                                <input class="form-check-input" type="radio" name="guardian_allowed" value="yes" id="guardian-yes" {{$property->guardian == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="guardian-yes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="guardian_allowed" value="no" id="guardian-no" {{$property->guardian == 'no' ? 'checked' : ''}}>
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
                                                                <input class="form-check-input" type="radio" name="drin_smok_allowed" value="yes" id="pg-smokingYes" {{$property->drink_smok == 'yes' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="pg-smokingYes">Yes</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="drin_smok_allowed" value="no" id="pg-smokingNo" {{$property->drink_smok == 'no' ? 'checked' : ''}}>
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
                                                                <input class="form-check-input" type="radio" name="room_type" value="private room" id="private-room" {{$property->room_type == 'private room' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="private-room">Private Room</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="double sharing" id="double_sharing" {{$property->room_type == 'double sharing' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="double_sharing">Double Sharing</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="triple sharing" id="triple_sharing" {{$property->room_type == 'triple sharing' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="triple_sharing">Triple Sharing</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="room_type" value="three plus sharing" id="three-plus-sharing" {{$property->room_type == 'three plus sharing' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="three-plus-sharing">3+ Sharing</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 ">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Total Beds in this Room (Optional)</label><br>
                                                                <span id="alert-error-total_beds_this_room" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Total Beds in this Room" id="pg-total-bad" name="total_beds_this_room" value="{{$property->bed_in_room}}">
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Bathroom Style</label><br>
                                                                <span id="alert-error-bath_style" class="post-property"></span>

                                                            </div>
                                                            @php $bathStyle = explode(',', $property->bathroom_style); @endphp
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="bathStyle-Western" name="bath_style[]" value="western" {{in_array('western', $bathStyle) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="bathStyle-Western">Western</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="bathStyle-Indian" name="bath_style[]" value="indian" {{in_array('indian', $bathStyle) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="bathStyle-Indian">Indian</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="ff-heading fw600 mb10 property-type-heading  first-tab-post-property {{$property->looking_to == 'pg' ? 'd-none' : ''}}">Property Type <span class="mandatoryMarker">*</span></div>
                                                <span id="alert-error-category_type" class="post-property"></span>
                                                <div class="col-6 col-sm-6 mb25 first-tab-post-property {{$property->looking_to == 'pg' ? 'd-none' : ''}}">
                                                    @php $commercialType = ['office', 'retail shop', 'showroom', 'warehouse']; @endphp

                                                    <div class="residential-property {{ in_array($property->categories, $commercialType) ? 'd-none' : '' }}">

                                                        <div class="form-check form-check-inline margin-left-techo">
                                                            <input class="form-check-input" type="radio" name="category_type" value="apartment" id="apartment" {{$property->categories == 'apartment' ? 'checked' : 'disabled'}}>
                                                            <label class="form-check-label fw600" for="apartment" id="apartment-width">

                                                                <span>Apartment</span>
                                                            </label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="category_type" value="independent floor" id="independent-floor" {{$property->categories == 'independent floor' ? 'checked' : 'disabled'}}>
                                                            <label class="form-check-label fw600" for="independent-floor">

                                                                <span>Independent Floor</span>
                                                            </label>
                                                        </div>


                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="category_type" value="independent house" id="independent-house" {{$property->categories == 'independent house' ? 'checked' : 'disabled'}}>
                                                            <label class="form-check-label fw600" for="independent-house">

                                                                <span>Independent House</span>
                                                            </label>
                                                        </div>


                                                    </div>
                                                    <div class="form-check-inline selected-residential-sell-categories residential-plot">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="category_type" value="plot" id="plot-resi" {{$property->categories == 'plot' ? 'checked' : 'disabled'}}>
                                                            <label class="form-check-label fw600" for="plot-resi">
                                                                <span>Plot</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @php $residentialType = ['apartment', 'independent house', 'independent floor']; @endphp
                                                    <div class="commercial-property {{ in_array($property->categories, $residentialType) ? 'd-none' : '' }}">

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="office" id="office" {{$property->categories == 'office' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="office">
                                                                    <span>Office</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="retail shop" id="reatail-shop" {{$property->categories == 'retail shop' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="reatail-shop">
                                                                    <span>Retail Shop</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="showroom" id="showroom" {{$property->categories == 'showroom' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="showroom">
                                                                    <span>Showroom</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="form-check-inline selected-residential-sell-categories">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="category_type" value="warehouse" id="warehouse" {{$property->categories == 'warehouse' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="warehouse">
                                                                    <span>Warehouse</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="second-section mt20 {{$property->looking_to == 'pg' ? 'd-none' : ''}}">

                                            <div class="ff-heading fw600 mb10 custom-basic-title add-property-title {{in_array($property->categories, $commercialType) ? 'd-none' : ''}}">Add Property Details</div>
                                            <!--------------------------------- residential-property-type ------------------------>
                                            <div class="row residential-property-section">
                                                <div class="row plot-section {{$property->categories == 'plot' ? '' : 'd-none'}}">
                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Plot Area<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-plot_area" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Plot Area" name="plot_area" id="plot-area" value="{{$property->plot_area}}">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb15">
                                                        <div class="mb20">
                                                            <label for="phone" class="ff-heading fw600 mb10">Area Unit</label><br>
                                                            <div class="location-area">
                                                                <select class="selectpicker" id="area-unit" name="area_unit">
                                                                    <option value="sqft" {{$property->area_unit == 'sqft' ? 'selected' : ''}}>sq. ft.</option>
                                                                    <option value="sqyd" {{$property->area_unit == 'sqyd' ? 'selected' : ''}}>sq. yd.</option>
                                                                    <option value="sqmt" {{$property->area_unit == 'sqmt' ? 'selected' : ''}}>sq. mt.</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Length</label><br>
                                                            <span id="alert-error-plot_length" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Length" name="plot_length" id="plot-length" value="{{$property->height}}">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Width</label><br>
                                                            <span id="alert-error-plot_width" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Width" name="plot_width" id="plot-width" value="{{$property->width}}">
                                                    </div>
                                                </div>

                                                @php $commercialType = ['office', 'retail shop', 'showroom', 'warehouse']; @endphp
                                                <div class="residential-property-type {{($property->categories == 'plot') || ( in_array($property->categories, $commercialType) ) ? 'd-none' : ''}}">
                                                    <div class="row residential-property-select">
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">BHK <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-total_property" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" value="1 RK" id="one-rk" {{$property->total_property == '1 RK' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="one-rk">1 RK</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" value="1" id="one-bhk" {{$property->total_property == '1' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="one-bhk">1 BHK</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" value="2" id="two-bhk" {{$property->total_property == '2' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="two-bhk">2 BHK</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="total_property" id="three-bhk" value="3" {{$property->total_property == '3' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="three-bhk">3 BHK</label>
                                                            </div>

                                                            <div class="form-check form-check-inline three-plus-bhk">
                                                                <input class="form-check-input" type="radio" name="total_property" id="plus-three-bhk">
                                                                <label class="form-check-label fw600" for="plus-three-bhk">3+ BHK</label>
                                                            </div>

                                                            <div class="after-3bhk d-none">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="4" id="four-bhk" {{$property->total_property == '4' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="four-bhk">4 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="5" id="five-bhk" {{$property->total_property == '5' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="five-bhk">5 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="6" id="six-bhk" {{$property->total_property == '6' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="six-bhk">6 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="7" id="seven-bhk" {{$property->total_property == '7' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="seven-bhk">7 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="8" id="eight-bhk" {{$property->total_property == '8' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="eight-bhk">8 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="9" id="nine-bhk" {{$property->total_property == '9' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="nine-bhk">9 BHK</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="total_property" value="10" id="ten-bhk" {{$property->total_property == '10' ? 'checked' : ''}}>
                                                                    <label class="form-check-label fw600" for="ten-bhk">10 BHK</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 built-up-area-width">
                                                            <div class="location-area">
                                                                <label for="built-up-area" class="ff-heading fw600 mb10 ">Built Up Area <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-built_up_area" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" name="built_up_area" id="built-up-area" placeholder="Built Up Area" oninput="showSqft(this)" value="{{$property->built_up_area}}">
                                                        </div>

                                                        <div class="col-sm-4 col-xl-3 mb25 custom-display-inline bathroom-section-width">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb20">Number of Bathooms<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-bath" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="bath" id="bath" placeholder="Number of Bathooms" value="{{$property->bath}}">
                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25  bathroom-section-width">
                                                            <div class="location-area">
                                                                <label for="number" class="ff-heading fw600 mb10">Number of Balconies <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-balconies" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" name="balconies" id="balconies" placeholder="Number of Balconies" value="{{$property->balconies}}">
                                                        </div>

                                                        <div class="col-sm-4 col-xl-4 mb25  bathroom-section-width ">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Age of property<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-age_of_property" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="0-1" id="age-of-property0-1" {{$property->property_age == '0-1' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="age-of-property0-1">0-1 years</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="1-5" id="age-of-property1-5" {{$property->property_age == '1-5' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="age-of-property1-5">1-5 years</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="5-10" id="age-of-property5-10" {{$property->property_age == '5-10' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="age-of-property5-10">5-10 years</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="age_of_property" value="10" id="age-of-property10plus" {{$property->property_age == '10' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="age-of-property10plus">10+ years</label>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="residential-property-type residential-property-select {{($property->categories == 'plot') || (in_array($property->categories, $commercialType))  ? 'd-none' : ''}}">
                                                    <div class="row ">
                                                        <div class="col-sm-6 col-xl-6 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Furnish Type<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-furnishing" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="furnishing" value="fully furnished" id="fully-furnished" {{$property->furnish_type == 'fully furnished' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="fully-furnished">Fully Furnished</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="furnishing" value="semi furnished" id="semi-furnished" {{$property->furnish_type == 'semi furnished' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="semi-furnished">Semi Furnished</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="furnishing" value="unfurnished" id="unfurnished" {{$property->furnish_type == 'unfurnished' ? 'checked' : ''}}>
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
                                                        @php
                                                        $amenities = explode(',', $property->amenities);
                                                        @endphp

                                                        @foreach($amenities as $item)
                                                        {{ $item }}
                                                        @endforeach
                                                    </div>

                                                </div>


                                            </div>
                                            @php $residentialType = ['apartment', 'independent house', 'independent floor']; @endphp

                                            <div class="commercial-property-type {{ (in_array($property->categories, $residentialType)) || ($property->property_type == 'residential' && $property->categories == 'plot') ? 'd-none' : '' }}">

                                                <div class="secleted-office">
                                                    <div class="row">
                                                        <div class="custom-basic-title ff-heading fw600 mb10"> ABOUT THE PROPERTY</div>

                                                        <div class="col-sm-6 col-xl-6 mb25 zone-width">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10" id="about-property-zone">Suitable For<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-zone_type" class="post-property"></span>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="industrial" id="zone-industrial" {{$property->zone_type == 'industrial' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-industrial">Industrial</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="commercial" id="zone-commercial" {{$property->zone_type == 'commercial' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-commercial">Commercial</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="residential" id="zone-residential" {{$property->zone_type == 'residential' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-residential">Residential</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="open spaces" id="zone-spaces" {{$property->zone_type == 'open spaces' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-spaces">Open Spaces</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="agricultural zone" id="zone-agricultural" {{$property->zone_type == 'agricultural zone' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-agricultural">Agricultural zone</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="jewelry" id="zone-jewelry" {{$property->zone_type == 'jewelry' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-jewelry">Jewelry</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="gym" id="zone-gym" {{$property->zone_type == 'gym' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-gym">Gym</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="grocery" id="zone-grocery" {{$property->zone_type == 'grocery' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-grocery">Grocery</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="footwear" id="zone-footwear" {{$property->zone_type == 'footwear' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-footwear">Footwear</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="clinic" id="zone-clinic" {{$property->zone_type == 'clinic' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-clinic">Clinic</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="electronics" id="zone-electronics" {{$property->zone_type == 'electronics' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-electronics">Electronics</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="zone_type" value="clothing" id="zone-clothing" {{$property->zone_type == 'clothing' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="zone-clothing">Clothing</label>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-6 col-xl-6 mb25 location-hub-width {{$property->categories == 'plot' ? 'd-none' : ''}}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Location Hub<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-location_hub" class="post-property"></span>

                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="it park" id="location-it" {{$property->location_hub == 'it park' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="location-it">IT Park</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="business park" id="location-business" {{$property->location_hub == 'business park' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="location-business">Business Park</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="mall" id="lHub-mall" {{$property->location_hub == 'mall' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="lHub-mall">Mall</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="commercial project" id="lHub-commercial" {{$property->location_hub == 'commercial project' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="lHub-commercial">Commercial Project</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="residential project" id="lHub-residential" {{$property->location_hub == 'residential project' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="lHub-residential">Residential Project</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="location_hub" value="market high street" id="lHub-market" {{$property->location_hub == 'market high street' ? 'checked' : 'disabled'}}>
                                                                <label class="form-check-label fw600" for="lHub-market">Market/High Street</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="custom-basic-title ff-heading fw600 mb10">POSSESSTION INFO</div>

                                                    <div class="row {{$property->categories == 'plot' ? 'd-none' : ''}}">
                                                        <div class="col-sm-6 col-xl-6 mb25 location-page-width">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Possession status<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-property_status" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_status" id="ready-to-move-commerical" value="ready to move" {{$property->possession_status == 'ready to move' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="ready-to-move-commerical">Ready to move</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_status" id="under-construction-commerical" value="under construction" {{$property->possession_status == 'under construction' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="under-construction-commerical">Under construction</label>
                                                            </div>
                                                        </div>
                                                        
                                                       @php $commercialProject = ['retail shop', 'showroom', 'warehouse']; @endphp
                                                        <div class="col-sm-6 col-xl-6 mb25 location-page-width property-condition {{ in_array($property->categories, $commercialProject) ? 'd-none' : '' }}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Property Condition<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-property_condition" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="property_condition" id="commerical-ready-to-use" value="ready to use" {{$property->property_condition == 'ready to use' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="commerical-ready-to-use">Ready to use</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="commerical-bare-shell" name="property_condition" value="bare shell" {{$property->property_condition == 'bare shell' ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="commerical-bare-shell">Bare shell</label>
                                                            </div>
                                                        </div>

                                                        @php $locatedNear = explode(',', $property->located_near) @endphp
                                                        <div class="col-sm-6 col-xl-6 mb25 location-page-width located-near {{$property->categories == 'office' ? 'd-none' : ''}}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Located Near<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-located_near" class="post-property"></span>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="located_near[]" id="shop-entrance" value="entrance" {{in_array('entrance', $locatedNear) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="shop-entrance">Entrance</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" name="located_near[]" id="shop-elevator" value="elevator" {{in_array('elevator', $locatedNear) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="shop-elevator">Elevator</label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="shop-stairs" name="located_near[]" value="stairs" {{in_array('stairs', $locatedNear) ? 'checked' : ''}}>
                                                                <label class="form-check-label fw600" for="shop-stairs">Stairs</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-3 col-xl-3 mb25 built-up-area">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Built Up Area <span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_built_up" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Built Up Area" name="comm_built_up" oninput="showSqft(this)" id="comm-built-up" value="{{$property->built_up_area}}">
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
                                                            <input type="text" class="form-control datepicker" placeholder="Available From" name="available_from" id="available-from" value="{{$property->possession_date}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 age-of-property-commerical {{ ($property->categories == 'plot') || ($property->categories == 'office' && $property->possession_status == 'under construction') ? 'd-none' : ''}}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Age of Property (in years)<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_age_property" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Age of Property (in years)" name="comm_age_property" value="{{$property->property_age}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 carpet-area-commerical {{ ($property->categories == 'plot') || ($property->categories == 'office' && $property->property_condition == 'bare shell' ) ? 'd-none' : ''}}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Carpet Area<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-carpet_area" class="post-property"></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Carpet Area" name="carpet_area" id="carpet-area" value="{{$property->carpet_area}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 entrance-width-in-feet {{ ($property->categories == 'plot' ) || ($property->categories == 'office') ? 'd-none' : ''}}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Entrance width in feet<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_area_width" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Entrance width in feet" name="comm_area_width" id="com-area-width" value="{{$property->width}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25 ceiling-height-in-feet {{( $property->categories == 'plot') || ($property->categories == 'office') ? 'd-none' : ''}}">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Ceiling height in feet<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-comm_area_height" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Ceiling height in feet" name="comm_area_height" id="comm-area-height" value="{{$property->height}}">
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
                                                            <input class="form-check-input" type="radio" name="ownership" value="freehold" id="own-freehold" {{$property->ownership == 'freehold' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="own-freehold">Freehold</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="leasehold" id="own-leasehold" {{$property->ownership == 'leasehold' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="own-leasehold">Leasehold</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="cooperative society" id="own-cooperative" {{$property->ownership == 'cooperative society' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="own-cooperative">Cooperative society</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="ownership" value="power attorney" id="own-attorney" {{$property->ownership == 'power attorney' ? 'checked' : ''}}>
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
                                                            <input class="form-check-input" type="radio" id="negotiable-Yes" name="negotiable" value="yes" {{$property->negotiable == 'yes' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="negotiable-Yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="negotiable-No" name="Negotiable" value="no" {{$property->negotiable == 'no' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="negotiable-No">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xl-3 mb25 dg-ups-charge-include {{$property->categories == 'plot' ? 'd-none' : ''}}">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10" id="dg-ups-charge">DG & UPS Charge included?</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="ups-charge-yes" name="dg_ups_charge" value="yes" {{$property->dg_ups == 'yes' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="ups-charge-yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="ups-charge-No" name="dg_ups_charge" value="no" {{$property->dg_ups == 'no' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="ups-charge-No">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xl-3 mb25 electricity-charges">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Electricity charges included?</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="electricity-yes" name="electricity_charges" value="yes" {{$property->electricity_charge == 'yes' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="electricity-yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="electricity-No" name="electricity_charges" value="no" {{$property->electricity_charge == 'no' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="electricity-No">No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xl-3 mb25 water-charges {{$property->categories == 'plot' ? 'd-none' : ''}}">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Water charges included?</label><br>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="waterChar-Yes" name="water_charges" value="yes" {{$property->water_charge == 'yes' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="waterChar-Yes">Yes</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="waterChar-No" name="water_charges" value="no" {{$property->water_charge == 'no' ? 'checked' : ''}}>
                                                            <label class="form-check-label fw600" for="waterChar-No">No</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row plot-seclet floors-data {{$property->categories == 'plot' ? 'd-none' : ''}}">
                                                    <div class=" custom-basic-title ff-heading fw600 mb10">FLOORS AVAILABLE</div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Total Floors<span class="mandatoryMarker">*</span></label><br>
                                                            <span id="alert-error-total_floors" class="post-property"></span>

                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Total Floors" name="total_floors" id="total-floors" value="{{$property->total_property}}">
                                                    </div>

                                                    <div class="col-sm-6 col-xl-6 mb25">
                                                        <div class="location-area">
                                                            <label for="phone" class="ff-heading fw600 mb10">Your Floor</label><br>
                                                            <span id="alert-error-your_floor" class="post-property"></span>
                                                        </div>
                                                        <input type="number" class="form-control" placeholder="Your Floor" name="your_floor" id="your-floor" value="{{$property->your_floor}}">

                                                    </div>
                                                </div>

                                                <div class="secleted-office plot-seclet custom-lifts-staircases {{( $property->categories == 'plot') || (in_array($property->categories, $commercialProject) ) ? 'd-none' : ''}}">
                                                    <div class="row">
                                                        <div class="custom-basic-title ff-heading fw600 mb10">LIFTS & STAIRCASES</div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Number of staircase</label><br>
                                                                <span id="alert-error-staircase" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="staircase" name="staircase" id="staircase" value="{{$property->staircase}}">

                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Passengers Lifts<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-passenger_lift" class="post-property"></span>
                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Passengers Lifts" name="passenger_lift" id="passenger-lift" value="{{$property->passenger_lift}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Service Lifts<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-service_lift" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Service Lifts" name="service_lift" id="service-lift" value="{{$property->service_lift}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Conference Room</label><br>
                                                                <span id="alert-error-conference_room" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Conference Room" name="conference_room" id="conference-room" value="{{$property->conference_room}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="plot-seclet {{$property->categories == 'plot' ? 'd-none' : ''}}">


                                                    <div class="custom-basic-title ff-heading fw600 mb10">FACILITIES</div>

                                                    <div class="secleted-office custom-office-facilities {{ in_array($property->categories, $commercialProject) ? 'd-none' : ''}}">
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">Min. Number of seats<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-min_seat" class="post-property"></span>
                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Min. Number of seats" name="min_seat" id="min-seat" value="{{$property->min_seat}}">

                                                            </div>
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">please enter maximum seats<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-max_seat" class="post-property"></span>
                                                                </div>
                                                                <input type="number" class="form-control" placeholder="please enter maximum seats" name="max_seat" id="max-seat" value="{{$property->max_seat}}">

                                                            </div>
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">Number of Cabins<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-number_of_cabins" class="post-property"></span>

                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Number of Cabins" name="number_of_cabins" id="cabins" value="{{$property->cabins}}">

                                                            </div>
                                                            <div class="col-sm-3 col-xl-3 mb25">
                                                                <div class="location-area">
                                                                    <label for="phone" class="ff-heading fw600 mb10">Number of Meeting Rooms<span class="mandatoryMarker">*</span></label><br>
                                                                    <span id="alert-error-meeting_rooms" class="post-property"></span>

                                                                </div>
                                                                <input type="number" class="form-control" placeholder="Number of Meeting Rooms" name="meeting_rooms" id="meeting-room" value="{{$property->meeting_room}}">

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
                                                            <input type="number" class="form-control" placeholder="Private Parking" name="private_parking" id="private-parking" value="{{$property->private_parking}}">

                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label for="phone" class="ff-heading fw600 mb10">Public Parking</label><br>
                                                                <span id="alert-error-public_parking" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Public Parking" name="public_parking" id="public-parking" value="{{$property->public_parking}}">

                                                        </div>
                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Private Washrooms<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-private_washrooms" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Private Washrooms" name="private_washrooms" id="private-washroom" value="{{$property->private_washroom}}">
                                                        </div>

                                                        <div class="col-sm-3 col-xl-3 mb25">
                                                            <div class="location-area">
                                                                <label class="ff-heading fw600 mb10">Public Washrooms<span class="mandatoryMarker">*</span></label><br>
                                                                <span id="alert-error-public_washrooms" class="post-property"></span>

                                                            </div>
                                                            <input type="number" class="form-control" placeholder="Public Washrooms" name="public_washrooms" id="public-washroom" value="{{$property->public_washroom}}">
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
            <div class="thirds-section ">

                <div class="select-residential-sell ">
                    <div class="row">
                        <div class="custom-basic-title ff-heading fw600 mb10">Add Price Details</div>

                        <div class="col-sm-4 col-xl-4 mb25">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10" id="property-price">Price<span class="mandatoryMarker">*</span></label><br>
                                <span id="alert-error-price" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter price" id="price" name="price" oninput="formatRent(this)" value="{{$property->price}}">
                            <span class="formatted-rent"></span>
                        </div>



                        <div class="col-sm-4 col-xl-4 mb25 select-available-from {{$property->property_type == 'residential' && $property->looking_to == 'rent' ? '' : 'd-none'}}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Available From</label><br>
                                <span id="alert-error-available_date" class="post-property"></span>

                            </div>
                            <input type="text" class="form-control datepicker" placeholder="Available From" name="available_date" id="available-date" value="{{$property->possession_date}}">
                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-security-deposite-text {{($property->property_type == 'residential' && $property->looking_to == 'rent') || ($property->looking_to == 'pg') || (in_array($property->categories, $commercialType) && $property->looking_to == 'rent') ? '' : 'd-none'}}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Security Deposit</label><br>
                                <span id="alert-error-security_deposit" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Security Deposit" id="security-deposite" name="security_deposit" oninput="secuirtyForment(this)" value="{{$property->security_deposity}}">
                            <span class="secuirtyForment"></span>
                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-possion-status {{ (in_array($property->categories, $residentialType)) || ($property->looking_to == 'pg') || ($property->categories == 'plot' && $property->property_type == 'commercial') || (in_array($property->categories, $commercialType)) ? 'd-none' : '' }}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Possession status</label><br>
                                <span id="alert-error-posession_status_comm" class="post-property"></span>

                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="immediate" name="posession_status_comm" value="immediate" {{$property->possession_status == 'immediate' ? 'checked' : ''}}>
                                <label class="form-check-label fw600" for="immediate">Immediate</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="in-future" name="posession_status_comm" value="in future" {{$property->possession_status == 'in future' ? 'checked' : ''}}>
                                <label class="form-check-label fw600" for="in-future">In Future</label>
                            </div>

                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-possion-status-residential {{ ($property->property_type == 'residential' && $property->looking_to == 'rent') || ($property->looking_to == 'pg') || ($property->categories == 'plot')  || (in_array($property->categories, $commercialType)) ? 'd-none' : ''}}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Possession status</label><br>
                                <span id="alert-error-possession_status_resi" class="post-property"></span>

                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="ready-to-move" name="posession_status_resi" value="ready to move" {{$property->possession_status == 'ready to move' ? 'checked' : ''}}>
                                <label class="form-check-label fw600" for="ready-to-move">Ready to Move</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="under-costruction" name="posession_status_resi" value="under construction" {{$property->possession_status == 'under construction' ? 'checked' : ''}}>
                                <label class="form-check-label fw600" for="under-costruction">Under Construction</label>
                            </div>
                        </div>

                        <div class="col-sm-4 col-xl-4 mb25 select-possiession-date {{ ($property->property_type == 'residential' && $property->looking_to == 'sell' && $property->possession_status == 'under construction') || ($property->categories == 'plot' && $property->possession_status == 'in future')  ? '' : 'd-none'}}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Possession Date </label><br>
                                <span id="alert-error-possession_date" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control datepicker" placeholder="Possession Date" name="possession_date" value="{{$property->possession_date}}">
                        </div>

                        <div class="col-sm-3 col-xl-3 mb25 meal-charege-per-month {{ $property->looking_to == 'pg' && $property->meal == 'yes' ? '' : 'd-none' }}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Meal Charges per Month (Optional)</label><br>
                                <span id="alert-error-meal_charges_month" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Meal Charges per Month" name="meal_charges_month" id="meal-charge" value="{{$property->meal_charges}}">
                        </div>

                        <div class="col-sm-3 col-xl-3 mb25 electricity-charge-per-month {{ $property->looking_to == 'pg' ? '' : 'd-none' }}">
                            <div class="location-area">
                                <label class="ff-heading fw600 mb10">Electricity Charges per Month (Optional)</label><br>
                                <span id="alert-error-electricity_charges_month" class="post-property"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Electricity Charges per Month" name="electricity_charges_month" id="electricity-charge" value="{{$property->electricity_charges}}">
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
                            @if(!empty($property->images))
                            <div class="image-preview-space">
                                @php $image = explode(',', $property->images); @endphp
                                @foreach($image as $img)
                                <div class="preview-image">
                                    <img src="{{ asset('assets/postImages/' . $img) }}" alt="none">
                                    <span class="preview-delete" data-id="{{$property->id}}" data-images="{{$img}}"><i class="fa-solid fa-trash"></i></span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="img-ms"><b>There are no images available for this property at the moment.</b></p>

                            @endif


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

                    @if(!empty($property->video))
                    <span class="remove-video" data-id="{{$property->id}}"><i class="fa-solid fa-trash"></i></span>
                    <div id="video-player" style="text-align: center;"></div>
                    <video src="{{ asset('assets/postVideos/' . $property->video) }}" controls autoplay id="property-video"></video>

                    @else
                    <p class="video-msg"><b>There are no videos available for this property at the moment.</b></p>
                    @endif



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

@endsection