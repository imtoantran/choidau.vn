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

<div id="fb-root"></div>
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
    {{-- imtoanran add bottoma and bottomb section start --}}
        @section('bottoma')
        @show
        @section('bottomb')
        @show
    {{-- imtoanran add bottoma and bottomb section end --}}
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
