<?php

namespace App\Http\Controllers;

use App\Models\FavProperty;
use App\Models\NewsArticles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PostProperty;
use App\Models\PropertyReviews;
use App\Models\User;


class HomeController extends Controller
{


    public function postProperty()
    {
        $title = "Post Your Property - Ghar Ka Sapna";
        return view('Home.post_property', compact('title'));
    }

    public function submitPostProperty(Request $request)
    {
        //dd($request->all());

        $propertyType = $request->input('property_type');
        $lookingTo = $request->input('looking_to');
        $city = $request->input('search_city');
        $project_society = $request->input('project_society');
        $locality = $request->input('locality');


        // PG Details 

        $PGname = $request->input('pg_name');
        $totalBeds = $request->input('total_beds');
        $PGfor = $request->input('pg_for');
        $suitedFor = $request->input('suited_for');
        $meals = $request->input('meals');
        $mealOffering = $request->input('meal_offerings');
        $mealSpeciality = $request->input('meal_speciality');
        $noticePeriod = $request->input('notice_period');
        $lockPeriod = $request->input('lock_period');
        $commonAreas = $request->input('common_areas');
        $propertyManage = $request->input('property_manage');
        $staysProperty = $request->input('stays_property');

        $nonVeg = $request->input('non_veg');
        $PGsex = $request->input('pg_sex');
        $anyTime  = $request->input('pg_time_allowed');
        $visitorsAllowed = $request->input('visitors_allowed');
        $guardianAllowed = $request->input('guardian_allowed');
        $drinkSmok = $request->input('drin_smok_allowed');
        $roomType = $request->input('room_type');
        $totalBedsRoom = $request->input('total_beds_this_room');
        $bathStyle = $request->input('bath_style');
        $mealCharge = $request->input('meal_charges_month');

        // <----- end pg -----> 

        $categoryType = $request->input('category_type');

        $plotArea = $request->input('plot_area');
        $areaUnit = $request->input('area_unit');
        $plotLength = $request->input('plot_length');
        $plotWidth = $request->input('plot_width');

        $totalRoom = $request->input('total_property');
        $builtUpArea = $request->input('built_up_area');
        $bath = $request->input('bath');
        $balconies = $request->input('balconies');
        $ageOfProperty = $request->input('age_of_property');
        $furnishType = $request->input('furnishing');
        $residentialAmenities = $request->input('residential_amenities');

        $zoneType = $request->input('zone_type');
        $locationHub = $request->input('location_hub');
        $propertyStatus = $request->input('property_status');
        $propertyCondition = $request->input('property_condition');
        $locatedNear = $request->input('located_near');
        $comm_built_up = $request->input('comm_built_up');
        $availableFrom = $request->input('available_from');
        $commAgeProperty = $request->input('comm_age_property');
        $carpetArea = $request->input('carpet_area');
        $comm_areaWidth = $request->input('comm_area_width');
        $comm_areaHeight = $request->input('comm_area_height');
        $ownership = $request->input('ownership');

        $negotiable = $request->input('negotiable');
        $dg_upsCharge = $request->input('dg_ups_charge');
        $electricityChargeRadio = $request->input('electricity_charges');
        $waterChargeRadio = $request->input('water_charges');


        $totalFloor = $request->input('total_floors');
        $yourFloor = $request->input('your_floor');
        $staircase = $request->input('staircase');
        $passengerLift = $request->input('passenger_lift');
        $serviceLift = $request->input('service_lift');
        $conferenceRoom = $request->input('conference_room');
        $minSeat = $request->input('min_seat');
        $maxSeat = $request->input('max_seat');
        $number_of_cabins = $request->input('number_of_cabins');
        $meeting_rooms = $request->input('meeting_rooms');
        $private_parking = $request->input('private_parking');
        $public_parking = $request->input('public_parking');
        $private_washrooms = $request->input('private_washrooms');
        $public_washrooms = $request->input('public_washrooms');
        $commerical_amenities = $request->input('commerical_amenities');


        $price = $request->input('price');
        $available_date = $request->input('available_date');
        $security_deposit = $request->input('security_deposit');
        $posessionStatusComm = $request->input('posession_status_comm');
        $posessionStatusResi = $request->input('posession_status_resi');
        $possessionDate = $request->input('possession_date');
        $electricityChargesMonth = $request->input('electricity_charges_month');



        // explode values

        $explodeCommonAreas  =  !empty($commonAreas) && is_array($commonAreas) ? implode(',', $commonAreas) : '';
        $explodePGBath = !empty($bathStyle) && is_array($bathStyle) ? implode(',', $bathStyle) : '';
        $explodeMealOffering = !empty($mealOffering) && is_array($mealOffering) ? implode(',', $mealOffering) : '';
        $explodeMealSpeciality = !empty($mealSpeciality) && is_array($mealSpeciality) ? implode(',', $mealSpeciality) : '';
        $explodeLocatedNear = !empty($locatedNear) && is_array($locatedNear) ? implode(',', $locatedNear) : '';

        // string replace 

        $project = str_replace(array(',', '-', '/', '.', '(', ')', ';'), '', $project_society);
        $updateLocality = str_replace(array(',', '-', '/', '.', '(', ')', ';'), '', $locality);


        $sessionID = session()->get('id');
        // combinedValue 

        if ($builtUpArea !== null) {
            $built_up_area = $builtUpArea;
        } else {
            $built_up_area = $comm_built_up;
        }


        if ($totalBeds !== null) {
            $property = $totalBeds;
        } elseif ($totalRoom !== null) {
            $property = $totalRoom;
        } else {
            $property = $totalFloor;
        }


        if ($propertyManage !== null) {
            $propertyOwner = $propertyManage;
        } else {
            $propertyOwner = $ownership;
        }

        if ($plotLength !== null) {
            $length = $plotLength;
        } else {
            $length = $comm_areaHeight;
        }

        if ($plotWidth !== null) {
            $width = $plotWidth;
        } else {
            $width = $comm_areaWidth;
        }

        if ($posessionStatusComm !== null) {

            $possessionStatus = $posessionStatusComm;
        } elseif ($propertyStatus !== null) {
            $possessionStatus = $propertyStatus;
        } else {
            $possessionStatus = $posessionStatusResi;
        }

        if ($availableFrom !== null) {
            $date = $availableFrom;
        } elseif ($available_date !== null) {
            $date = $available_date;
        } else {
            $date = $possessionDate;
        }

        if ($residentialAmenities !== null) {
            $amenities = $residentialAmenities;
        } elseif ($commerical_amenities !== null) {
            $amenities = $commerical_amenities;
        } else {
            $amenities = $explodeCommonAreas;
        }


        $propertyName = '';

        if ($propertyType == 'residential') {
            $propertyName .= 'Residential ';
        } else {
            $propertyName .= 'Commercial ';
        }


        if ($categoryType) {
            $propertyName .= $categoryType . ' ';
        }

        $propertyName .= $city . ' ';
        $propertyName .= $project . ' ';
        $propertyName .= $updateLocality . ' ';


        $propertyName .= $built_up_area . ' ';
        $propertyName .= $areaUnit . ' ';

        $propertyName .= $zoneType . ' ';
        $propertyName .= $locationHub . ' ';
        $propertyName .= $property . ' ';
        $uniqueIdentifier = uniqid();
        $propertyName .= $uniqueIdentifier;
        $propertyName = trim(preg_replace('/\s+/', ' ', $propertyName));
        $propertyName = implode(' ', array_slice(explode(' ', $propertyName), 0, 12));


        if ($lookingTo == 'pg') {
            $name = $PGname;
        } else {
            $name = $propertyName;
        }


        if ($ageOfProperty !== null) {
            $ageProperty = $ageOfProperty;
        } else {
            $ageProperty = $commAgeProperty;
        }



        $postImages = [];

        if ($request->hasFile('property_img')) {
            foreach ($request->file('property_img') as $image) {
                if ($image->isValid()) {
                    $originalExtension = $image->getClientOriginalExtension();
                    $newExtension = 'webp';
                    $sanitizedPropertyName = Str::slug($propertyName);
                    // $uniqueName = Str::random(4) . '.' . $newExtension;
                    $uniqueName = $sanitizedPropertyName . '-' . Str::random(4) . '.' . $newExtension;
                    $postImages[] = $uniqueName;
                    $imagePath = public_path('assets/postImages/' . $uniqueName);
                    $image->move(public_path('assets/postImages/'), $uniqueName);
                }
            }
        }

        $postImagesString = implode(',', $postImages);

        $postVideo = [];

        if ($request->hasFile('property_video')) {

            foreach ($request->file('property_video') as $video) {
                if ($video->isValid()) {
                    $sanitizedPropertyName = Str::slug($propertyName);
                    $uniqueVideoName = $sanitizedPropertyName . '-' . Str::random(4) . '.' . $video->getClientOriginalExtension();
                    $video->move(public_path('assets/postVideos'), $uniqueVideoName);
                    $postVideo[] = $uniqueVideoName;
                }
            }
        }

        $postVideosString = implode(',', $postVideo);





        $postProperty = [

            'reg_id' => $sessionID,
            'property_name' => $name,
            'property_type' => $propertyType,
            'looking_to' => $lookingTo,
            'categories' => $categoryType,
            'city' => $city,
            'project_society' => $project,
            'locality' => $updateLocality,
            'price' => $price,
            'security_deposity' => $security_deposit,
            'area_unit' => $areaUnit,
            'built_up_area' => $built_up_area,
            'carpet_area' => $carpetArea,
            'plot_area' => $plotArea,
            'width' => $width,
            'height' => $length,
            'total_property' => $property,
            'your_floor' => $yourFloor,
            'bath' => $bath,
            'balconies' => $balconies,
            'property_age' => $ageProperty,
            'possession_status' => $possessionStatus,
            'property_condition' => $propertyCondition,
            'possession_date' => $date,
            'zone_type' => $zoneType,
            'location_hub' => $locationHub,
            'located_near' => $explodeLocatedNear,
            'ownership' => $propertyOwner,
            'staircase' => $staircase,
            'passenger_lift' => $passengerLift,
            'service_lift' => $serviceLift,
            'private_parking' => $private_parking,
            'public_parking' => $public_parking,
            'private_washroom' => $private_washrooms,
            'public_washroom' => $public_washrooms,
            'conference_room' => $conferenceRoom,
            'min_seat' => $minSeat,
            'max_seat' => $maxSeat,
            'cabins' => $number_of_cabins,
            'meeting_room' => $meeting_rooms,
            'room_type' => $roomType,
            'bed_in_room' => $totalBedsRoom,
            'bathroom_style' => $explodePGBath,
            'pg_for' => $PGfor,
            'suited_for' => $suitedFor,
            'meal' => $meals,
            'meal_offering' => $explodeMealOffering,
            'meal_speciality' => $explodeMealSpeciality,
            'meal_charges' => $mealCharge,
            'electricity_charges' => $electricityChargesMonth,
            'notice_period' => $noticePeriod,
            'lock_in_period' => $lockPeriod,
            'manager_stay' => $staysProperty,
            'non_veg' => $nonVeg,
            'opposite_sex' => $PGsex,
            'any_time' => $anyTime,
            'visitors' => $visitorsAllowed,
            'guardian' => $guardianAllowed,
            'drink_smok' => $drinkSmok,
            'negotiable' => $negotiable,
            'dg_ups' => $dg_upsCharge,
            'electricity_charge' => $electricityChargeRadio,
            'water_charge' => $waterChargeRadio,
            'tax_govt' => $dg_upsCharge,
            'furnish_type' => $furnishType,
            'amenities' => $amenities,
            'images' => $postImagesString,
            'video' => $postVideosString,
            'status' => 'pending',
        ];

        $submitPostProperty = PostProperty::create($postProperty);

        if ($submitPostProperty) {

            $authenticated = User::find($sessionID);

            if ($authenticated) {
                if (session()->get('role') !== 'admin') {
                    $authenticated->status = 1;
                    $authenticated->role = 'vendor';
                    $authenticated->save();
                }

                $request->session()->put([
                    'id' => $authenticated->id,
                    'name' => $authenticated->name,
                    'phone' => $authenticated->phone,
                    'role' => $authenticated->role,
                    'image' => $authenticated->image,
                    'status' => $authenticated->status,
                ]);

                if (session()->get('role') == 'admin') {

                    return redirect()->route('admin.postProperty')->with('success', 'Admin success, Property submitted successfully!');
                }

                return redirect()->route('my.postProperty')->with('success', 'Property submitted successfully!');
            }
        }

        return redirect()->back()->withErrors(['message' => 'Your failure message here']);
    }

