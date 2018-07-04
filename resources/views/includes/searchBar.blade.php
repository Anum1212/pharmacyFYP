    <div class="container searchDiv">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-7 align-self-center">
                    <div id="imaginary_container">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" id="address" placeholder="Enter Location" @if(session()->has('formatedAddress')) value="{{ session('formatedAddress') }}" @endif>
                            <span class="detectLocationAddon input-group-addon">
                                <button type="button" onclick="getLocation()" class="detectLocation">
                                    <span class="fa fa-bullseye" style="color: red;"></span>
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
            <div class="col-12 col-md-7 align-self-center medicineForm">
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
                        <input type="text" name="formatedAddress" id="formatedAddress" @if(session()->has('formatedAddress')) value="{{ session('formatedAddress') }}" @endif style="display:none">
                        <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
                    </form>
            </div> {{-- medicineForm --}}
        </div> {{-- row --}}
    </div> {{-- Container --}}