<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ config('website.icon') }}">
    <link href={{ asset('/vendor/'.$model.'/css/app.min.css') }} rel=stylesheet>
    <!-- 渲染插件Css -->
@if (!empty($resources['css']))
  @foreach ($resources['css'] as $css)
  <link href={{ $css }} rel=stylesheet>
  @endforeach
@endif
    <script>
        window.config = {
            graphql: "{{ url(config('graphql.prefix')) }}",
@if (!empty($resources['config']))
  @foreach ($resources['config'] as $key => $config)
          {{ $key }}: {!! json_encode($config) !!},
  @endforeach
@endif
        }
    </script>
</head>
<body>
    <div id=app></div>
    <!-- 渲染插件Html Begin -->
@if (!empty($resources['html']))
  @foreach ($resources['html'] as $html)
  {!! $html !!}
  @endforeach
@endif
    <!-- 渲染插件Html End -->
    <!-- 渲染插件Js Begin -->
@if (!empty($resources['js']))
  @foreach ($resources['js'] as $js)
  <script type=text/javascript src={{ $js }}></script>
  @endforeach
@endif
  <!-- 渲染插件Js End -->
    <script type=text/javascript src={{ asset('/vendor/'.$model.'/js/app.min.js') }}></script>
</body>
</html>
