    <div class="container searchDiv">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 colxs-12">
                    <div id="imaginary_container">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" id="address" placeholder="Enter an Address" @if(session()->has('formatedAddress')) value="{{ session('formatedAddress') }}" @endif>
                            <span class="detectLocationAddon input-group-addon">
                                <button type="button" onclick="getLocation()" class="detectLocation">
                                    <span class="fa fa-bullseye"></span>
                                </button>
                            </span>
                            <span class="input-group-addon">
                                <button type="botton" onclick="addressToCoOrdinates()">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 medicineForm">
                <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <form class="form-horizontal" action="/searchMedicine" method="get">
                        <div class="form-group">
                            <input id="medicineSearched" name="medicineSearched" type="text" class="form-control" placeholder="Medicine" @if(session()->has('medicineSearched')) value="{{ session('medicineSearched') }}" @endif required>
                        </div>
                        <div class="form-group">
                            <input id="distance" name="distance" type="number" class="form-control" placeholder="Search Radius" @if(session()->has('distance')) value="{{ session('distance') }}" @else value="10" @endif required>
                        </div>
                        <button type="submit" class="btn btn-primary search">Search</button>
                        <br>
                        <br>
                        <input type="text" name="formatedAddress" id="formatedAddress" value="" style="display:none">
                        <input type="text" name="latitude" id="lat" value="" style="display:none">
                        <input type="text" name="longitude" id="lng" value="" style="display:none">
                    </form>
                </div> {{-- medicineForm col --}}
            </div> {{-- medicineForm --}}
        </div> {{-- row --}}
    </div> {{-- Container --}}