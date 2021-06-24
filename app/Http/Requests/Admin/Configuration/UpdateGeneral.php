<?php

namespace App\Http\Requests\Admin\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneral extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'general_common_base_url'           => 'bail|required|url|max:255',
            'general_contact_phone'             => 'bail|string|max:255',
            'general_contact_cell_phone'        => 'bail|string|max:255',
            'general_contact_fax'               => 'bail|string|max:255',
            'general_contact_address'           => 'bail|string|max:255',
            'general_contact_e_mail'            => 'bail|string|max:255',
            'general_tags_google_analytics'     => 'bail|nullable|string',
            'general_tags_head_tags'            => 'bail|nullable|string',
            'general_tags_body_tags'            => 'bail|nullable|string',
            'general_tags_footer_tags'          => 'bail|nullable|string',
            //TODO Doğru link girildiğini doğrulamak için özel facebook, twitter kurallar oluştur
            'general_social_media_facebook'     => 'bail|url|max:255',
            'general_social_media_instagram'    => 'bail|url|max:255',
            'general_social_media_twitter'      => 'bail|url|max:255',
            'general_social_media_youtube'      => 'bail|url|max:255',
            'general_seo_title'                 => 'bail|string|max:255',
            'general_seo_description'           => 'bail|string|max:255',
            'general_seo_keywords'              => 'bail|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'general_common_base_url'           => __('text.configuration.common.base_url'),
            'general_contact_phone'             => __('text.configuration.contact.phone'),
            'general_contact_cell_phone'        => __('text.configuration.contact.cell_phone'),
            'general_contact_fax'               => __('text.configuration.contact.fax'),
            'general_contact_address'           => __('text.configuration.contact.address'),
            'general_contact_e_mail'            => __('text.configuration.contact.e_mail'),
            'general_tags_google_analytics'     => __('text.configuration.tags.google_analytics'),
            'general_tags_head_tags'            => __('text.configuration.tags.head_tags'),
            'general_tags_body_tags'            => __('text.configuration.tags.body_tags'),
            'general_tags_footer_tags'          => __('text.configuration.tags.footer_tags'),
            'general_social_media_facebook'     => __('text.configuration.social_media.facebook'),
            'general_social_media_instagram'    => __('text.configuration.social_media.instagram'),
            'general_social_media_twitter'      => __('text.configuration.social_media.twitter'),
            'general_social_media_youtube'      => __('text.configuration.social_media.youtube'),
            'general_seo_title'                 => __('text.configuration.seo.title'),
            'general_seo_description'           => __('text.configuration.seo.description'),
            'general_seo_keywords'              => __('text.configuration.seo.keywords'),
        ];
    }
}
