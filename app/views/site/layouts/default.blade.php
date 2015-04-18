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
{{--chen code --}}
<?php
    $script_p2 = Script::orderBy('created_at', 'DESC')->whereType('p2')->get();
    if(count($script_p2)){
        foreach($script_p2 as $key=>$val){
            echo '<!--'.$val->title.'-->';
            echo $val->content;
            echo '<!-- end '.$val->title.'-->';
        }
    }
?>


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

<?php
    $script_p3 = Script::orderBy('created_at', 'DESC')->whereType('p3')->get();
    if(count($script_p3)){
        foreach($script_p3 as $key=>$val){
            echo '<!--'.$val->title.'-->';
            echo $val->content;
            echo '<!-- end '.$val->title.'-->';
        }
    }
?>
</body>
<!-- END BODY -->
</html>
