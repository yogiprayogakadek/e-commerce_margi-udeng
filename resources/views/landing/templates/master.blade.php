<!DOCTYPE html>
<html class="no-js" lang="en">

@include('landing.templates.partials.head')

<body>

    <!--== Wrapper Start ==-->
    <div class="wrapper">

        <!--== Start Header Wrapper ==-->
        @include('landing.templates.partials.header')
        <!--== End Header Wrapper ==-->

        @include('landing.templates.partials.content')

        <!--== Start Footer Area Wrapper ==-->
        @include('landing.templates.partials.footer')
        <!--== End Footer Area Wrapper ==-->

    </div>
    <!--== Wrapper End ==-->

    @include('landing.templates.partials.script')
    @stack('script')
</body>

</html>
