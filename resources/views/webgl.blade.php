<!DOCTYPE html>
<html lang="en">
<head>
    <title>FFW - 3D Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <style>
        body {
            background: #000;
            color: #fff;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        #info {
            position: absolute;
            top: 0px;
            width: 100%;
            color: #ffffff;
            padding: 5px;
            font-family: Monospace;
            font-size: 13px;
            text-align: center;
        }

        a {
            color: #ffffff;
        }
    </style>
</head>
<body>

<div id="container"></div>

<script src="{{ url('assets/webgl/build/three.js') }}"></script>

<script src="{{ url('assets/webgl/js/loaders/ColladaLoader.js') }}"></script>
<script src="{{ url('assets/webgl/js/libs/inflate.min.js') }}"></script>
<script src="{{ url('assets/webgl/js/loaders/FBXLoader.js') }}"></script>
<script src="{{ url('assets/webgl/js/loaders/OBJLoader.js') }}"></script>
<script src="{{ url('assets/webgl/js/controls/OrbitControls.js') }}"></script>
<script src="{{ url('assets/webgl/js/utils/GeometryUtils.js') }}"></script>
<script src="{{ url('assets/webgl/js/WebGL.js') }}"></script>
<script src="{{ url('assets/webgl/js/libs/stats.min.js') }}"></script>

<script src="{{ url('assets/webgl/ffw.js') }}"></script>

</body>
</html>
