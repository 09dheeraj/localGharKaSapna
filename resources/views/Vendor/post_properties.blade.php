@extends('layouts.inner_page')
@section('content')

<?php

function formatPrice($price)
{
    if (!is_numeric($price)) {
        return 'N/A';
    }

    if ($price >= 10000000) {
        return '₹' . number_format($price / 10000000, 2) . ' Cr';
    } elseif ($price >= 100000) {
        return '₹' . number_format($price / 100000, 2) . ' Lac';
    } else {
        return '₹' . number_format($price / 1000, 2) . ' K';
    }
}



?>

<div class="row align-items-center pb40">
    <div class="col-xxl-3">
        <div class="dashboard_title_area">
            <h2>My Properties</h2>
            <p class="text">We are glad to see you again!</p>
        </div>
    </div>
    <div class="col-xxl-9">
        <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
            <div class="item1 mb15-sm">
                <div class="search_area">
                    <input type="text" class="form-control bdrs12" placeholder="Search">
                    <label><span class="flaticon-search"></span></label>
                </div>
            </div>

            <a href="{{route('post.property')}}" class="ud-btn btn-thm">Add New Property<i class="fal fa-arrow-right-long"></i></a>
        </div>
    </div>

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

</div>
<div class="row">
    <div class="col-xl-12">
        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
            <div class="packages_table table-responsive">
                <table class="table-style3 table at-savesearch">
                    <thead class="t-head">
                        <tr>
                            <th scope="col">Listing title</th>
                            <th scope="col">Date Published</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="t-body">
                        @foreach($properties as $property)
                        <tr>
                            <th scope="row">
                                <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
                                    @php $image = explode(',', $property->images); @endphp
                                    <div class="list-thumb">
                                        @foreach($image as $img)
                                        <img class="w-100" src="{{asset('public/assets/postImages/' . $img)}}" alt="">
                                        @break
                                        @endforeach
                                    </div>
                                    <div class="list-content py-0 p-0 mt-2 mt-xxl-0 ps-xxl-4">
                                        <div class="h6 list-title"><a target="_blank" href="{{route('single', ['name' => base64_encode($property->property_name), 'id' => base64_encode($property->id)])}}">{{substr($property->property_name, 0, strrpos($property->property_name, ' '))}}</a></div>
                                        <p class="list-text mb-0">{{ ucwords($property['project_society']) }}, {{ ucwords($property['locality']) }}, {{ ucwords($property['city']) }}</p>
                                        <div class="list-price">{{formatPrice($property->price)}} {!! $property->looking_to == 'sell' ? '' : '/<span>mo</span>' !!}</div>
                                    </div>
                                </div>
                            </th>

                            <?php
                            $dateString = $property->created_at;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('M d, Y');
                            ?>
                            <td class="vam">{{$formattedDate}}</td>
                       
                            <td class="vam"><span class="pending-style style1">{{ucfirst($property->status)}}</span></td>
                            <td class="vam">
                                <div class="d-flex">
                                    <a target = "_blank" href="{{route('edit.postProperty', ['id' =>  base64_encode($property->id), 'name' => base64_encode($property->property_name)])}}" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
                                    <a href="" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mbp_pagination text-center">
                    <ul class="page_navigation">
                        {{ $properties->links() }}
                    </ul>
                    <p class="mt10 pagination_page_count text-center">{{ $properties->firstItem() }} - {{ $properties->lastItem() }} of {{ $properties->total() }} property available</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection