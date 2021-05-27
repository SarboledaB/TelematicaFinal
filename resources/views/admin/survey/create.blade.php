@extends('layouts.app')

@section("title", $data["title"])

@section('content')
<section class="page-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('util.message')
                <div class="card">
                    <div class="card-header">@lang('survey.survey')</div>
                    <div class="card-body">
                        @if($errors->any())
                        <ul id="errors">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <form class="form-group" method="POST" action="{{ route('admin.survey.save') }}" enctype="multipart/form-data">
                            @csrf
                            <label>@lang('survey.name')</label>
                            <input class="form-control" type="text" placeholder="@lang('survey.entername')" name="name" value="{{ old('name') }}" required />
                            <br>
                            <label>@lang('survey.commune')</label>
                            <select class="form-select form-control" name="commune" value="0" required>
                                <option value="0">@lang('survey.undefined')</option>
                                <option value="1">@lang('survey.commune') 1</option>
                                <option value="2">@lang('survey.commune') 2</option>
                                <option value="3">@lang('survey.commune') 3</option>
                                <option value="4">@lang('survey.commune') 4</option>
                                <option value="5">@lang('survey.commune') 5</option>
                                <option value="6">@lang('survey.commune') 6</option>
                                <option value="7">@lang('survey.commune') 7</option>
                                <option value="8">@lang('survey.commune') 8</option>
                                <option value="9">@lang('survey.commune') 9</option>
                                <option value="10">@lang('survey.commune') 10</option>
                            </select>
                            <br>
                            <label>@lang('survey.career')</label>
                            <select class="form-select form-control" name="career" value="0" required>
                                <option value="0">@lang('survey.undefined')</option>
                                <option value="1">@lang('survey.medicine')</option>
                                <option value="2">@lang('survey.ing')</option>
                                <option value="3">@lang('survey.advocacy')</option>
                                <option value="4">@lang('survey.degree')</option>
                            </select>
                            <br>
                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="@lang('survey.save')" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection