@extends('layouts.siteView') @section('style')
<style>
        @import url('https://fonts.googleapis.com/css?family=Markazi+Text|Roboto');
        
        .heading{
                font-size: 4em;
                color: #337AB7;
                padding: 55px;
                margin: auto;
        }

        .StrengthAndForms{
                text-transform:lowercase;
                font-family: 'Roboto', sans-serif;
        }
        
        .sideEffectsHeading{
               font-size: 2.6em;
               font-weight: bold;
        }
        .sideEffectsBody {
                max-height: 400px;
                overflow: auto;
                word-spacing: 10px;
                font-size: 1.6em;
                font-family: 'Markazi Text', serif;
        }
        .gap{
                margin-top: 45px
        }
</style>
@endsection 


@section('body')
<div class="container">
        <div class="row">
                <div class="col-md-12 heading text-center">
                Medicine Details
                </div>
                <div class="col-md-12">
                        <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                        Medicine Strength and Forms
                                </div>
                                <div class="panel-body StrengthAndForms">
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
                </div>
                @if(isset($sideEffects->results[0]->purpose[0]))
                <div class="col-md-12 row gap">
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Purpose Of Usage
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->purpose[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Indications to Use
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->indications_and_usage[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Be carefull To Use
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->when_using[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Warning
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->warnings[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Active Ingredients
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->active_ingredient[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Do not Use When
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->do_not_use[0]}}
                                        </div>
                                </div>
                        </div>
                        @else
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Adverse reactions
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->adverse_reactions[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Overdose Results
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->overdosage[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Nursing Mother Advice
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->nursing_mothers[0]}}
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-12 gap">
                                <div class="panel panel-primary">
                                        <div class="panel-heading text-center sideEffectsHeading">
                                                Dosage Advice
                                        </div>
                                        <div class="panel-body sideEffectsBody">
                                                {{$sideEffects->results[0]->dosage_and_administration[0]}}
                                        </div>
                                </div>
                        </div>
                </div>
                @endif

        </div>
        <!--/.row-->
</div>
@endsection