    public function index()
    {
        $title = "Explore Ghar ka sapna - Your Real Dream Site";
        $categories = PostProperty::pluck('categories')->unique();
        $location = PostProperty::pluck('city')->unique();
        $popularCitiesWithCounts = PostProperty::select('city', \DB::raw('COUNT(*) as property_count'))
            ->where('status', 'published')
            ->groupBy('city')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(8)
            ->get();

        $popularCities = $popularCitiesWithCounts->pluck('city');
        $propertyCounts = $popularCitiesWithCounts->pluck('property_count', 'city');
        $latestNews = NewsArticles::where('status', 'published')->orderBy('created_at', 'desc')->take(5)->get();
        $rentalProperties = PostProperty::where('status', 'published')->where('property_type', 'residential')->where('categories', '!=', 'plot')->take(3)->get();

        return view('Home.index', compact('title', 'categories', 'location', 'popularCities', 'propertyCounts', 'latestNews', 'rentalProperties'));
    }

    public function locationProperties(Request $request)
    {
        $city = $request->input('location');
        $lookingTo = $request->input('lookingTo');
        $type = $request->input('type');

        $query = PostProperty::where('status', 'published');

        if (!empty($city)) {
            $query->where('city', $city);
        }

        if (!empty($lookingTo)) {
            $query->where('looking_to', $lookingTo);
        }

        if ($lookingTo == 'pg') {
            $query->latest();
        } else {
            if (!empty($type)) {
                $query->where('categories', $type);
            }
        }


        $properties = $query->latest()->take(6)->get();


        if ($properties->isEmpty()) {
            return response()->json(['success' => false]);
        } else {
            return response()->json(['success' => true, 'properties' => $properties]);
        }
    }

