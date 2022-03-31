@extends('mongicommerce::admin.template.layout')
@section('title','Crea una variante per il prodotto ')
@section('title_icon',"fa-books")
@section('subtitle',$product->name)
@section('description',$product->description)
@section('css')
    <link rel="stylesheet" media="screen, print" href="{{css('datagrid/datatables/datatables.bundle.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{css('formplugins/cropperjs/cropper.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{css('fa-solid.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Informazioni Base
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome prodotto</label>
                                    <input type="text" value="{{$product->name}}" id="product_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Descrizione prodotto</label>
                                    <textarea name="" id="product_description" class="form-control"
                                              rows="8">{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Si tratta di un buono regalo o di una gift card?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gift" id="is_gift" value="si" @if($product->is_gift) checked @endif disabled>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            SI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gift" id="is_not_gift" value="no" @if(!$product->is_gift) checked @endif disabled>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            NO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="duration_time" style="display: none">
                                <div class="form-group">
                                    <label class="form-label" for="name">Durata buono (gg)</label>
                                    <input type="text" value="90" id="duration_time_input" class="form-control">
                                    <span class="help-block">Verrà calcolata dal momento dell'acquisto</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Immagine prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div>
                    <div class="panel-container show multi-collapse" id="actual_img">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-5 d-flex justify-content-center">
                                    <img src="{{$product->image}}" alt="" width="50%">
                                </div>
                                <div class="col-md-7 d-flex flex-column justify-content-center">
                                    <h4>Vuoi cambiare la foto per la nuova variante?</h4>
                                    <br>
                                    <button class="btn-block btn btn-primary"type="button" data-toggle="collapse" data-target=".multi-collapse"
                                            aria-expanded="false" aria-controls="actual_img img_editor" id="btn_change_img">Cambia immagine</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel collapse multi-collapse" id="img_editor">
                <div class="panel-hdr">
                    <h2>
                        Foto prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">

                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- Content -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-9">
                                        <!-- <h3>Demo:</h3> -->
                                        <div class="img-container">
                                            <img id="image" src="{{$product->image}}" alt="Picture">
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <!-- <h3>Preview:</h3> -->
                                        <div class="docs-preview clearfix">
                                            <div class="img-preview preview-lg"></div>
                                            <div class="img-preview preview-md"></div>
                                            <div class="img-preview preview-sm"></div>
                                            <div class="img-preview preview-xs"></div>
                                        </div>
                                        <!-- <h3>Data:</h3> -->
                                        <div class="docs-data">
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataX">X</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataX" placeholder="x">
                                                <span class="input-group-append">
                                                                    <span class="input-group-text">px</span>
                                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataY">Y</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataY" placeholder="y">
                                                <span class="input-group-append">
                                                                    <span class="input-group-text">px</span>
                                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataWidth">Width</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                                                <span class="input-group-append">
                                                                    <span class="input-group-text">px</span>
                                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataHeight">Height</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                                                <span class="input-group-append">
                                                                    <span class="input-group-text">px</span>
                                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataRotate">Rotate</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                                                <span class="input-group-append">
                                                                    <span class="input-group-text">deg</span>
                                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataScaleX">ScaleX</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                                            </div>
                                            <div class="input-group input-group-sm">
                                                                <span class="input-group-prepend">
                                                                    <label class="input-group-text" for="dataScaleY">ScaleY</label>
                                                                </span>
                                                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-9 docs-buttons">
                                        <!-- <h3>Toolbar:</h3> -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                                                                    <span class="fas fa-arrows"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                                                                    <span class="fas fa-crop"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, 0.1)">
                                                                    <span class="fas fa-search-plus"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, -0.1)">
                                                                    <span class="fas fa-search-minus"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, -10, 0)">
                                                                    <span class="fas fa-arrow-left"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 10, 0)">
                                                                    <span class="fas fa-arrow-right"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, -10)">
                                                                    <span class="fas fa-arrow-up"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, 10)">
                                                                    <span class="fas fa-arrow-down"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)">
                                                                    <span class="fas fa-undo"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)">
                                                                    <span class="fas fa-redo"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleX&quot;, -1)">
                                                                    <span class="fas fa-arrows-h"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleY&quot;, -1)">
                                                                    <span class="fal fa-arrows-v"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;crop&quot;)">
                                                                    <span class="fas fa-check"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;clear&quot;)">
                                                                    <span class="fas fa-times"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;disable&quot;)">
                                                                    <span class="fas fa-lock"></span>
                                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;enable&quot;)">
                                                                    <span class="fas fa-unlock"></span>
                                                                </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;reset&quot;)">
                                                                    <span class="fas fa-sync"></span>
                                                                </span>
                                            </button>
                                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                                                                    <span class="fas fa-image mr-1"></span> Upload
                                                                </span>
                                            </label>
                                        </div>
                                        <div style="display:none;" class="row">
                                            <div class="btn-group btn-group-crop">
                                                <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;, { maxWidth: 4096, maxHeight: 4096 })">
                                                                    Get Cropped Canvas
                                                                </span>
                                                </button>
                                                <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })">
                                                                    160&times;90
                                                                </span>
                                                </button>
                                                <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
                                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })">
                                                                    320&times;180
                                                                </span>
                                                </button>
                                            </div>
                                            <!-- Show the cropped image in modal -->
                                            <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"></div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->
                                            <button type="button" class="btn btn-secondary" data-method="getData" data-option data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getData&quot;)">
                                                                Get Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="setData" data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setData&quot;, data)">
                                                                Set Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="getContainerData" data-option data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getContainerData&quot;)">
                                                                Get Container Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="getImageData" data-option data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getImageData&quot;)">
                                                                Get Image Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="getCanvasData" data-option data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCanvasData&quot;)">
                                                                Get Canvas Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="setCanvasData" data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setCanvasData&quot;, data)">
                                                                Set Canvas Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="getCropBoxData" data-option data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;getCropBoxData&quot;)">
                                                                Get Crop Box Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="setCropBoxData" data-target="#putData">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setCropBoxData&quot;, data)">
                                                                Set Crop Box Data
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="moveTo" data-option="0">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.moveTo(0)">
                                                                Move to [0,0]
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="zoomTo" data-option="1">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.zoomTo(1)">
                                                                Zoom to 100%
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="rotateTo" data-option="180">
                                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="cropper.rotateTo(180)">
                                                                Rotate 180°
                                                            </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-method="scale" data-option="-2" data-second-option="-1">
                                                            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scale(-2, -1)">
                                                                Scale (-2, -1)
                                                            </span>
                                            </button>
                                            <textarea class="form-control" id="putData" rows="1" placeholder="Get data to here or set data with this value"></textarea>
                                        </div>

                                    </div>
                                    <!-- /.docs-buttons -->
                                    <div  class="col-lg-3 docs-toggles">
                                        <!-- <h3>Toggles:</h3> -->
                                        <div class="btn-group btn-group-sm d-flex flex-nowrap" data-toggle="buttons">
                                            <label class="btn btn-primary active">
                                                <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 16 / 9">
                                                                    16:9
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 4 / 3">
                                                                    4:3
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 1 / 1">
                                                                    1:1
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: 2 / 3">
                                                                    2:3
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN" checked>
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="aspectRatio: NaN">
                                                                    Free
                                                                </span>
                                            </label>
                                        </div>
                                        <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                                            <label class="btn btn-primary active">
                                                <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 0">
                                                                    VM0
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="viewMode1" name="viewMode" value="1">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 1">
                                                                    VM1
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 2">
                                                                    VM2
                                                                </span>
                                            </label>
                                            <label class="btn btn-primary">
                                                <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3" checked>
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="View Mode 3">
                                                                    VM3
                                                                </span>
                                            </label>
                                        </div>
                                        <div style="display:none;" class="dropdown dropup docs-options">
                                            <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
                                                Toggle Options
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="responsive" type="checkbox" name="responsive" checked>
                                                        <label class="form-check-label" for="responsive">responsive</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="restore" type="checkbox" name="restore" checked>
                                                        <label class="form-check-label" for="restore">restore</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="checkCrossOrigin" type="checkbox" name="checkCrossOrigin" checked>
                                                        <label class="form-check-label" for="checkCrossOrigin">checkCrossOrigin</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="checkOrientation" type="checkbox" name="checkOrientation" checked>
                                                        <label class="form-check-label" for="checkOrientation">checkOrientation</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="modal" type="checkbox" name="modal" checked>
                                                        <label class="form-check-label" for="modal">modal</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="guides" type="checkbox" name="guides" checked>
                                                        <label class="form-check-label" for="guides">guides</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="center" type="checkbox" name="center" checked>
                                                        <label class="form-check-label" for="center">center</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="highlight" type="checkbox" name="highlight" checked>
                                                        <label class="form-check-label" for="highlight">highlight</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="background" type="checkbox" name="background" checked>
                                                        <label class="form-check-label" for="background">background</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="autoCrop" type="checkbox" name="autoCrop" checked>
                                                        <label class="form-check-label" for="autoCrop">autoCrop</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="movable" type="checkbox" name="movable" checked>
                                                        <label class="form-check-label" for="movable">movable</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="rotatable" type="checkbox" name="rotatable" checked>
                                                        <label class="form-check-label" for="rotatable">rotatable</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="scalable" type="checkbox" name="scalable" checked>
                                                        <label class="form-check-label" for="scalable">scalable</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="zoomable" type="checkbox" name="zoomable" checked>
                                                        <label class="form-check-label" for="zoomable">zoomable</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="zoomOnTouch" type="checkbox" name="zoomOnTouch" checked>
                                                        <label class="form-check-label" for="zoomOnTouch">zoomOnTouch</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="zoomOnWheel" type="checkbox" name="zoomOnWheel" checked>
                                                        <label class="form-check-label" for="zoomOnWheel">zoomOnWheel</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="cropBoxMovable" type="checkbox" name="cropBoxMovable" checked>
                                                        <label class="form-check-label" for="cropBoxMovable">cropBoxMovable</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="cropBoxResizable" type="checkbox" name="cropBoxResizable" checked>
                                                        <label class="form-check-label" for="cropBoxResizable">cropBoxResizable</label>
                                                    </div>
                                                </li>
                                                <li class="dropdown-item">
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="toggleDragModeOnDblclick" type="checkbox" name="toggleDragModeOnDblclick" checked>
                                                        <label class="form-check-label" for="toggleDragModeOnDblclick">toggleDragModeOnDblclick</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.dropdown -->
                                    </div>
                                    <!-- /.docs-toggles -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-5">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Seleziona categoria
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome categoria</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-tags"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <select class="form-control" disabled name="categories" id="categories"></select>
                                    </div>
                                    <span class="help-block">Categoria da associare ai dettagli</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="panel_configuration_field" style="display:none;" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Specifiche prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div id="div_configuration_field" class="panel-content"></div>
                </div>

            </div>
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Dettagli prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div id="div_details" class="panel-content"></div>
                    <div class="col-md-12 mt-2">

                        <div class="form-group">
                            <label class="form-label" for="name">Disponibilità prodotto (n°pezzi)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-abacus"></i>
                                                </span>
                                            </span>
                                </div>
                                <input type="number" id="quantity" class="form-control">
                            </div>
                            <span class="help-block">Disponibilità del prodotto con questa varietà</span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Prezzo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-euro-sign"></i>
                                                </span>
                                            </span>
                                </div>
                                <input type="number" id="price" class="form-control">
                            </div>
                            <span class="help-block">Quantità per prodotti con questa varietà</span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Peso (Kg)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-weight-hanging"></i>
                                                </span>
                                            </span>
                                </div>
                                <input type="number" id="weight" class="form-control">
                            </div>
                            <span class="help-block">Peso indicativo prodotto (0.0 Kg)</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <button  onclick="saveProduct()" class="m-3 btn btn-primary btn-block">Crea prodotto </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Varianti per questo prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                            <tr>
                                <th>Nome Prodotto</th>
                                <th>Descrizione Prodotto</th>
                                <th>Dettagli</th>
                                <th>Prezzo</th>
                                <th>Quantità</th>
                                <th>Peso (Kg)</th>
                                <th>Azioni</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        @foreach($item->details as $detail)
                                            <span class="badge badge-danger">{{$detail->detail->value}}</span>
                                        @endforeach
                                    </td>
                                    <td><input id="item_price_{{$loop->index}}" value="{{$item->price}}" class="form-control" type="number"></td>
                                    <td><input id="item_qta_{{$loop->index}}" value="{{$item->quantity}}" class="form-control" type="number"></td>
                                    <td><input id="item_weight_{{$loop->index}}" value="{{$item->weight}}" class="form-control" type="number"></td>
                                    <td>
                                        <button class="btn btn-dark" data-id="{{$item->id}}" onclick="deleteVariation(this)"><i class="fal fa-trash"></i></button>
                                        <button class="btn btn-danger" data-id="{{$item->id}}" onclick="editVariation(this, {{$loop->index}})"><i class="fal fa-save"></i></button>
                                        <button class="btn btn-secondary" onclick="location.href='{{ route('admin.specifica.edit', ['id' => $item->id]) }}'"><i class="fal fa-edit"></i></button>
                                    </td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{js('datagrid/datatables/datatables.bundle.js')}}"></script>
    <script src="{{js('formplugins/cropperjs/cropper.js')}}"></script>
    <script src="{{js('custom_cropper.js')}}"></script>
    <script>
        let product_id = '{{$product->id}}';
        let category_id = '{{$product->category_id}}';
        let is_image_changed = false;
        function getCategories() {
            let url_get_categories = '{{route('admin.post.get.categories')}}';
            $.ajax({
                method: 'POST',
                url: url_get_categories,
                data: {},
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    $.each(response, function (index, value) {
                        if(category_id  == value.id){
                            $('#categories').append($("<option />").val(value.id).text(value.name));
                        }

                    });
                    getDetails();
                    getConfigurationField();
                }
            });
        }

        $(function () {
            getCategories();
        });
        function getDetails() {
            let url = '{{route('admin.post.get.details')}}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    category_id: $('#categories').val()
                },
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    generateDetails(response);
                }
            });
        }
        function generateDetails(details) {
            if (details.length > 0) {
                let html = '';
                $.each(details, function (index, value) {
                    html += '<div class="row mt-3">';
                    html += '<div class="col-md-12">';
                    html += '<div class="form-group">';
                    html += '<label class="form-label" for="name">' + value.name + '</label>';
                    html += value.html;
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });
                $('#div_details').html(html);
            } else {
                $('#div_details').html('');
            }

        }
        function saveProduct() {
            let details = [];
            let configuration_fields = [];
            let url = '{{route('admin.post.product.variation.new')}}';
            let result = $image.cropper("getCroppedCanvas",{maxWidth: 670, maxHeight: 670, fillColor: "#fff"}, "");


            $.each($('.mongifield'), function (index, value) {
                let detail_id = $(this).data('detail_id');
                let detail_value = $(this).val();
                if (detail_value !== '') {
                    details.push({'detail_id': detail_id, 'detail_value': detail_value});
                }
            });

            $.each($('.mongiconfigurationfield'), function (index, value) {
                let configuration_field_id = $(this).data('configuration_id');
                let configuration_field_value = $(this).val();
                if (configuration_field_value !== '') {
                    configuration_fields.push({'configuration_field_id': configuration_field_id, 'configuration_field_value': configuration_field_value});
                }
            });

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    product_name: $('#product_name').val(),
                    is_image_changed: is_image_changed,
                    product_description: $('#product_description').val(),
                    category_id: $('#categories').val(),
                    quantity: $('#quantity').val(),
                    price: $('#price').val(),
                    weight: $('#weight').val(),
                    product_id : product_id,
                    details: JSON.stringify(details),
                    configuration_fields : JSON.stringify(configuration_fields),
                    image : result.toDataURL(uploadedImageType),
                    is_gift: document.getElementById('is_gift').checked,
                    duration_time: $('#duration_time_input').val()
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    is_image_changed = false;
                    success("Nuova variante inserita con successo",true);
                }
            });

        }
        function getConfigurationField() {
            let url = '{{route('admin.post.get.configuration')}}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    category_id: $('#categories').val()
                },
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    generateConfigurationField(response);
                }
            });
        }
        function generateConfigurationField(details) {
            if (details.length > 0) {
                let html = '';
                $.each(details, function (index, value) {
                    html += '<div class="row mt-3">';
                    html += '<div class="col-md-12">';
                    html += '<div class="form-group">';
                    html += '<label class="form-label" for="name">' + value.name + '</label>';
                    html += value.html;
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });
                $('#div_configuration_field').html(html);
                $('#panel_configuration_field').show();
            } else {
                $('#panel_configuration_field').hide();
            }
        }

        function deleteVariation(el){
            let item_id = $(el).data('id');
            $.ajax({
                method:'post',
                url:"{{route('admin.post.product.variation.delete')}}",
                data:{
                    item_id : item_id,
                    product_id: product_id
                },
                success:function (response){
                    success("Variante eliminata correttamente",true);
                }
            })
        }

        function editVariation(el, index){
            let item_id = $(el).data('id');
            $.ajax({
                method:'post',
                url:"{{route('admin.post.product.variation.edit')}}",
                data:{
                    item_id : item_id,
                    item_qta : $('#item_qta_' + index).val(),
                    item_price : $('#item_price_' + index).val(),
                    item_weight: $('#item_weight_' + index).val()
                },
                success:function (response){
                    success("Modifiche apportate correttamente",true);
                }
            })
        }

        if(document.getElementById('is_gift').checked){
            $('#duration_time').show();
        }

        $('#btn_change_img').click(function () {
            is_image_changed = true;
        })

    </script>
    <script>
        $(document).ready(function()
        {
            // initialize datatable
            $('#dt-basic-example').dataTable(
                {
                    responsive: true,
                });
        });

    </script>


@endsection
