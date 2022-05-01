@extends('mongicommerce::admin.template.layout')
@section('title',"Gestione categorie")
@section('title_icon',"fa-tags")
@section('subtitle','')
@section('description','In questa sezione puoi creare una nuova cateogoria')
@section('css')
    <link rel="stylesheet" href="{{css('jstree/themes/default/style.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Crea una nuova categoria
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
                        <div class="form-group">
                            <label class="form-label" for="name">Nome categoria</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text py-1 px-3">
                                        <span class="icon-stack">
                                           <i class="fal fa-book"></i>
                                        </span>
                                    </span>
                                </div>
                                <input id="name" type="text" class="form-control" placeholder=""
                                       aria-describedby="name">
                            </div>
                            <span class="help-block">Nome delle categoria</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sub-category">Categoria Madre</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text py-1 px-3">
                                        <span class="icon-stack">
                                           <i class="fal fa-tag"></i>
                                        </span>
                                    </span>
                                </div>
                                <select id="sub-category" type="text" class="form-control"
                                        aria-describedby="sub-category">
                                    <option value="">Seleziona</option>
                                </select>
                            </div>
                            <span class="help-block">Seleziona una categoria a cui far appartenere la nuova</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Descrizione</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fal fa-pen"></i>
                                    </span>
                                </div>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <button id="btn_save_category" class="btn btn-primary btn-block">Inserisci</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Struttura
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
                        <div class="panel-tag">
                            Add the relative form sizing classes to the <code>.input-group</code> itself and contents
                            within will automatically resize—no need for repeating the form control size classes on each
                            element. <strong>Sizing on the individual input group elements isn’t supported</strong>
                        </div>
                        <div id="trtrtr" class="demo"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-category-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminazione categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Sei sicuro di voler eliminare la categoria e i suoi figli?</p>
                    <input hidden id="input-category-id" type="text">
                </div>
                <div class="modal-footer">
                    <button id="confirm-button" type="button" class="btn btn-primary">Conferma</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{js('jstree/jstree.js')}}"></script>
    <script>

        let url_new_category = '{{route('admin.post.create.new.category')}}';
        let url_get_categories = '{{route('admin.post.get.categories')}}';
        let url_get_structure_tree = '{{route('admin.post.get.categories.tree')}}'

        $(function () {
            getCategories();
            createDataTree();
        });

        $('#btn_save_category').click(function () {
            createCategory();

        });

        function createDataTree() {
            $.ajax({
                method: 'POST',
                url: url_get_structure_tree,
                data: {},
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    $('#trtrtr').jstree({
                        'core': {
                            'check_callback': true,
                            'data': response,

                        },
                        "plugins": ["types", "themes", "json_data", "ui"]
                    }).bind('select_node.jstree rename_node.jstree', function (e, data) {
                        let type = e.type;
                        console.log(type);
                        if (type === 'rename_node') {
                            console.log(data);
                            let new_text = data.text;
                            let category_id = data.node.id;
                            console.log(new_text);
                            //handle rename_node.jstree here
                        } else if (type === 'create_node') {
                            //handle create_node.jstree here
                        } else if(type === 'select_node'){
                            //let node = data.instance.get_node(data.selected);
                            //data.instance.edit(node);
                            $('#input-category-id').val(data.instance.get_node(data.selected).id);
                            $('#delete-category-modal').modal('show');
                            console.log(data.instance.get_node(data.selected));
                        }

                    });
                }
            });
        }

        $('#confirm-button').click(function (){
            $.ajax({
                method: 'POST',
                url: "{{route('admin.post.delete.category')}}",
                data: {
                    category_id: $('#input-category-id').val()
                },
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    console.log(response);
                    //$('#trtrtr').jstree(true).refresh();
                    $('#delete-category-modal').modal('hide');
                    if(response.error === undefined){
                        success('Categoria eliminata correttamente.', true);
                    }else{
                        error(response.error);
                    }
                }
            });
        })

        function updateTree() {
            $.ajax({
                method: 'POST',
                url: url_get_structure_tree,
                data: {},
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    $('#trtrtr').jstree(true).settings.core.data = response;
                    $('#trtrtr').jstree(true).refresh();
                }
            });

        }

        function getCategories() {
            $.ajax({
                method: 'POST',
                url: url_get_categories,
                data: {},
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    $('#sub-category').html('<option value="" selected>Categoria Madre</option>');
                    $.each(response, function (index, value) {
                        if(value.parent_id == null) {
                            $('#sub-category').append($("<option />").val(value.id).text(value.name));
                        }
                        //$('#sub-category').append($("<option />").val(value.id).text(value.name));
                    });
                }
            });
        }

        function createCategory() {
            $.ajax({
                method: 'POST',
                url: url_new_category,
                data: {
                    name: $('#name').val(),
                    description: $('#description').val(),
                    parent_id: $('#sub-category').val(),
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    $('#name').val('');
                    updateTree();
                    getCategories();
                }
            });
        }

    </script>

@endsection
