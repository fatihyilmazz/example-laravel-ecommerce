function generateSlug(slugType, locale, resourceId, outputId, recordId)
{
    if (typeof(slugUrl) != "undefined" && slugUrl !== null &&
        typeof(swalTitleForSlug) != "undefined" && swalTitleForSlug !== null &&
        typeof(swalButtonTextSlug) != "undefined" && swalButtonTextSlug !== null
    ) {
        let textForSlug = $('#' + resourceId).val();

        if (textForSlug != "") {
            $.ajax({
                type: 'GET',
                url: slugUrl,
                data: {
                    'slug_type' : slugType,
                    'locale' : locale,
                    'string' : textForSlug,
                    'recordId' : recordId,
                },
                dataType: 'json',
                success:function (response) {
                    if (response.success) {
                        $('#' + outputId).val(response.slug)
                    } else {
                        Swal.fire({
                            title: swalTitleForSlug,
                            type: 'error',
                            confirmButtonColor: KTAppOptions.colors.state.success,
                            confirmButtonText: swalButtonTextSlug,
                        });
                    }
                },
                error:function () {
                    Swal.fire({
                        title: swalTitleForSlug,
                        type: 'error',
                        confirmButtonColor: KTAppOptions.colors.state.success,
                        confirmButtonText: swalButtonTextSlug,
                    });
                }
            });
        }
    } else {
        console.log('Check sluggable.js');

        Swal.fire({
            title: 'Undefined variables',
            type: 'error',
            confirmButtonColor: KTAppOptions.colors.state.success,
            confirmButtonText: 'Ok',
        });
    }
}
