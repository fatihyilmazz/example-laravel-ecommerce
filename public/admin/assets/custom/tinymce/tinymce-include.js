let currentLocale = $("input[name=currentLocale]").val();

if (typeof(imageFileUploadPathForTinymce) != "undefined" && imageFileUploadPathForTinymce !== null &&
    typeof(currentLocale) != "undefined" && currentLocale !== null) {
    alert('Undefined variable for TinyMCE Editor');
}

tinymce.init({
    selector: ".product-content",
    height:700,
    plugins: [
        'template advlist autolink link image imagetools lists charmap print preview hr pagebreak spellchecker',
        'searchreplace wordcount visualblocks code fullscreen insertdatetime media',
        'table contextmenu directionality textcolor'
    ],
    toolbar: 'undo redo | fontselect fontsizeselect forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image imagetools link autolink media fullpage fullscreen | charmap hr | table template lists advlist pagebreak spellchecker searchreplace wordcount visualblocks code insertdatetime contextmenu directionality textcolor | styleselect',
    content_style: '.title { color: #000; font-size: 20px !important; font-family: Roboto !important; font-weight: 600 !important; margin-bottom: 5px !important; }',
    formats: {
        titleFormat: { block: 'strong', classes: 'title'},
        contentFormat: { block: 'div', styles: { color: '#000', fontSize: '18px', fontFamily: 'Roboto', fontWeight: '500', lineHeight: '1.6' }}
    },
    //templates: [{title: 'Resimli Tema', description: 'Resimli Tema', url: '/products/content-template'}],
    //style_formats: [
    //    {title: 'Başlık', format: 'titleFormat'},
    //    {title: 'İçerik', format: 'contentFormat'},
    //],
    fontsize_formats: "18px 20px",
    content_css: ['https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Oswald|Raleway|Roboto&display=swap'],
    font_formats: 'Roboto=Roboto, sans-serif;',
    setup : function (ed) {
        ed.on('init', function () {
            this.getDoc().body.style.fontSize = '18px !important';
            this.getDoc().body.style.fontFamily = 'Roboto !important';
        });
    },
    images_upload_handler: function (blobInfo, success, failure) {
        var image = blobInfo.base64();

        $.ajax({
            type: "POST",
            url: "/file/upload/image",
            data: {
                image: image,
                path: imageFileUploadPathForTinymce,
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    success(response.data.imageUrl);
                } else {
                    failure(response.data.errors);
                }
            }
        });
    },
    language: currentLocale,
    //directionality: 'rtl'
});
