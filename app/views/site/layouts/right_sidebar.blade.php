
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
    @section('topa')
        top a
    @show
    <!-- Content -->
    @section('content')
      <h1>Ko load dc dữ liệu</h1>
    @show
    <!-- ./ content -->
    @section('sidebar')
        @show
    </div>

</section>
<!-- ./ container -->



<footer id="footer">
  @include('site.layouts.footer');
</footer>

  @include('site.layouts.foot');


</body>
<!-- END BODY -->
</html>
