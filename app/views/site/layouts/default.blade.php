
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
    @include('site.layouts.head')
</head>
<!-- Head END -->
<!-- Body BEGIN -->
<body class="choidau">
<header id="header" class="container">

    @include('site.layouts.header')

</header>

<!-- Container -->
<section id="container">
    <div class="container">
    {{-- imtoanran add topa and topb section start --}}
        @section('topa')
            @show
        @section('topb')
            @show
    {{-- imtoanran add topa and topb section end --}}
    <!-- Content -->
    @section('content')
      <h1>Ko load dc dữ liệu</h1>
    @show
    <!-- ./ content -->
    </div>

</section>
<!-- ./ container -->



<footer id="footer">
  @include('site.layouts.footer')
</footer>

  @include('site.layouts.foot')


</body>
<!-- END BODY -->
</html>
