  
<div class="card-header">منو</div>

<div class="card-body">
    <div class="userinfo">
        {{getUserTumbnail()}}
        <div class="wallet">
            <p>کیف پول: {{auth()->user()->wallet}} تومان</p>
            <a href="{{ route('user.wallet') }}" class="btn btn-sm btn-danger">شارژ کیف پول</a>
        </div>
    </div>
    <div class="sidenav mt-2">
        <a href="{{ route('home') }}"><i class="fa fa-tachometer"></i> پنل کاربری</a>
        <a href="{{ route('user.send_question') }}"><i class="fa fa-comment"></i> ارسال سوال</a>
        <a href="{{ route('user.transactions') }}"><i class="fas fa-money-bill-alt"></i> تراکنش ها</a>
        <a href="{{ route('user.requests') }}"><i class="fas fa-list"></i> سوالات</a>
        <a href="{{ route('user.wallet') }}"><i class="fas fa-wallet"></i> کیف پول</a>
        <button class="dropdown-btn"> اطلاعات حساب
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="{{ route('user.data') }}">ویرایش اطلاعات</a>
            <a href="{{ route('user.password') }}">تغییر رمز عبو</a>
        </div>
     
        @if(request()->user()->can('admin') || request()->user()->can('superadmin') || request()->user()->can('expert'))
        <hr data-content="امکانات ادمین" class="hr-text">
        <a href="{{ route('request.index') }}"><i class="fas fa-list"></i> سوالات</a>
        <a href="{{ route('comment.index') }}"><i class="fas fa-comment"></i> پاسخ ها</a>
        @endif
        @if(request()->user()->can('admin') || request()->user()->can('superadmin') || request()->user()->can('expert_two'))
        <hr data-content="کارشناس دوم" class="hr-text">
        <a href="{{ route('comment.reject') }}"><i class="fas fa-list"></i> سوالات ارجاعی</a>
        @endif
        @if(request()->user()->can('admin') || request()->user()->can('superadmin'))
        <hr data-content="ادمین" class="hr-text">
        <button class="dropdown-btn"> کاربران 
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="{{ route('user.index') }}">همه کاربران</a>
            <a href="{{ route('register') }}#customer">افزودن کاربر</a>
            <a href="{{ route('register') }}#expert">افزودن کارشناس</a>
        </div>
        <a href="{{ route('transaction.index') }}"><i class="fas fa-money-bill-alt"></i> تراکنش ها</a>
        <a href="{{ route('wallet_order') }}"><i class="fas fa-money-bill-alt"></i> درخواست پول</a>
        <a href="{{ route('coupon.index') }}"><i class="fas fa-money-bill-alt"></i> کد های تخفیف</a>
        <a href="{{ route('attachment.index') }}"><i class="fas fa-image"></i> رسانه ها</a>
        @endif
    </div>

</div>
          
       
   
