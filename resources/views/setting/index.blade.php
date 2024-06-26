@include('includes/header')
<body>
@include('includes/navbar')
<!-- Main content -->
<div class="container">
    <div class="page-heading">
        <div class="heading-content">
            <div class="user-image">
                @if(empty($user->avatar))
                <img src="{{ asset('assets/images/avatar.png') }}" class="img-circle img-responsive">
                @else
                <img src="{{ asset('uploads/avatar/'.$user->avatar) }}" class="img-circle img-responsive">
                @endif
            </div>
            <div class="heading-title">
                <h2>{{__('settings.heading.welcome')}}, {{$user->fname}} {{$user->lname}}</h2>
                <p>{{__('settings.heading.intro')}}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="settings-menu">
              <nav class="navbar">
                <ul class="nav navbar-nav">
                  <li ><a data-toggle="tab" href="#profile"><span><i class="mdi mdi-account"></i></span>  {{__('settings.side-menu.profile')}}</a></li>
                  <li class="active"><a data-toggle="tab" href="#categories"><span><i class="mdi mdi-theme-light-dark"></i></span>  {{__('settings.side-menu.categories')}}</a></li>
                  {{-- @if ( $user->role == "admin" ) 
                  <li><a data-toggle="tab" href="#system"><span><i class="mdi mdi-settings"></i></span>  {{__('settings.side-menu.system')}}</a></li>
                  @endif
                  <li><a data-toggle="tab" href="#security"><span><i class="mdi mdi-lock"></i></span>  {{__('settings.side-menu.security')}}</a></li> --}}
                </ul>
            </nav>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
              <div class="card-body p-zero">
                
                        <div class="tab-content settings">
                            <div class="row">
                                <div class="col-md-12">
                                  <div id="profile" class="tab-pane fade ">
                                        <h3>{{__('settings.profile-form.title')}}</h3>
                                        <p class="text-muted text-thin">{{__('settings.profile-form.intro')}}</p>
                                        <form class="simcy-form" action="{{ url('Settings@updateprofile')}}" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.profile-form.label.picture')}}</label>
                                                          @if( !empty($user->avatar) )
                                                          <input type="file" name="avatar" class="croppie" default="{{ url('') }}uploads/avatar/{{ $user->avatar }}" crop-width="200" crop-height="200" accept="image/*">
                                                          @else
                                                          <input type="file" name="avatar" class="croppie" crop-width="200" crop-height="200" accept="image/*">
                                                          @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.profile-form.label.first-name')}}</label>
                                                        <input type="text" class="form-control" name="fname" value="{{ $user->fname }}" placeholder="{{__('settings.profile-form.placeholder.first-name')}}" required>
                                                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.profile-form.label.last-name')}}</label>
                                                        <input type="text" class="form-control" name="lname" value="{{ $user->lname }}" placeholder="{{__('settings.profile-form.placeholder.last-name')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.profile-form.label.email')}}</label>
                                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="{{__('settings.profile-form.placeholder.email')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.profile-form.label.phone')}}</label>
                                                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="{{__('settings.profile-form.placeholder.phone')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.profile-form.label.address')}}</label>
                                                        <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="{{__('settings.profile-form.placeholder.address')}}">
                                                    </div>
                                                </div>
                                            </div>
                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label>{{__('settings.profile-form.label.currency')}}</label>
                                                  <select class="form-control select2" name="currency" required="">
                                                    @foreach ( $currencies as $currency )
                                                    <option value="{{ $currency->code }}" @if( $currency->code == $user->currency ) selected @endif>{{ $currency->name }} - {{ $currency->code }}</option>
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <label>{{__('settings.profile-form.label.timezone')}}</label>
                                                  <select class="form-control select2" name="timezone" required="">
                                                    @foreach ( $timezones as $timezone )
                                                    <option value="{{ $timezone->zone }}" @if( $timezone->zone == $user->timezone ) selected @endif>{{ $timezone->name }}</option>
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        @if ( env('APP_ENV') == "demo" )
                                                            <button class="btn btn-primary" type="submit" disabled>{{__('settings.button.save')}}</button>
                                                        @else
                                                            <button class="btn btn-primary" type="submit">{{__('settings.button.save')}}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                  </div>
                                  <div id="categories" class="tab-pane in active">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>{{__('settings.category-table.title')}}</h3>
                                            <p class="text-muted text-thin">{{__('settings.category-table.intro')}}</p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#create"><span><i class="mdi mdi-plus-circle-outline"></i></span>  {{__('settings.button.add-category')}}</button>
                                        </div>
                                    </div>
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th class="text-center">{{__('settings.category-table.number')}}</th>
                                          <th>{{__('settings.category-table.category-name')}}</th>
                                          <th></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                     
                                        @if(!empty($categories))
                                           @foreach($categories as $key => $category)
                                            <tr>
                                            <td class="text-center"><label class="badge">{{ $key + 1}}</label></td>
                                            <td><strong>{{ $category->name }}</strong><br>
                                                @if( $category->type == "Income" )
                                                    {{  __('pages.options.income') }}
                                                @else
                                                    {{   __('pages.options.expense') }}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{__('settings.category-table.actions')}} <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                        
                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('setting.destroy', $category->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="hidden" name="categoryid"
                                                                value="{{ $category->id }}">
                                                            <button type="submit"
                                                                onclick="return confirm('Bạn có chắc muốn xóa hạng mục này?')"
                                                                class="send-to-server-click btn-delete"
                                                                data="categoryid:{{ $category->id }}"
                                                                loader="true">
                                                                <i class="mdi mdi-delete"
                                                                    style="margin-right: 10px;"></i>
                                                                {{ __('expenses.expense-table.delete') }}
                                                            </button>
                                                        </form>
                                                        {{-- <a href="{{ route('income.destroy', $Income->id) }}" class="c-dropdown__item dropdown-item fetch-display-click btn-delete" onclick="return confirm('Bạn có chắc muốn xóa khoản thu này?')">
                                      <i class="mdi mdi-delete"></i> {{ __('income.income-table.delete') }}
                                    </a> --}}

                                                    </li>
                                                </ul>
                                            </div>
                                            </td>
                                            </tr>
                                           @endforeach
                                        @else
                                        <tr class="text-center"><td colspan="3">{{__('settings.category-table.empty')}}</td></tr>
                                        @endif
                                      </tbody>
                                    </table>
                                  
                                  </div>
                                  <div id="system" class="tab-pane fade">
                                    <h3>{{__('settings.system-form.title')}}</h3>
                                    <p class="text-muted text-thin">{{__('settings.system-form.intro')}}</p>

                                    <form class="simcy-form" action="{{ url('Settings@updatesystem')}}" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" value="{{ csrf_token() }}" name="csrf-token">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.name')}}</label>
                                                    <input type="text" class="form-control system-name" placeholder="System name" name="APP_NAME" value="{{ env('APP_NAME') }}" required>
                                                    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.logo')}}</label>
                                                    <input type="file" name="APP_LOGO" class="croppie" default="{{ asset('uploads/app/'.env('APP_LOGO')) }}" crop-width="326" crop-height="78" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.favicon')}}</label>
                                                    <input type="file" name="APP_ICON" class="croppie" default="{{ asset('uploads/app/'.env('APP_ICON')) }}" crop-width="66" crop-height="66" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.smtp-user')}}</label>
                                                    <input type="text" class="form-control" name="MAIL_USERNAME" placeholder="{{__('settings.system-form.label.smtp-user')}}" value="{{ env('MAIL_USERNAME') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.smtp-sender')}}</label>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.smtp-host')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{__('settings.system-form.label.smtp-host')}}" name="SMTP_HOST" value="{{ env('SMTP_HOST') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.smtp-port')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{__('settings.system-form.label.smtp-port')}} name="SMTP_PORT" value="{{ env('SMTP_PORT') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.smtp-password')}}</label>
                                                    <input type="password" class="form-control" placeholder="{{__('settings.system-form.label.smtp-password')}}" name="SMTP_PASSWORD" value="{{ env('SMTP_PASSWORD') }}" autocomplete="false" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{__('settings.system-form.label.smtp-encryption')}}</label>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>
                                                    @if ( env('SMTP_AUTH') == "Enabled" ) 
                                                    <input type="checkbox" class="switch" name="SMTP_AUTH" value="true" checked />
                                                    @else
                                                    <input type="checkbox" class="switch" name="SMTP_AUTH" value="true" />
                                                    @endif
                                                    {{__('settings.system-form.label.smtp-auth')}}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="divider"></div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>
                                                    @if ( env('NEW_ACCOUNTS') == "Enabled" ) 
                                                    <input type="checkbox" class="switch" name="NEW_ACCOUNTS" value="Enabled" checked />
                                                    @else
                                                    <input type="checkbox" class="switch" name="NEW_ACCOUNTS" value="Enabled" />
                                                    @endif
                                                    {{__('settings.system-form.label.allow-signup')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    @if ( env('APP_ENV') == "demo" )
                                                        <button class="btn btn-primary" type="submit" disabled>{{__('settings.button.save')}}</button>
                                                    @else
                                                        <button class="btn btn-primary" type="submit">{{__('settings.button.save')}}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                                  <div id="security" class="tab-pane fade">
                                    <h3>{{__('settings.password-form.title')}}</h3>
                                    <p class="text-muted text-thin">{{__('settings.password-form.intro')}}</p>
                                        <form class="simcy-form" action="{{ url('Settings@updatepassword') }}" data-parsley-validate="" loader="true" method="POST">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('settings.password-form.label.current-password')}}</label>
                                                        <input type="password" class="form-control" name="current" required placeholder="{{__('settings.password-form.placeholder.current-password')}}">
                                                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('auth.auth-form.label.new-password')}}</label>
                                                        <input type="password" class="form-control" name="password" data-parsley-required="true" data-parsley-minlength="6" data-parsley-error-message="{{__('auth.messages.too-short')}}" id="newPassword" placeholder="{{__('auth.auth-form.placeholder.new-password')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>{{__('auth.auth-form.label.confirm-password')}}</label>
                                                        <input type="password" class="form-control" data-parsley-required="true" data-parsley-equalto="#newPassword" data-parsley-error-message="{{__('auth.messages.dont-match')}}" placeholder="{{__('auth.auth-form.label.confirm-password')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        @if ( env('APP_ENV') == "demo" )
                                                            <button class="btn btn-primary" type="submit" disabled>{{__('settings.button.save')}}</button>
                                                        @else
                                                            <button class="btn btn-primary" type="submit">{{__('settings.button.save')}}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                  </div>
                                </div>
                            </div>
                        </div>
              </div>
            </div>
        </div>
    </div>


  <!-- footer -->
 
