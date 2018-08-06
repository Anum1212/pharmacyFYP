@extends('layouts.siteLayout') 
@section('tabTitle', $product->name .' Details') 
@section('head')
<link href="{{ asset('css/siteView/rated.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/table.css')}}">
@endsection
 
@section('style')
@endsection
 
@section('body')

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
                <div class="w-size13 p-t-30 respon5">
                        <div class="wrap-slick3 flex-sb flex-w">
                                {{-- needed for adjustment --}}
                                <div></div>

                                <div class="slick3">
                                        <div class="item-slick3">
                                                <div class="wrap-pic-w">
                                                        @if($product->type=='1')
                                                        <!-- 1 = Tablet -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/tablet.png') }}>                                                        @elseif($product->type=='2')
                                                        <!-- 2 = Capsule -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/capsule.png') }}>                                                        @elseif($product->type=='3')
                                                        <!-- 3 = Syrup -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/syrup.png') }}>                                                        @elseif($product->type=='4')
                                                        <!-- 4 = Inhaler -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/inhaler.png') }}>                                                        @elseif($product->type=='5')
                                                        <!-- 5 = Drops -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/drops.png') }}>                                                        @elseif($product->type=='6')
                                                        <!-- 6 = Injection -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/injection.png') }}>                                                        @elseif($product->type=='7')
                                                        <!-- 7 = Cream -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/cream.png') }}>                                                        @elseif($product->type=='8')
                                                        <!-- 7 = Cream -->
                                                        <img class="img-responsive" style="height:200px; width:200px" src={{ asset( 'storage/myAssets/others.png') }}>                                                        @endif

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <div class="w-size14 p-t-30 respon5">
                        <h4 class="product-detail-name m-text16 p-b-13">
                                {{ $product->name }}
                                <br> {{ $product->genericName }}
                        </h4>

                        <span class="m-text17">
                                Rs {{ $product->price }}
                        </span>

                        <p class="s-text8 p-t-10">
                                @if($product->type=='1')
                                <!-- 1 = Tablet -->
                                Type: Tablet {{ $product->tablets }} tbs @elseif($product->type=='2')
                                <!-- 2 = Capsule -->
                                Type: Capsule {{ $product->tablets }} tbs @elseif($product->type=='3')
                                <!-- 3 = Syrup -->
                                Type: Syrup @elseif($product->type=='4')
                                <!-- 4 = Inhaler -->
                                Type: Inhaler @elseif($product->type=='5')
                                <!-- 5 = Drops -->
                                Type: Drops @elseif($product->type=='6')
                                <!-- 6 = Injection -->
                                Type: Injection @elseif($product->type=='7')
                                <!-- 7 = Cream -->
                                Type: Cream @elseif($product->type=='8')
                                <!-- 7 = Cream -->
                                Type: Others @endif
                                <br> @if($product->type=='1' || $product->type=='2' || $product->type=='7')
                                <!-- 1 = Tablet -->
                                Dosage: {{ $product->dosage }} mg @elseif($product->type=='8') Dosage/Weight: @else Dosage: {{ $product->dosage }}
                                ml @endif
                                <br> @if($product->prescription=='1')
                                <span style="color:red"> Prescription Required </span> @endif
                                <br> Manufacturer:
                                <span style="color:brown; font-weight:bold">{{ $product->manufacturer }}</span>
                                <br> Sold By:
                                <a href="/pharmacyDetails/{{ $pharmacyDetails->id }}/{{ $product->id }}">
                                        <span style="color:brown; font-weight:bold">{{$pharmacyDetails->pharmacyName}} </span>
                                </a>
                                <fieldset class="rating">
                                        <input disabled <?php if($pharmacyRating->rating=="5") echo 'checked="checked"';
                                        ?> type="radio" id="star5" name="rating" value="5" />
                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="4.5") echo 'checked="checked"';
                                        ?> type="radio" id="star4half" name="rating" value="4.5" />
                                        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="4") echo 'checked="checked"';
                                        ?> type="radio" id="star4" name="rating" value="4" />
                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="3.5") echo 'checked="checked"';
                                        ?> type="radio" id="star3half" name="rating" value="3.5" />
                                        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="3") echo 'checked="checked"';
                                        ?> type="radio" id="star3" name="rating" value="3" />
                                        <label class="full" for="star3" title="Meh - 3 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="2.5") echo 'checked="checked"';
                                        ?> type="radio" id="star2half" name="rating" value="2.5" />
                                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="2") echo 'checked="checked"';
                                        ?> type="radio" id="star2" name="rating" value="2" />
                                        <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="1.5") echo 'checked="checked"';
                                        ?> type="radio" id="star1half" name="rating" value="1.5" />
                                        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="1") echo 'checked="checked"';
                                        ?> type="radio" id="star1" name="rating" value="1" />
                                        <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input disabled <?php if($pharmacyRating->rating=="0.5") echo 'checked="checked"';
                                        ?> type="radio" id="starhalf" name="rating" value="0.5" />
                                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                                <br>
                        </p>

                        <div class="p-b-45">
                                <span class="s-text8">Category: 
                                        @if($product->category=='category1')
                                        <!-- 1 = Medicine -->
                                        Medicine 
                                        @elseif($product->category=='category2')
                                        <!-- 2 = Proteins and Suppliments -->
                                        Proteins and Suppliments 
                                        @elseif($product->category=='category3')
                                        <!-- 3 = Baby and Mom  -->
                                        Baby and Mom 
                                        @elseif($product->category=='category4')
                                        <!-- 4 = Beauty  -->
                                        Beauty 
                                        @elseif($product->category=='category5')
                                        <!-- 5 = HouseHold -->
                                        HouseHold 
                                        @elseif($product->category=='category6')
                                        <!-- 6 = Others -->
                                        Others 
                                        @endif </span>
                        </div>

                        <!-- Add to cart button  -->
                        <div class="p-t-33 p-b-60">

                                <div class="flex-r-m flex-w p-t-10">
                                        <div class="w-size16 flex-m flex-w">

                                                <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                                        @if($product->quantity == 0)
                                                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" disabled>Out of stock</button>
                                                        <!-- Button out of stock -->
                                                        @else
                                                        <!-- Button add to cart-->
                                                        <a href="/addToCart/{{ $product->id }}/{{ $product->pharmacistId }}" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>                                                        @endif
                                                </div>
                                        </div>
                                </div>
                        </div>

                </div>
        </div>


        <!-- Medicine Strength and Forms -->
        @if(isset($strengthAndFroms))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Medicine Strength and Forms
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>

                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <table>
                                <thead>
                                        <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Form And Strenght</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        @for ($i = 0; $i
                                        <$size; $i++) <tr>
                                                <td data-label="#">{{ $i+1 }}</td>
                                                <td data-label="Type">{{str_replace("(","",substr_replace($strengthAndFroms['name'][$i],"",-1))}}</td>
                                                <td data-label="FormAndStrenght">{{str_replace("(","",$strengthAndFroms['detail'][$i][0])}}</td>
                                                </tr>
                                                @endfor
                                </tbody>
                        </table>
                </div>
        </div>
        @endif

        <!-- Purpose Of Usage -->
        @if(isset($sideEffects->results[0]->purpose[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Purpose Of Usage
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->purpose[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Indications to Use -->
        @if(isset($sideEffects->results[0]->indications_and_usage[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Indications to Use
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->indications_and_usage[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Active Ingredients -->
        @if(isset($sideEffects->results[0]->active_ingredient[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Active Ingredients
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->active_ingredient[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Be carefull To Use -->
        @if(isset($sideEffects->results[0]->when_using[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Be carefull To Use
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->when_using[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Warning -->
        @if(isset($sideEffects->results[0]->warnings[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Warning
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->warnings[0] }}
                        </p>
                </div>
        </div>

        @endif

        <!-- Do not Use When -->
        @if(isset($sideEffects->results[0]->do_not_use[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Do not Use When
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->do_not_use[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Dosage Advice -->
        @if(isset($sideEffects->results[0]->dosage_and_administration[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Dosage Advice
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->dosage_and_administration[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Nursing Mother Advice -->
        @if(isset($sideEffects->results[0]->nursing_mothers[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Nursing Mother Advice
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->nursing_mothers[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Adverse reactions -->
        @if(isset($sideEffects->results[0]->adverse_reactions[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Adverse reactions
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->adverse_reactions[0] }}
                        </p>
                </div>
        </div>
        @endif

        <!-- Overdose Results -->
        @if(isset($sideEffects->results[0]->overdosage[0]))
        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
                <h5 class="text-center js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Overdose Results
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                                {{ $sideEffects->results[0]->overdosage[0] }}
                        </p>
                </div>
        </div>
        @endif

</div>
@endsection
 
@section('script')
@endsection