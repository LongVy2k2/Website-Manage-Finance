@include('includes/header')
<body>
@include('includes/navbar')

<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h4 class="text-center">{{__('income.income-form.update-title')}}</h4>
     
        <form class="simcy-form" action="{{ route('income.update') }}" data-parsley-validate="" method="POST" loader="true">
         @csrf
     <div class="modal-body">
           <div class="form-group">
              <div class="row">
                 <div class="col-md-12">
                    <label>{{__('income.income-form.label.title')}}</label>
                    <input type="text" class="form-control" name="title" value="{{$income->title}}" placeholder="{{__('income.income-form.placeholder.title')}}">
            
                    <input type="hidden" name="incomeid" value="{{$income->id}}" />
                 </div>
              </div>
           </div>
           <div class="form-group">
              <div class="row">
                 <div class="col-md-12">
                    <label>{{__('income.income-form.label.amount')}}</label>
                    <span class="input-prefix">VND</span>
                    <input type="number" class="form-control prefix" value="{{$income->amount}}" name="amount" placeholder="{{__('income.income-form.placeholder.amount')}}">
                 </div>
              </div>
           </div>
           <div class="form-group">
              <div class="row">
                 <div class="col-md-12">
                    <label>{{__('income.income-form.label.account')}}</label>
                    <select class="form-control select2" name="account">
                       <option value="0" @if($income->account == '0') selected @endif>
                          {{__('income.income-form.account.other')}}</option>
                      @if(!empty($accounts))
                      @foreach($accounts as $account)
                       <option value="{{ $account->id }}" @if( $income->account == $account->id ) selected @endif>{{ $account->name }}</option>
                      @endforeach
                      @endif
                    </select>
                 </div>
              </div>
           </div>
           <div class="form-group">
              <div class="row">
                 <div class="col-md-12 ">
                    <label>{{__('income.income-form.label.category')}}</label>
                    <select class="form-control select2" name="category">
                       @if(!empty($incomecategories))
                             @foreach($incomecategories as $incomecategory)
                                <option value="{{ $incomecategory->id }}" @if($income->category == $incomecategory->id) selected @endif>{{ $incomecategory->name }} </option>
                             @endforeach
                       @endif
                       {{-- <option value="00" @if($income->category == '0') selected @endif>
                          {{__('income.income-form.group.other')}} </option> --}}
                    </select>
                 </div>
              </div>
           </div>
           <div class="form-group">
              <div class="row">
                 <div class="col-md-12">
                    <label>{{__('income.income-form.label.date')}}</label>
                    <input type="text" class="form-control datepicker-dynamic" value="{{date('m/d/Y', strtotime($income->income_date))}}" name="income_date" placeholder="{{__('income.income-form.placeholder.date')}}">
                 </div>
              </div>
           </div>
           <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    {{-- <label>{{ __('expenses.expense-form.label.directory') }}</label>
                    <input type="text" class="form-control" name="directory"
                        placeholder="{{ __('expenses.expense-form.placeholder.directory') }}" > --}}
                    @if (!empty($directorys))
                        <label>{{ __('expenses.expense-form.label.available') }}</label>
                        <select class="form-control select2" name="directoryMul[]" id="directorySelect" multiple="multiple">
                                @foreach ($directorys as $dir)
                                @php

                                $id_income =  $dir->income;
                               
                                 @endphp
                                    <option {{ $income->id == $id_income ? 'selected' : ''}}  value="{{ $dir->id }}">{{ $dir->name }}</option>
                                    
                                @endforeach
                            
                        </select>
                    @endif
                </div>
            </div>
        </div>
           <div class="form-group">
            <div class="row">
               <div class="col-md-12">
                  <label>{{__('income.income-form.label.description')}}</label>
                  <input type="text" class="form-control" value="{{$income->description}}" name="description" placeholder="{{__('income.income-form.placeholder.description')}}">
               </div>
            </div>
         </div>
     </div>
        <div class="modal-footer " >
         <button type="button" class="btn btn-default"
         >
         <a href="{{ route('income.index') }}">{{__('income.button.close')}}</button>
           <button type="submit" class="btn btn-primary">{{__('income.button.update-income')}}</button>
        </div>
     </form>
    </div>
    <div class="col-md-2"></div>

  </div>
  @include('includes/footer')
</div>
