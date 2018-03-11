<?php

namespace App\ Http\ Controllers;

use Illuminate\ Http\ Request;
use Bodunde\ GoogleGeocoder\ Geocoder;
use DB;
use Geocode;

class testController extends Controller {
  public function index() {
    echo "this is a test route for testing prototype methods before writing them in actual code";
  }
}