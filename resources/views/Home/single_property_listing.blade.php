@extends('layouts.app')
@section('content')

<?php
if (!function_exists('formatYearBuilt')) {
    function formatYearBuilt($age)
    {
        $parts = explode('_', $age);

        if (count($parts) === 2) {
            // Display as a range
            return $parts[0] . ' - ' . $parts[1] . '';
        } else {
            // Display as a single year
            return $age . ' years';
        }
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        if (!is_numeric($price)) {
            return 'N/A'; // or any other appropriate value
        }

        if ($price >= 10000000) {
            return '₹' . number_format($price / 10000000, 2) . ' Cr';
        } elseif ($price >= 100000) {
            return '₹' . number_format($price / 100000, 2) . ' Lac';
        } else {
            return '₹' . number_format($price / 1000, 2) . ' K';
        }
    }
}

$propertiesImages = explode(',', $property->images);
$firstTwoImages = array_slice($propertiesImages, 0, 2);
$remainingImages = array_slice($propertiesImages, 2);




if ($property->categories == 'plot' && is_numeric($property->plot_area)) {
    $pricePerSqFt = $property->price / $property->plot_area;
} elseif ($property->looking_to == 'rent' && is_numeric($property->price) && is_numeric($property->built_up_area)) {
    $pricePerSqFt = $property->price / $property->built_up_area;
} elseif (is_numeric($property->price) && is_numeric($property->built_up_area)) {
    $pricePerSqFt = $property->price / $property->built_up_area;
} else {
    $pricePerSqFt = 0;
}



?>

<div class="body_content">
    <!-- Property All Lists -->
    <section class="pt60 pb0 bgc-white">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms">
                <div class="col-lg-8">
                    <div class="single-property-content mb30-md">
                        <h2 class="sp-lg-title">{{substr($property->property_name, 0, strrpos($property->property_name, ' '))}}</h2>
                        <div class="pd-meta mb15 d-md-flex align-items-center">
                            <p class="text fz15 mb-0 pr10 bdrrn-sm">{{ ucwords($property['project_society']) }}, {{ ucwords($property['locality']) }}, {{ ucwords($property['city']) }}</p>
                        </div>
                        <div class="property-meta d-flex align-items-center">
                            <a class="ff-heading text-thm fz15 bdrr1 pr10 bdrrn-sm" href=""><i class="fas fa-circle fz10 pe-2"></i>For {{$property->looking_to}}</a>

                            @if($property->looking_to == 'pg')
                            <a class="ff-heading bdrr1 fz15 pr10 ml10 ml0-sm bdrrn-sm" href=""><i class="far fa-clock pe-2"></i>{{$property->room_type}}</a>

                            @elseif(!empty($property->property_age))
                            <a class="ff-heading bdrr1 fz15 pr10 ml10 ml0-sm bdrrn-sm" href=""><i class="far fa-clock pe-2"></i>{{ formatYearBuilt($property->property_age) }}</a>

                            @elseif($property->categories == 'plot')
                            <a class="ff-heading bdrr1 fz15 pr10 ml10 ml0-sm bdrrn-sm" href=""><i class="far fa-clock pe-2"></i>{{$property->plot_area}} {{$property->area_unit}}</a>

                            @else
                            <a class="ff-heading bdrr1 fz15 pr10 ml10 ml0-sm bdrrn-sm" href=""><i class="far fa-clock pe-2"></i>{{$property->built_up_area}} {{$property->area_unit}}</a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-property-content">
                        <div class="property-action text-lg-end">
                            <div class="d-flex mb20 mb10-md align-items-center justify-content-lg-end">
                                @if(session()->get('id'))
                                @if(!empty($favProperty))
                                <a class="icon mr10" id="fav-property" data-id="{{$property->id}}"><i class="fa fa-heart"></i></a>
                                @else
                                <a class="icon mr10" id="fav-property" data-id="{{$property->id}}"><span class="flaticon-like"></span></a>
                                @endif
                                <a class="icon mr10" href=""><span class="flaticon-share-1"></span></a>
                                @else
                                <a class="icon mr10" onclick="showFavPopup()"><span class="flaticon-like"></span></a>
                                <a class="icon mr10" onclick="showFavPopup()"><span class="flaticon-share-1"></span></a>
                                @endif
                            </div>
                            <h3 class="price mb-0">{{formatPrice($property->price)}}</h3>
                            <p class="text space fz15">{!! !empty($pricePerSqFt) ? formatPrice($pricePerSqFt) . ' /sq ft' : '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($property->images) && !empty($property->images))
            <div class="row mt30 wow fadeInUp" data-wow-delay="300ms">
                <div class="col-sm-9">
                    <div class="sp-img-content at-sp-v2 mb15-md">
                        @php $image = explode(',', $property->images); @endphp
                        @foreach($image as $img)
                        <a class="popup-img preview-img-1 sp-img" href="{{ asset('assets/postImages/' . $img) }}">
                            <img class="w-100" src="{{ asset('assets/postImages/' . $img) }}" alt="8.jpg">
                        </a>
                        @break
                        @endforeach

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="row">
                        @foreach($firstTwoImages as $img)
                        <div class="col-sm-12 ps-lg-0">
                            <div class="sp-img-content">
                                <a class="popup-img preview-img-3 sp-img mb10" href="{{ asset('assets/postImages/' . $img) }}">
                                    <img class="w-100" src="{{ asset('assets/postImages/' . $img) }}" alt="3.jpg">
                                </a>
                            </div>
                        </div>
                        @endforeach

                        <div class="row" id="remainingImages" style="display: none;">
                            @foreach($remainingImages as $img)
                            <div class="col-sm-12 ps-lg-0">
                                <div class="sp-img-content">
                                    <a class="popup-img preview-img-3 sp-img mb10" style="height: 278px;" href="{{ asset('assets/postImages/' . $img) }}">
                                        <img class="w-100" src="{{ asset('assets/postImages/' . $img) }}" alt="3.jpg">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <a href="#" id="showAllPhotos" class="all-tag popup-img">See All {{ count($propertiesImages) }} Photos</a>

                </div>
            </div>
            @else
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="row">
                    <div class="col-md-12">
                        <h4>No Images available for this property yet.</h4>
                    </div>
                </div>
            </div>
            @endif

            @if($property->categories == 'plot')
            <div class="row mt30">
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-expand"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Project Area</h6>
                            <p class="text mb-0 fz15">{{$property->plot_area}} / {{$property->area_unit}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-expand"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Sizes</h6>
                            <p class="text mb-0 fz15">{{$property->width}} - {{$property->height}} / {{$property->area_unit}}</p>
                        </div>
                    </div>
                </div>
                @if(!empty($pricePerSqFt))
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-event"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Avg. Price</h6>
                            <p class="text mb-0 fz15">{{formatPrice($pricePerSqFt)}}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            @php
                            $possessionDate = !empty($property->possession_date) ? new DateTime($property->possession_date) : null;
                            $createDate = new DateTime($property->created_at);
                            @endphp
                            <h6 class="mb-0">Possession Starts</h6>
                            <p class="text mb-0 fz15">{{ $possessionDate ? $possessionDate->format('M, Y') : $createDate->format('M, Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-home-1"></span>

                        <div class="ml15">
                            <h6 class="mb-0">Configuration</h6>
                            <p class="text mb-0 fz15">{{ucfirst($property->property_type)}} {{ucfirst($property->categories)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($property->categories == 'office')

            <div class="row mt30">
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-bed"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Built Up Area</h6>
                            <p class="text mb-0 fz15">{{$property->built_up_area}} / {{$property->area_unit}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-shower"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Seats</h6>
                            <p class="text mb-0 fz15">{{$property->min_seat}} - {{$property->max_seat}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-event"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Zone Type</h6>
                            <p class="text mb-0 fz15">{{ ucfirst($property->zone_type) }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Possession Status</h6>

                            <p class="text mb-0 fz15">{{ucfirst($property->possession_status)}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Location Hub</h6>

                            <p class="text mb-0 fz15">{{ucfirst($property->location_hub)}}</p>
                        </div>
                    </div>
                </div>

            </div>

            @elseif(in_array($property->categories, ['retail shop', 'showroom', 'warehouse']))

            <div class="row mt30">
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-bed"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Built Up Area</h6>
                            <p class="text mb-0 fz15">{{$property->built_up_area}} / {{$property->area_unit}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-shower"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Ownership</h6>
                            <p class="text mb-0 fz15">{{ ucfirst($property->ownership)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-event"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Location Hub</h6>
                            <p class="text mb-0 fz15">{{ ucfirst($property->location_hub) }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Suitable For</h6>
                            <p class="text mb-0 fz15">{{ucfirst($property->zone_type)}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Possession status</h6>
                            <p class="text mb-0 fz15">{{ucfirst($property->possession_status)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            @elseif(in_array($property->categories, ['apartment', 'independent floor', 'independent house']))

            <div class="row mt30">

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-expand"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Built Up Area</h6>
                            <p class="text mb-0 fz15">{{$property->built_up_area}} / sqft</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-bed"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Bedroom</h6>
                            <p class="text mb-0 fz15">{{ $property->total_property }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-event"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Year Built</h6>
                            <p class="text mb-0 fz15">{{ formatYearBuilt($property->property_age) }} </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Furnishing</h6>
                            <p class="text mb-0 fz15">{{ucfirst($property->furnish_type)}} </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-home-1"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Configuration</h6>
                            <p class="text mb-0 fz15">{{ucfirst($property->property_type)}} {{ucfirst($property->categories)}}</p>
                        </div>
                    </div>
                </div>
            </div>

            @else

            <div class="row mt30">
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-bed"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Meal Types</h6>
                            <p class="text mb-0 fz15">
                                @if(!empty($property->meal_offering))
                                @php
                                $mealTypes = array_map('ucwords', explode(',', $property->meal_offering));
                                $mealCount = count($mealTypes);
                                if ($mealCount > 1) {
                                $lastMeal = array_pop($mealTypes);
                                $mealString = implode(', ', $mealTypes) . ' and ' . $lastMeal;
                                } else {
                                $mealString = $mealTypes[0];
                                }
                                @endphp
                                {{ $mealString }}
                                @else
                                Without Food
                                @endif
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-shower"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Meal Offerings</h6>
                            <p class="text mb-0 fz15">
                                @if(!empty($property->meal_speciality))
                                @php
                                $mealSpecialities = array_map('ucwords', explode(',', $property->meal_speciality));
                                $mealCount = count($mealSpecialities);
                                if ($mealCount > 1) {
                                $lastMeal = array_pop($mealSpecialities);
                                $mealString = implode(', ', $mealSpecialities) . ' and ' . $lastMeal;
                                } else {
                                $mealString = $mealSpecialities[0];
                                }
                                @endphp
                                {{ $mealString }}
                                @else
                                No Special Meal Offerings
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-event"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Total Beds</h6>
                            <p class="text mb-0 fz15">{{ $property->total_property }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-garage"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Notice Period</h6>
                            <p class="text mb-0 fz15">{{ $property->notice_period}} Days</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-expand"></span>
                        <div class="ml15">
                            <h6 class="mb-0">Lock In Period</h6>
                            <p class="text mb-0 fz15">{{$property->lock_in_period}} Days</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="overview-element mb25 d-flex align-items-center">
                        <span class="icon flaticon-home-1"></span>
                        <div class="ml15">
                            <h6 class="mb-0">PG For</h6>
                            <p class="text mb-0 fz15">{{ ucfirst($property->pg_for) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- Property All Lists -->
    <section class="pt60 pb90 bgc-f7">
        <div class="container">
            <div class="row wrap wow fadeInUp" data-wow-delay="500ms">
                <div class="col-lg-8">
                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Property Description</h4>
                        <p class="text mb10">This 3-bed with a loft, 2-bath home in the gated community of The Hideout has it all. From the open floor plan to the abundance of light from the windows, this home is perfect for entertaining. The living room and dining room have vaulted ceilings and a beautiful fireplace. You will love spending time on the deck taking in the beautiful views. In the kitchen, you'll find stainless steel appliances and a tile backsplash, as well as a breakfast bar.</p>
                        <div class="agent-single-accordion">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-0">
                                            <p class="text">Placeholder content for this accordion, which is intended to demonstrate the class. This is the first item's accordion body you get groundbreaking performance and amazing battery life. Add to that a stunning Liquid Retina XDR display, the best camera and audio ever in a Mac notebook, and all the ports you need.</p>
                                        </div>
                                    </div>
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button p-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Show more</button>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <style>
                            .dark-color,
                            .heading-color,
                            .title-color {
                                color: #181a20;
                            }
                        </style>

                        <h4 class="title fz17 mb30 mt50">Property Details</h4>
                        @if($property->categories == 'plot')

                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Price</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Property Size</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Project Area</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Possession Starts</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{formatPrice($property->price)}}</p>
                                        <p class="text mb10">{{$property->width}} - {{$property->height}} / {{$property->area_unit}}</p>
                                        <p class="text mb10">{{$property->plot_area}} / {{$property->area_unit}}</p>
                                        @php
                                        $possessionDate = !empty($property->possession_date) ? new DateTime($property->possession_date) : null;
                                        $createDate = new DateTime($property->created_at);
                                        @endphp
                                        <p class="text mb10">{{ $possessionDate ? $possessionDate->format('M, Y') : $createDate->format('M, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 offset-xl-2">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Configuration</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Property Status</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{ucfirst($property->property_type)}} {{ucfirst($property->categories)}}</p>
                                        <p class="text mb-0">For {{ucfirst($property->looking_to)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($property->categories == 'office')
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Price</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Built Up Area</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Possession Status</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Zone Type</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">DG & UPS Charges Included</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Negotiable</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Ownership</p>


                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{formatPrice($property->price)}}</p>
                                        <p class="text mb10">{{$property->built_up_area}} / {{$property->area_unit}}</p>
                                        <p class="text mb10">{{$property->possession_status}}</p>
                                        <p class="text mb-0">{{$property->zone_type}}</p>
                                        <p class="text mb-0">{{ucfirst($property->dg_ups)}}</p>
                                        <p class="text mb-0">{{ucfirst($property->negotiable)}}</p>
                                        <p class="text mb-0">{{ucfirst($property->ownership)}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 offset-xl-2">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Location Hub</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Cabins</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Meeting Rooms</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Washrooms</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Conference Rooms</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Staircases</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Lifts</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{ucfirst($property->location_hub)}}</p>
                                        <p class="text mb-0">{{ucfirst($property->cabins)}}</p>
                                        <p class="text mb-0">{{$property->meeting_room}}</p>
                                        <p class="text mb-0">{{$property->private_washroom}} Private, {{$property->public_washroom}} Public</p>
                                        <p class="text mb-0">{{$property->conference_room}}</p>
                                        <p class="text mb-0">{{$property->staircase}}</p>
                                        <p class="text mb-0">{{$property->service_lift}} Service, {{$property->passenger_lift}} Passenger</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif(in_array($property->categories, ['retail shop', 'showroom', 'warehouse']))
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Price</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Built Up Area</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Possession Status</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Zone Type</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">DG & UPS Charges Included</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{formatPrice($property->price)}}</p>
                                        <p class="text mb10">{{$property->built_up_area}} / {{$property->area_unit}}</p>
                                        <p class="text mb10">{{ ucfirst($property->possession_status)}}</p>
                                        <p class="text mb-0">{{$property->zone_type}}</p>
                                        <p class="text mb-0">{{ucfirst($property->dg_ups)}}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 offset-xl-2">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">

                                        <p class="fw600 mb10 ff-heading dark-color">Location Hub</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Washrooms</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Staircases</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Lifts</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Negotiable</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Ownership</p>
                                    </div>
                                    <div class="pd-list">

                                        <p class="text mb10">{{ucfirst($property->location_hub)}}</p>
                                        <p class="text mb-0">{{$property->private_washroom}} Private, {{$property->public_washroom}} Public</p>
                                        <p class="text mb-0">{{$property->staircase}}</p>
                                        <p class="text mb-0">{{$property->service_lift}} Service, {{$property->passenger_lift}} Passenger</p>
                                        <p class="text mb-0">{{ucfirst($property->negotiable)}}</p>
                                        <p class="text mb-0">{{ucfirst($property->ownership)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif(in_array($property->categories, ['apartment', 'independent floor', 'independent house']))
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Price</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Built Up Area</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Bathrooms</p>
                                        <p class="fw600 mb-0 ff-heading dark-color">Bedrooms</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{$property->price}}</p>
                                        <p class="text mb10">{{$property->built_up_area}} / {{$property->area_unit}}</p>
                                        <p class="text mb10">{{$property->bath}}</p>
                                        <p class="text mb10">{{$property->total_property}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 offset-xl-2">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Balcony</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Configuration</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Property Status</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{ $property->balconies ? $property->balconies : 'No balcony' }}</p>
                                        <p class="text mb10">{{ucfirst($property->property_type)}} {{ucfirst($property->categories)}}</p>
                                        <p class="text mb-0">For {{ucfirst($property->looking_to)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">Total Beds</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Price</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Notice Period</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Rooms Offered</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{$property->total_property}}</p>
                                        <p class="text mb10">{{formatPrice($property->price)}}/ bed</p>
                                        <p class="text mb10">{{$property->notice_period}} Days</p>
                                        <p class="text mb10">{{$property->room_type}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 offset-xl-2">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">PG For</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Meal</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Ownership</p>
                                        <p class="fw600 mb10 ff-heading dark-color">Bath Style</p>
                                    </div>
                                    <div class="pd-list">
                                        <p class="text mb10">{{ucfirst($property->pg_for)}}</p>
                                        <p class="text mb10">
                                            {{$property->meal == 'yes' ? 'Available' : 'Not Available'}}
                                        </p>
                                        <p class="text mb10">{{ucfirst($property->ownership)}}</p>
                                        <?php
                                        $bathStyle = explode(",", $property->bathroom_style);
                                        $bathStyleCapitalized = array_map('ucfirst', $bathStyle);
                                        ?>
                                        <p class="text mb10">{{ implode(", ", $bathStyleCapitalized) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30 mt30">Address</h4>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="d-flex justify-content-between">
                                    <div class="pd-list">
                                        <p class="fw600 mb10 ff-heading dark-color">{{ ucfirst($property->project_society) }}, {{ ucfirst($property->locality) }}, {{ ucfirst($property->city) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <iframe class="position-relative bdrs12 mt30 h250" loading="lazy" src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near" title="London Eye, London, United Kingdom" aria-label="London Eye, London, United Kingdom"></iframe>
                            </div>
                        </div>
                    </div>
                    @if(!empty($property->amenities))
                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Features & Amenities</h4>
                        @php $featuresAmenities = explode(',', $property->amenities) @endphp
                        <div class="row">
                            @foreach($featuresAmenities as $amenities)
                            <div class="col-sm-6 col-md-4">
                                <div class="pd-list mb10-sm">
                                    <p class="text mb10"><i class="fas fa-circle fz6 align-middle pe-2"></i>{{$amenities}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(!empty($property->video))
                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                        <h4 class="title fz17 mb30">Video</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="property_video bdrs12 w-100">
                                    <a class="video_popup_btn mx-auto popup-img popup-youtube" href="{{asset('assets/postVideos/'. $property->video)}}"><span class="flaticon-play"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="col-lg-6 success-mesg">
                        <div class="ui-content">
                            <div class="message-alart-style1">
                                <div class="alert alart_style_four alert-dismissible fade show mb20" role="alert">Success: {{ session('success') }}
                                    <i class="far fa-xmark btn-close" data-bs-dismiss="alert" aria-label="Close"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($propertiesReview) && count($propertiesReview) > 0)
                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product_single_content">
                                    <div class="mbp_pagination_comments">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="total_review d-flex align-items-center justify-content-between mb20">
                                                    <h6 class="fz17 mb15"><i class="fas fa-star fz12 pe-2"></i>{{ count($propertiesReview) }} reviews</h6>
                                                </div>
                                            </div>
                                            <?php $reviewCount = 0; ?>
                                            @foreach($propertiesReview as $review)
                                            <?php $reviewCount++; ?>
                                            <div class="col-md-12" @if($reviewCount> 2) style="display: none;" @endif>
                                                <div class="mbp_first position-relative d-flex align-items-center justify-content-start mb30-sm">
                                                    <img src="{{ asset('assets/profileImg/' . $review->user->image) }}" class="mr-3" alt="comments-2.png" style="height: 60px;">
                                                    <div class="ml20">
                                                        <h6 class="mt-0 mb-0">{{$review->user->name}}</h6>
                                                        <div><span class="fz14">{{$review->created_at->format('F j, Y')}}</span>
                                                            <div class="blog-single-review">
                                                                <ul class="mb0 ps-0">
                                                                    <?php $rating = $review->rating; ?>
                                                                    @for ($j = 1; $j <= 5; $j++) @if ($j <=$rating) <li class="list-inline-item me-0"><i class="fas fa-star review-color2 fz10"></i></li>
                                                                        @else
                                                                        <li class="list-inline-item me-0"><i class="far fa-star review-color2 fz10"></i></li>
                                                                        @endif
                                                                        @endfor
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text mt20 mb20">{{ ucwords($review->comment) }}</p>
                                            </div>

                                            @endforeach
                                            <div class="col-md-12">
                                                <div class="position-relative pt30">
                                                    @if (count($propertiesReview) > 2)
                                                    <a href="javascript:void(0);" class="ud-btn btn-white2 show-all-reviews">Show all {{ count($reviewData) - 2 }} reviews<i class="fal fa-arrow-right-long"></i></a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>No reviews available for this property yet.</h4>
                        </div>
                    </div>
                </div>
                @endif



                @if(session()->get('id') && !$userHasReviewed)
                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">

                    <h4 class="title fz17 mb30">Leave A Review</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bsp_reveiw_wrt">
                                <form class="comments_form" action="{{route('insert.review')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="widget-wrapper sideborder-dropdown psp-review mb-4">
                                                <label class="fw600 ff-heading mb-2">Rating</label>
                                                <div class="form-style2 input-group">
                                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="rating" required>
                                                        <option selected disabled>Select</option>
                                                        <option value="5">Five Star</option>
                                                        <option value="4">Four Star</option>
                                                        <option value="3">Three Star</option>
                                                        <option value="2">Two Star</option>
                                                        <option value="1">One Star</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="fw600 ff-heading mb-2">Review</label>
                                                <input type="hidden" name="vendor_id" value="{{$property->reg_id}}">
                                                <input type="hidden" name="property_id" value="{{$property->id}}">

                                                <textarea class="pt15" rows="6" placeholder="Write a Review" name="comment" required></textarea>
                                            </div>
                                            <button type="submit" class="ud-btn btn-white2">Submit Review<i class="fal fa-arrow-right-long"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(session()->has('id'))
                <h4>You have already reviewed this property.</h4>
                @else
                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                    <h4 class="title fz17 mb30">Leave A Review</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bsp_reveiw_wrt">
                                <form class="comments_form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="widget-wrapper sideborder-dropdown psp-review mb-4">
                                                <label class="fw600 ff-heading mb-2">Rating</label>
                                                <div class="form-style2 input-group">
                                                    <select class="selectpicker" data-live-search="true" data-width="100%">
                                                        <option>Select</option>
                                                        <option data-tokens="Five Star">Five Star</option>
                                                        <option data-tokens="Four Star">Four Star</option>
                                                        <option data-tokens="Three Star">Three Star</option>
                                                        <option data-tokens="Two Star">Two Star</option>
                                                        <option data-tokens="One Star">One Star</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="fw600 ff-heading mb-2">Review</label>
                                                <textarea class="pt15" rows="6" placeholder="Write a Review" onclick="showLoginPopup()"></textarea>
                                            </div>
                                            <a onclick="showLoginPopup()" class="ud-btn btn-white2">Submit Review<i class="fal fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @unless(session()->get('id') == $property->reg_id)
            @if(session()->get('id'))
            <div class="col-lg-4">
                <div class="column">
                    <div class="default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white position-relative">
                        <h6 class="title fz17 mb30">Contact Seller</h6>
                        <span class="text-success" id="request-msg"></span>
                        <span class="text-success" id="chat-status-text"></span>
                        <div class="agent-single d-sm-flex align-items-center pb25">
                            <div class="single-img mb30-sm">
                                <img class="w90" src="{{ asset('assets/profileImg/'. $property->owner->image)}}" alt="">
                            </div>
                            <div class="single-contant ml20 ml0-xs">
                                <h6 class="title mb-1">{{$property->owner->name}}</h6>
                                <div class="agent-meta mb10 d-md-flex align-items-center">
                                    <?php $displayPhoneNumber = substr($property->owner->phone, -5); ?>
                                    <a class="text fz15" href=""><i class="flaticon-call pe-1"></i>....{{$displayPhoneNumber}}</a>
                                </div>
                            </div>
                        </div>
                        <form class="form-style1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">Hello, {{ session()->get('name')}}!</label>
                                        <p class="mb20">We're glad to see you here. Click below to send your request.</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-grid">
                                        <a class="ud-btn btn-thm" id="send-req">Send Request<i class="fal fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @else
            <div class="col-lg-4">
                <div class="column">
                    <div class="default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white position-relative">
                        <h6 class="title fz17 mb30">Contact Seller</h6>
                        <div class="agent-single d-sm-flex align-items-center pb25">
                            <div class="single-img mb30-sm">
                                <img class="w90" src="{{ asset('assets/profileImg/'. $property->owner->image)}}" alt="">
                            </div>
                            <div class="single-contant ml20 ml0-xs">
                                <h6 class="title mb-1">{{ $property->owner->name }}</h6>
                                <div class="agent-meta mb10 d-md-flex align-items-center">
                                    <?php $displayPhoneNumber = substr($property->owner->phone, -5); ?>

                                    <a class="text fz15" href=""><i class="flaticon-call pe-1"></i>.......{{$displayPhoneNumber}}</a>
                                </div>
                            </div>
                        </div>
                        <form class="form-style1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-grid">
                                        <a class="ud-btn btn-thm" onclick="showRequestPopup()">Send Request<i class="fal fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endunless

        </div>



        @if(!empty($nearbySimilarHomes) && count($nearbySimilarHomes) > 0)
        <div class="row mt30 wow fadeInUp" data-wow-delay="700ms">
            <div class="col-lg-9">
                <div class="main-title2">
                    <h2 class="title">Nearby Similar Homes</h2>
                    <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp" data-wow-delay="900ms">
            <div class="col-lg-12">
                <div class="property-city-slider navi_pagi_top_right slider-dib-sm slider-3-grid owl-theme owl-carousel">
                    @foreach($nearbySimilarHomes as $house)
                    <div class="item">
                        <div class="listing-style1">
                            <div class="list-thumb">
                                <?php $image = explode(',', $house->images) ?>
                                @foreach($image as $img)
                                <img class="w-100" src="{{ asset('assets/postImages/' . $img) }}" alt="">
                                @break
                                @endforeach
                                <div class="list-tag fz12"><span class="flaticon-electricity me-2"></span>FEATURED</div>
                                <div class="list-price">{{formatPrice($house->price)}} {!! $house->looking_to == 'sell' ? '' : '/<span>mo</span>' !!}</div>
                            </div>
                            <div class="list-content">
                                <h6 class="list-title"><a href="{{route('single.list', ['id' => base64_encode($house->id), 'name' => base64_encode($house->property_name)])}}">{{substr($house->property_name, 0, strrpos($house->property_name, ' '))}}</a></h6>
                                <p class="list-text">{{ ucwords($house['project_society']) }}, {{ ucwords($house['locality']) }}, {{ ucwords($house['city']) }}</p>
                                <div class="list-meta d-flex align-items-center">
                                    @if(in_array($house->categories, ['apartment', 'independent floor', 'independent house']))
                                    <span class="flaticon-bed"></span>{{$house->total_property}}
                                    <span class="flaticon-shower"></span>{{$house->bath}} bath
                                    <span class="flaticon-expand"></span>{{$house->built_up_area}} sqft
                                    @elseif($house->categories == 'office')
                                    <span class="flaticon-bed"></span>{{$house->max_seat}}
                                    <span class="flaticon-shower"></span>{{$house->meeting_room}}
                                    <span class="flaticon-expand"></span>{{$house->built_up_area}} sqft
                                    @elseif(in_array($house->categories, ['retail shop', 'showroom', 'warehouse']))
                                    <span class="flaticon-bed"></span>{{$house->staircase}}
                                    <span class="flaticon-shower"></span>{{$house->your_floor}}
                                    <span class="flaticon-expand"></span>{{$house->built_up_area}} sqft
                                    @elseif($house->looking_to == 'pg')
                                    <span class="flaticon-bed"></span>{{$house->total_property}}
                                    <span class="flaticon-shower"></span>{{$house->suited_for}}
                                    <span class="flaticon-expand"></span>{{$house->room_type}}
                                    @endif
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="list-meta2 d-flex justify-content-between align-items-center">
                                    <span class="for-what">For {{ucfirst($house->looking_to)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
</div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('showAllPhotos').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('remainingImages').style.display = 'none';
        this.style.display = 'none';
    });

    function showLoginPopup() {
        Swal.fire({
            title: 'Login Required',
            text: 'Please log in first to leave a review.',
            icon: 'warning',
        });
    }

    function showRequestPopup() {
        Swal.fire({
            title: 'Login Required',
            text: 'You need to log in to send a request. Please log in or create an account to continue.',
            icon: 'warning',

        });
    }

    function showFavPopup() {
        Swal.fire({
            title: 'Login Required',
            text: 'You need to log in to your favorite property. Please log in or create an account to continue.',
            icon: 'warning',

        });
    }

    $(document).ready(function() {
        $('.show-all-reviews').click(function() {
            $('.col-md-12').show();
            $('.show-all-reviews').hide();
        });

    });
    document.getElementById('send-req').addEventListener('click', function() {
        alert('The chat feature is currently under development. Please check back later.');
    });
</script>

<script>
    $(document).ready(function() {
        $('#fav-property').click(function() {
            var propertyId = $(this).data('id');


            $.ajax({
                type: "POST",
                url: "{{route('add.fav.property')}}",
                data: {
                    propertyId: propertyId,
                    "_token": "{{ csrf_token() }}",
                },

                success: function(response) {
                    console.log(response);
                    if (response.message == 'success') {
                        Swal.fire({
                            title: "Property Liked",
                            text: "You have successfully added this property to your favorites.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });

                    } else if (response.message == 'removed') {

                        Swal.fire({
                            title: "Property Unliked",
                            text: "You have successfully removed this property from your favorites.",
                            icon: "info",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });

                    }

                    setTimeout(function() {
                        location.reload();
                    }, 4000);


                },
                error: function(xhr, error, status) {
                    console.log("Ajax Error", error);
                }
            });
        });
    });
</script>

@endsection