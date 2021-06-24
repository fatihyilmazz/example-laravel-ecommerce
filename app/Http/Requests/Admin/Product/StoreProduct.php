<?php

namespace App\Http\Requests\Admin\Product;

use App\Facades\Setting;
use App\Media;
use App\Rules\UniqueForLocale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProduct extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $request            = $this->request;

        $imageMaxSize       = Setting::get('file_product_max_size', \App\Setting::FILE_PRODUCT_MAX_SIZE);
        $imageWidth         = Setting::get('image_product_width', \App\Setting::IMAGE_PRODUCT_WIDTH);
        $imageHeight        = Setting::get('image_product_height', \App\Setting::IMAGE_PRODUCT_HEIGHT);
        $fileMaxSize        = Setting::get('file_product_max_size', \App\Setting::FILE_PRODUCT_MAX_SIZE);
        $fileTypes          = Setting::get('file_product_allowed_file_types', \App\Setting::FILE_PRODUCT_ALLOWED_FILE_TYPES);
        $mediaTypeIdImage   = Media::TYPE_ID_IMAGE;
        $mediaTypeIdFile    = Media::TYPE_ID_FILE;

        return  [
            'id'                => 'nullable|exists:products,id',
            //'type_id' => 'bail|required|exists:product_types,id',
            'brand_id'          => 'bail|required|exists:brands,id',
            'currency_id'       => 'bail|nullable|exists:currencies,id',
            'tax_rate_id'       => 'bail|nullable|exists:tax_rates,id',
            'main_category'     => 'bail|required|exists:categories,id',
            'sub_categories.*'  => [
                'bail',
                'nullable',
                'distinct',
                'exists:categories,id',
                'different:main_category',
            ],
            //'quantity' => 'bail|nullable|numeric',
            'is_tax_included'   => 'required|boolean',
            'selling_price'     => 'required|numeric',
            //'list_price' => 'nullable|numeric|gte:selling_price|gte:cost_price',
            //'cost_price' => 'nullable|numeric|lte:selling_price|lte:list_price',
            //'weight' => 'nullable|numeric',
            //'width' => 'nullable|numeric',
            //'length' => 'nullable|numeric',
            //'height' => 'nullable|numeric',
            //'min_selling_quantity' => 'nullable|numeric',
            //'max_selling_quantity' => 'nullable|numeric',
            //'supplier_id' => 'bail|nullable|exists:suppliers,id',
            'sku' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'gtin' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'upc' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'ean' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'jan' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'isbn' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'itf_14' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'mpn' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'oem' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'non_oem' => [
                'bail',
                'nullable',
                'string',
                'max:255',
                Rule::unique('products')->ignore($request->get('id')),
            ],
            'row' => 'bail|nullable|digits_between:0,32767',
            'is_active' => 'required|boolean',
            'translations.*.id' => 'bail|nullable|int|exists:product_translations,id',
            'translations.*.locale' => 'bail|required|string|max:255|exists:locales,code',
            'translations.*.name' => 'bail|required|string|max:255',
            'translations.*.slug' => [
                'bail',
                'required',
                'string',
                'max:255',
                new UniqueForLocale('product_translations', $this->request->all())
            ],
            'translations.*.short_description'  => 'bail|nullable|string|max:65535',
            'translations.*.content'            => 'bail|nullable|string|max:16777215',
            'translations.*.keywords'           => 'bail|nullable|string|max:255',
            'translations.*.description'        => 'bail|nullable|string|max:255',
            'images.*.isExists'                 => 'nullable|numeric|in:0,1',
            'images.*.id'                       => 'nullable|exists:medias,id',
            'images.*.media_type'               => "bail|nullable|required_with:images.*.source|in:{$mediaTypeIdImage}",
            'images.*.source'                   => "bail|nullable|exclude_if:images.*.isExists,1|required_with:images.*.media_type|image|max:{$imageMaxSize}|dimensions:width={$imageWidth},height={$imageHeight}",
            'images.*.alt'                      => 'nullable|string|max:255',
            'files.*.isExists'                  => 'nullable|numeric|in:0,1',
            'files.*.id'                        => 'nullable|exists:medias,id',
            'files.*.media_type'                => "bail|nullable|required_with:files.*.source|in:{$mediaTypeIdFile}",
            'files.*.source'                    => "bail|nullable|exclude_if:files.*.isExists,1|required_with:files.*.media_type|mimetypes:{$fileTypes}|max:{$fileMaxSize}",
        ];
        //TODO Dosya ismi eklenebilmeli
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return  [
            'id'                                => __('text.crud.id'),
            'brand_id'                          => __('text.brand.name_singular'),
            'currency_id'                       => __('text.currency.name_singular'),
            'tax_rate_id'                       => __('text.tax_rate.name_singular'),
            'main_category'                     => __('text.category.main_category'),
            'sub_categories.*'                  => __('text.category.sub_categories'),
            'is_tax_included'                   => __('text.product.tax_included'),
            'selling_price'                     => __('text.product.selling_price'),
            'sku'                               => __('text.product.sku'),
            'gtin'                              => __('text.product.gtin'),
            'upc'                               => __('text.product.upc'),
            'ean'                               => __('text.product.ean'),
            'jan'                               => __('text.product.jan'),
            'isbn'                              => __('text.product.isbn'),
            'itf_14'                            => __('text.product.itf_14'),
            'mpn'                               => __('text.product.mpn'),
            'oem'                               => __('text.product.oem'),
            'non_oem'                           => __('text.product.non_oem'),
            'row'                               => __('text.common.order'),
            'is_active'                         => __('text.crud.status'),
            'translations.*.id'                 => __('text.crud.id'),
            'translations.*.locale'             => __('text.locale.name_singular'),
            'translations.*.name'               => __('text.common.name'),
            'translations.*.slug'               => __('text.common.slug'),
            'translations.*.short_description'  => __('text.common.short_description'),
            'translations.*.content'            => __('text.common.content'),
            'translations.*.keywords'           => __('text.common.keywords'),
            'translations.*.description'        => __('text.common.description'),
            'images.*.id'                       => __('text.crud.id'),
            'images.*.media_type'               => __('text.common.media_type'),
            'images.*.alt'                      => __('text.common.alt'),
            'files.*.id'                        => __('text.crud.id'),
            'files.*.media_type'                => __('text.common.media_type'),
        ];
    }
}
