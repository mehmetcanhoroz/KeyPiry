@extends("layouts.backend")

@section("pageTitle")
    Ürün Düzenle
@endsection

@section("pageHeaderBreadCrumbs")
    <li><a href="{{route("backend.product.index")}}"><span>Ürünler</span></a></li>
    <li><span>Ürün Düzenle</span></li>
@endsection

@section("content")
    <div class="row">
        <div class="col">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Düzenleme Formu</h2>
                </header>
                <div class="card-body">
                    <form class="form-horizontal form-bordered" method="post" id="form" enctype="multipart/form-data">

                        <div class="tabs">
                            <ul class="nav nav-tabs">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#info" data-toggle="tab">Ürün Bilgileri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#seo" data-toggle="tab">SEO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#detail" data-toggle="tab">Ürün Detay</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="info" class="tab-pane active">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="title">Başlık <span class="required">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Kategori Başlığı"
                                                   value="@if(isset($obj->name)){{$obj->name}}@endif"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="developer">Geliştirici</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="developer" name="developer"
                                                   value="@if(isset($obj->developer)){{$obj->developer}}@endif"
                                                   placeholder="Ürün Geliştiricisi">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="publisher">Yayıncı</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="publisher" name="publisher"
                                                   value="@if(isset($obj->publisher)){{$obj->publisher}}@endif"
                                                   placeholder="Ürün Yayıncısı">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="genre">Tür</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="genre" name="genre"
                                                   value="@if(isset($obj->genre)){{$obj->genre}}@endif"
                                                   placeholder="Ürün Türü">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="release_date">Yayınlanma Tarihi</label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="release_date" name="release_date"
                                                   value="@if(isset($obj->release_date)){{$obj->release_date}}@endif"
                                                   placeholder="Ürün Yayınlanma Tarihi">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="status">Durum</label>
                                        <div class="col-lg-6">
                                            <div class="switch switch-sm switch-success">
                                                <input type="checkbox" name="status" id="status" data-plugin-ios-switch
                                                        {{$obj->status === 1 ? "checked" : ""}}/>
                                            </div>
                                        </div>
                                    </div>

                                    {{csrf_field()}}

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="parent">Üst
                                            Kategori</label>
                                        <div class="col-lg-6">
                                            <select data-plugin-selectTwo class="form-control populate" name="parent">
                                                <option value="">Ana kategori</option>

                                                @foreach($categories as $cat)

                                                    <optgroup label="{{$cat->title}}">
                                                        <option {{$cat->id === $obj->category_id ? "selected" : ""}} value="{{$cat->id}}">
                                                            — {{$cat->title}}</option>
                                                        @foreach($cat->subcategories as $subcat)
                                                            <option disabled>
                                                                —— {{$subcat->title}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="image">Kategori
                                            Resmi</label>
                                        <div class="col-lg-6">
                                            <input type="file" name="image" id="image"
                                                   class="form-control form-control-file">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remove_image">
                                                    Resimi kaldır
                                                </label>
                                            </div>

                                            <img src="{{$obj->image ? asset("uploads/product/{$obj->image}") : asset('placeholder.png')}}"
                                                 id="imagePreview" alt=""
                                                 style="max-width: 250px; width: 100%" class="mt-3 shadow-lg">
                                        </div>
                                    </div>
                                </div>
                                <div id="seo" class="tab-pane">
                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="seo_keywords">Anahtar
                                            Kelimeler</label>
                                        <div class="col-lg-6">
                                            <input type="text" data-role="tagsinput"
                                                   data-tag-class="badge badge-primary"
                                                   value="@if(isset($obj->seo_keywords)){{$obj->seo_keywords}}@endif"
                                                   class="form-control"
                                                   id="seo_keywords" placeholder="Virgül ile ayırınız"
                                                   name="seo_keywords">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2"
                                               for="seo_description">Açıklama</label>
                                        <div class="col-lg-6">
                                            <textarea rows="2" class="form-control" id="seo_description"
                                                      name="seo_description"
                                                      placeholder="Kategori SEO Açıklaması, Google tarafından gösterilir">@if(isset($obj->seo_description)){{$obj->seo_description}}@endif</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 control-label text-lg-right pt-2" for="seo_title">SEO
                                            Başlık</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="seo_title" name="seo_title"
                                                   value="@if(isset($obj->seo_title)){{$obj->seo_title}}@endif"
                                                   placeholder="Sekme başlığında gözükecek başlık, boş ise kategori ismi otomatik eklenecektir">
                                        </div>
                                    </div>
                                </div>
                                <div id="detail" class="tab-pane">

                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <textarea rows="15" class="form-control" id="details"
                                                      name="details">@if(isset($obj->description)){{$obj->description}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="mb-1 mt-1 mr-1 btn btn-success float-right" id="save">
                                    Ürünü Kaydet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
@endsection


@push("customVendorJs")
    <script src="{{asset("assets/backend/vendor/autosize/autosize.js")}}"></script>
    <script src="{{asset("assets/backend/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js")}}"></script>

    <script src="{{asset("assets/backend/vendor/jquery-ui/jquery-ui.js")}}"></script>
    <script src="{{asset("assets/backend/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js")}}"></script>
    <script src="{{asset("assets/backend/vendor/select2/js/select2.js")}}"></script>

    <script src="{{asset("assets/backend/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js")}}"></script>

    <script src="{{asset("assets/backend/vendor/ios7-switch/ios7-switch.js")}}"></script>
    <script src="{{asset("assets/backend/vendor/ckeditor/ckeditor.js")}}"></script>
@endpush
@push("customJs")
    <script>

        $("#form").submit(function (e) {
            e.preventDefault();
            var button = $(this);

            var form = new FormData($("#form")[0]);
            form.append('enctype', 'multipart/form-data');

            swal({
                title: 'İşlem gerçekleştiriliyor...',
                html:
                    '<i class="fas fa-circle-notch fa-spin fa-3x fa-fw"></i>' +
                    ' <span class="sr-only">Loading...</span>',

                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });

            $.ajax({
                type: "post",
                url: "{{route("backend.category.editpost", ["id" => $obj->id])}}",
                data: form,
                contentType: false,
                processData: false,

                success: function (response, textStatus, xhr) {
                    if (textStatus == "success") {

                        swal.close();

                        swal({
                            type: textStatus,
                            title: response.title,
                            text: response.message,
                        }).then(() => {
                            location.href = "{{route("backend.product.index")}}";
                        });
                    }
                },

                error: function (response) {
                    swal.close();

                    let error = false;
                    let output = "<span style='color:#f27474'>";
                    for (property in response.responseJSON.errors) {
                        output += response.responseJSON.errors[property] + ' <br>';
                        error = true;
                    }
                    output += "</span><br>";
                    swal({
                        type: "error",
                        title: "Hata oluştu!",
                        html: (error ? output : "") + (!error ? response.responseJSON.message + "<br>" : "") + "Lütfen formu kontrol edin!"
                    });
                }
            });
        });

        $("#image").on("change", function () {
            var input = this;

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagePreview").attr("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        var editor = CKEDITOR.replace('details');


        editor.on('blur', function (evt) {
            document.getElementById("details").innerHTML = editor.getData();
        });

        editor.on('change', function () {
            document.getElementById("details").innerHTML = editor.getData();
        });
    </script>

@endpush
@push("customCss")
    <link rel="stylesheet" href="{{asset("assets/backend/vendor/jquery-ui/jquery-ui.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/vendor/jquery-ui/jquery-ui.theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/vendor/select2/css/select2.css")}}"/>
    <link rel="stylesheet"
          href="{{asset("assets/backend/vendor/select2-bootstrap-theme/select2-bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/backend/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css")}}"/>

    <link rel="stylesheet" href="{{asset("assets/backend/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css")}}"/>
@endpush