</div>

    <!--Record Income-->
    <div class="modal fade" id="update" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="update-form"></div>
    </div>
    </div>

    <!--Record Income-->
    <div class="modal fade" id="create" role="dialog">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('settings.category-form.add-title')}}  </h4>
                </div>
                <form class="simcy-form" action="{{ route('setting.add')}}" data-parsley-validate="" loader="true" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>{{__('settings.category-form.label.name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{__('settings.category-form.placeholder.name')}}" data-parsley-required="true" required>
                                    <input type="hidden" name="csrf-token" value="{{csrf_token()}}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>{{__('settings.category-form.label.type')}}</label>
                                    <select class="form-control select2" name="type">
                                        <option value="Income" @if($category->type == 'Income') selected @endif>
                                           {{__('pages.options.income')}}</option>
                                        <option value="Expense" @if($category->type == 'Expense') selected @endif>
                                           {{__('pages.options.expense')}}</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <label>{{ __('settings.category-form.label.level') }}</label>
                                    <select class="form-control select2" name="category">
                                        {{-- @if (!empty($categories)) --}}
                                            @foreach ($categories1 as $key => $val)
                                               
                                                <option value="{{ $val->id }}">
                                                    @php
                                                    $str = '';
                                                    for ($i = 0; $i < $val->level; $i++) {
                                                        echo $str;
                                                        $str .= '-- ';
                                                    }
                                                @endphp
                                                    {{ $val->name }}
                                                </option>
                                            @endforeach
                                        {{-- @endif --}}
                                        <option value="00">Trống
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('settings.button.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('settings.button.add-category')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @include('includes/footer')

</body>
</html>