    public function searchFilterIndex(Request $request)
    {
        $search = $request->input('search');
        $lookingTo = $request->input('lookingTo');
        $category = $request->input('type');
        $location = $request->input('location');


        $query = PostProperty::where('status', 'published')->where(function ($query) use ($search) {
            $query->where('property_name', 'like', "%{$search}%")
                ->orWhere('locality', 'like', "%{$search}%")
                ->orWhere('project_society', 'like', "%{$search}%")
                ->orWhere('categories', 'like', "%{$search}%")
                ->orWhere('pg_for', 'like', "%{$search}%")
                ->orWhere('suited_for', 'like', "%{$search}%")
                ->orWhere('looking_to', 'like', "%{$search}%")
                ->orWhere('room_type', 'like', "%{$search}%");
        });

        if ($location) {
            $query->where('city', $location);
        }
        if ($lookingTo) {
            $query->where('looking_to', $lookingTo);
        }

        if ($lookingTo != 'pg') {
            if ($category) {
                $query->where('categories', $category);
            }
        }

        $results = $query->get();

        if ($results) {
            return response()->json(['success' => true, 'results' => $results]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    public function allListing($id, $name)
    {
        $Id = base64_decode($id);
        $decodeName = base64_decode($name);
        $title = "All listing - Ghar ka sapna";

        if (request()->segment(1) == 'project-list') {

            $findId = PostProperty::find($Id);

            if ($findId) {
                if ($findId->looking_to == 'pg') {
                    $pageTitle = "Discover Exclusive Paying Guest Services in " . $findId->city;
                    $properties = PostProperty::where('city', $findId->city)->where('looking_to', $findId->looking_to)->where('status', 'published')->orderBy('created_at', 'desc')->paginate(15);
                }
                $pageTitle = 'Properties in ' . $findId->city;
                $properties = PostProperty::where('city', $findId->city)->where('looking_to', $findId->looking_to)->where('categories', $findId->categories)->where('status', 'published')->orderBy('created_at', 'desc')->paginate(15);
            } else {
                $properties = collect();
            }
        }

        if (request()->segment(1) == 'project-city') {
            $pageTitle = 'Properties in ' . $Id;
            $properties = PostProperty::where('status', 'published')->where('city', $Id)->where('looking_to', '!=', 'pg')->orderBy('created_at', 'desc')->paginate(30);
        }

        if (request()->segment(1) == 'project-cat') {

            $pageTitle = "Available Properties in $Id Your Ideal $Id Awaits";
            $properties = PostProperty::where('status', 'published')->where('categories', $Id)->orderBy('created_at', 'desc')->paginate(30);
        }

        if (request()->segment(1) == 'PG-Co-Living') {

            $pageTitle = "Available Paying Guest Accommodations | Find Your Ideal PG";
            $properties = PostProperty::where('status', 'published')->where('looking_to', 'pg')->orderBy('created_at', 'desc')->paginate(30);
        }

        if (request()->segment(1) == 'paying-guest') {
            $pageTitle = "Available Properties in $Id Your Ideal $Id Awaits";
            $properties = PostProperty::where('status', 'published')->where('looking_to', 'pg')->where('city', $Id)->orderBy('created_at', 'desc')->paginate(30);
        }

        if (request()->segment(1) == 'project-cat-prop') {

            //$decodedValues  = $this->setStrings($name);
            $catParts = explode('plus', $name);
            $catType = $catParts[0];
            $catLook = $catParts[1];
            $decodeType = base64_decode($catType);
            $decodeLook = base64_decode($catLook);
            $pageTitle = "All Properties in $Id for $decodeLook - $decodeType";

            $properties = PostProperty::where('status', 'published')->where('looking_to', $decodeLook)->where('city', $Id)->where('categories', $decodeType)->orderBy('created_at', 'desc')->paginate(30);
        }

        if (request()->segment(1) == 'paying-living') {

            $pageTitle = "PG/Co-Living for $Id";
            $properties = PostProperty::where('status', 'published')->where('looking_to', 'pg')->where('pg_for', $Id)->orderBy('created_at', 'desc')->paginate(30);
        }

        if (request()->segment(1) == 'paying-guests-search') {
            $pageTitle = '';
            $properties = PostProperty::where('status', 'published')->where('looking_to', 'pg')->where('room_type', $Id)->orderBy('created_at', 'desc')->paginate(30);
        }

        $popularCities = PostProperty::select('city')->groupBy('city')->orderByRaw('COUNT(*) DESC')->limit(12)->pluck('city');
        $propertyType = PostProperty::pluck('categories')->unique();
        return view('Home.all_listing', compact('title', 'properties', 'popularCities', 'propertyType', 'pageTitle'));
    }


    public function singlePropertyListing($id, $name)
    {
        $Id = base64_decode($id);
        $propertyName = base64_decode($name);
        $sessionID = session()->get('id');

        $title = $propertyName . " Ghar Ka Sapna Admin";
        $property = PostProperty::where('id', $Id)->first();
        $nearbySimilarHomes = PostProperty::where('city', $property->city)->where('looking_to', $property->looking_to)->where('property_type', $property->property_type)->where('categories', $property->categories)->where('status', 'published')->where('id', '!=', $property->id)->take(7)->get();
        $userHasReviewed = PropertyReviews::where('property_id', $property->id)->where('user_id', $sessionID)->exists();
        $propertiesReview = PropertyReviews::where('property_id', $property->id)->get();
        $propertyIds = $propertiesReview->pluck('property_id')->toArray();
        $favProperty = FavProperty::where('property_id', $property->id)->where('user_id', $sessionID)->first();

        return view('Home.single_property_listing', compact('title', 'property', 'nearbySimilarHomes', 'userHasReviewed', 'propertiesReview', 'favProperty'));
    }

    public function insertReview(Request $request)
    {
        $rating = $request->input('rating');
        $vendorId = $request->input('vendor_id');
        $propertyId = $request->input('property_id');
        $comment = $request->input('comment');
        $sessionID = session()->get('id');

        $review = PropertyReviews::create([
            'user_id' => $sessionID,
            'vendor_id' => $vendorId,
            'property_id' => $propertyId,
            'rating' => $rating,
            'comment' => $comment,
            'status' => 'pending'
        ]);

        if ($review) {
            return redirect()->back()->with('success', 'Review added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add Review. Please try again.');
        }
    }


    public function addToFavProperty(Request $request)
    {

        $sessionID = session()->get('id');
        $propertyId = $request->input('propertyId');

        $existingLike = FavProperty::where('user_id', $sessionID)->where('property_id', $propertyId)->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'removed'], 200);
        }

        $add = FavProperty::create([
            'user_id' => $sessionID,
            'property_id' => $propertyId
        ]);

        return response()->json(['message' => 'success'], 200);
    }

    public function allListingFilters(Request $request)
    {
        $lookingTo = strtolower($request->input('lookingTo'));
        $type = strtolower($request->input('type'));
        $suitedFor = strtolower($request->input('suitedFor'));
        $city = strtolower($request->input('location'));
        $plotArea = $request->input('plotArea');
        $roomType = strtolower($request->input('roomType'));
        $bedRoom = $request->input('bedRoom');
        $bath = $request->input('bathRoom');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minSqFt = $request->input('minSqFt');
        $maxSqFt = $request->input('maxSqFt');
        $meals = $request->input('meals');

        $query = PostProperty::where('status', 'published');

        if ($lookingTo == 'pg') {

            if ($lookingTo) {
                $query->where('looking_to', 'like', "pg");
            }

            if ($city != 'all cities') {
                $query->where('city', 'like', "%{$city}%");
            }

            if ($suitedFor != 'gender') {
                $query->where('pg_for', 'like', "%{$suitedFor}%");
            }

            if ($roomType != 'room type') {
                $query->where('room_type', 'like', "%{$roomType}%");
            }

            if ($meals) {
                $query->where('meal', 'like', "%{$meals}%");
            }

            if ($minPrice !== null) {
                $query->where('price', '>=', $minPrice);
            }
            if ($maxPrice !== null) {
                $query->where('price', '<=', $maxPrice);
            }
        }

        if (in_array($type, ['apartment', 'independent floor', 'independent house'])) {

            if ($city != 'all cities') {
                $query->where('city', 'like', "%{$city}%");
            }

            if ($type != 'property') {
                $query->where('categories', 'like', "%{$type}%");
            }

            if ($bath) {
                $query->where('bath', 'like', "%{$bath}%");
            }

            if ($bedRoom) {
                $query->where('total_property', 'like', "{$bedRoom}");
            }

            if ($lookingTo != 'looking to') {

                $query->where('looking_to', 'like', "%{$lookingTo}%");
            }

            if ($minPrice !== null) {
                $query->where('price', '>=', $minPrice);
            }
            if ($maxPrice !== null) {
                $query->where('price', '<=', $maxPrice);
            }

            if ($maxSqFt) {
                $query->where('built_up_area', '<=', $maxSqFt);
            }

            if ($minSqFt) {
                $query->where('built_up_area', '>=', $minSqFt);
            }
        }

        if (in_array($type, ['retail shop', 'showroom', 'warehouse'])) {

            if ($city != 'all cities') {
                $query->where('city', 'like', "%{$city}%");
            }

            if ($type) {
                $query->where('categories', 'like', "%{$type}%");
            }

            if ($minPrice !== null) {
                $query->where('price', '>=', $minPrice);
            }
            if ($maxPrice !== null) {
                $query->where('price', '<=', $maxPrice);
            }

            if ($bath) {
                $query->where('carpet_area', $bath);
            }

            if ($bedRoom) {
                $query->where('total_property', 'like', "{$bedRoom}");
            }

            if ($maxSqFt) {
                $query->where('built_up_area', '<=', $maxSqFt);
            }

            if ($minSqFt) {
                $query->where('built_up_area', '>=', $minSqFt);
            }
        }

        if ($type == 'office') {

            if ($city != 'all cities') {
                $query->where('city', 'like', "%{$city}%");
            }

            if ($type) {
                $query->where('categories', 'like', "office");
            }

            if ($bath) {
                $query->where('max_seat', '<=', $bath);
            }

            if ($bedRoom) {
                $query->where('min_seat', '>=', $bedRoom);
            }

            if ($lookingTo != 'looking to') {
                $query->where('looking_to', 'like', "%{$lookingTo}%");
            }

            if ($minPrice !== null) {
                $query->where('price', '>=', $minPrice);
            }
            if ($maxPrice !== null) {
                $query->where('price', '<=', $maxPrice);
            }

            if ($maxSqFt) {
                $query->where('built_up_area', '<=', $maxSqFt);
            }

            if ($minSqFt) {
                $query->where('built_up_area', '>=', $minSqFt);
            }
        }

        if ($type == 'plot') {

            if ($city != 'all cities') {
                $query->where('city', 'like', "%{$city}%");
            }

            if ($type) {
                $query->where('categories', 'like', "plot");
            }

            if ($plotArea) {
                $query->where('plot_area', $plotArea);
            }

            if ($lookingTo != 'looking to') {
                $query->where('looking_to', 'like', "%{$lookingTo}%");
            }


            if ($minPrice !== null) {
                $query->where('price', '>=', $minPrice);
            }
            if ($maxPrice !== null) {
                $query->where('price', '<=', $maxPrice);
            }
        }

        $results = $query->get();

        if ($results->isNotEmpty()) {
            return response()->json(['success' => true, 'results' => $results]);
        } else {
            return response()->json(['success' => false, 'message' => 'No properties found']);
        }
    }
}
