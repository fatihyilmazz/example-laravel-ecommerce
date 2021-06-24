@extends('admin.layouts.app')

@php
    $pageTitle = __('text.configuration.name');

    $subHeaderTitle = __('text.configuration.name');
    $subHeaderBreadcrumbs = [['name' => __('text.configuration.general.general'), 'url' => route('admin.configuration.general.index'), 'is_active' => true]];
@endphp

@section('pageStyle')
    <link href="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    {{ html()->form('PUT', route('admin.configuration.general.update'))->open() }}

    <div class="kt-portlet kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{ __('text.configuration.common.common') }}
                </h3>
            </div>

            <div class="kt-portlet__head-toolbar">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>{{ __('text.crud.save') }}</button>
            </div>

        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    @if ($errors->any())
                        <div class="alert alert-danger fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning-sign"></i></div>
                            <div class="alert-text">{{ __('messages.info.operation.could_not_be_completed') }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="general_common_base_url" class="col-lg-2 col-form-label">{{ __('text.configuration.common.base_url') }}</label>
                        <div class="col-lg-10">
                            <input type="url" name="general_common_base_url" class="form-control @error('general_common_base_url') @enderror"
                                   value="{{ old('general_common_base_url', $settings['general_common_base_url']) }}"
                            >

                            @error('general_common_base_url') <x-alert type="error" :message="$message"/> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>

    <div class="kt-portlet kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-comments"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.configuration.contact.contact') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="general_contact_phone" class="col-lg-2 col-form-label">{{ __('text.configuration.contact.phone') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_contact_phone')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_contact_phone')])
                                    ->value(old('general_contact_phone', $settings['general_contact_phone']))
                                }}

                                @error('general_contact_phone') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_contact_cell_phone" class="col-lg-2 col-form-label">{{ __('text.configuration.contact.cell_phone') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_contact_cell_phone')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_contact_cell_phone')])
                                    ->value(old('general_contact_cell_phone', $settings['general_contact_cell_phone']))
                                }}

                                @error('general_contact_cell_phone') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_contact_fax" class="col-lg-2 col-form-label">{{ __('text.configuration.contact.fax') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_contact_fax')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_contact_fax')])
                                    ->value(old('contact.fax', $settings['general_contact_fax']))
                                }}

                                @error('general_contact_fax') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_contact_address" class="col-lg-2 col-form-label">{{ __('text.configuration.contact.address') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_contact_address')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_contact_address')])
                                    ->value(old('contact.address', $settings['general_contact_address']))
                                }}

                                @error('general_contact_address') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_contact_e_mail" class="col-lg-2 col-form-label">{{ __('text.configuration.contact.e_mail') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->email('general_contact_e_mail')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_contact_e_mail')])
                                    ->value(old('general_contact_e_mail', $settings['general_contact_e_mail']))
                                }}

                                @error('general_contact_e_mail') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-share-alt"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.configuration.social_media.social_media') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="general_social_media_facebook" class="col-lg-2 col-form-label">{{ __('text.configuration.social_media.facebook') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_social_media_facebook')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_social_media_facebook')])
                                    ->value(old('general_social_media_facebook', $settings['general_social_media_facebook']))
                                }}

                                @error('general_social_media_facebook') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_social_media_instagram" class="col-lg-2 col-form-label">{{ __('text.configuration.social_media.instagram') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_social_media_instagram')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_social_media_instagram')])
                                    ->value(old('general_social_media_instagram', $settings['general_social_media_instagram']))
                                }}

                                @error('general_social_media_instagram') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_social_media_twitter" class="col-lg-2 col-form-label">{{ __('text.configuration.social_media.twitter') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_social_media_twitter')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_social_media_twitter')])
                                    ->value(old('general_social_media_twitter', $settings['general_social_media_twitter']))
                                }}

                                @error('general_social_media_twitter') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_social_media_youtube" class="col-lg-2 col-form-label">{{ __('text.configuration.social_media.youtube') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_social_media_youtube')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_social_media_youtube')])
                                    ->value(old('general_social_media_youtube', $settings['general_social_media_youtube']))
                                }}

                                @error('general_social_media_youtube') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-code"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.configuration.tags.tags') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="general_tags_google_analytics" class="col-lg-2 col-form-label">{{ __('text.configuration.tags.google_analytics') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_tags_google_analytics')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_tags_google_analytics')])
                                    ->value(old('general_tags_google_analytics', $settings['general_tags_google_analytics']))
                                }}

                                @error('general_tags_google_analytics') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_tags_head_tags" class="col-lg-2 col-form-label">{{ __('text.configuration.tags.head_tags') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_tags_head_tags')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_tags_head_tags')])
                                    ->value(old('general_tags_head_tags', $settings['general_tags_head_tags']))
                                }}

                                @error('general_tags_head_tags') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_tags_body_tags" class="col-lg-2 col-form-label">{{ __('text.configuration.tags.body_tags') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_tags_body_tags')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_tags_body_tags')])
                                    ->value(old('general_tags_body_tags', $settings['general_tags_body_tags']))
                                }}

                                @error('general_tags_body_tags') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_tags_footer_tags" class="col-lg-2 col-form-label">{{ __('text.configuration.tags.footer_tags') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_tags_footer_tags')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_tags_footer_tags')])
                                    ->value(old('general_tags_footer_tags', $settings['general_tags_footer_tags']))
                                }}

                                @error('general_tags_footer_tags') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet kt-portlet--last kt-portlet--head-lg" data-ktportlet="true" id="kt_portlet_tools_4">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <i class="fa fa-search"></i>&nbsp;
                <h3 class="kt-portlet__head-title">
                    {{ __('text.configuration.seo.seo') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="javascript:void(0)" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-brand btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__content">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="form-group row">
                            <label for="general_seo_title" class="col-lg-2 col-form-label">{{ __('text.configuration.seo.title') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_seo_title')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_seo_title')])
                                    ->value(old('general_seo_name', $settings['general_seo_title']))
                                }}

                                @error('general_seo_title') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_seo_description" class="col-lg-2 col-form-label">{{ __('text.configuration.seo.description') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_seo_description')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_seo_description')])
                                    ->value(old('general_seo_name', $settings['general_seo_description']))
                                }}

                                @error('general_seo_description') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="general_seo_keywords" class="col-lg-2 col-form-label">{{ __('text.configuration.seo.keywords') }}</label>
                            <div class="col-lg-10">
                                {{ html()
                                    ->text('general_seo_keywords')
                                    ->class(['form-control', 'is-invalid' => $errors->has('general_seo_keywords')])
                                    ->value(old('general_seo_keywords', $settings['general_seo_keywords']))
                                }}

                                @error('general_seo_keywords') <x-alert type="error" :message="$message"/> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>

    {{ html()->form()->close() }}
@stop

@section('pageScript')
    <script src="{{asset('admin/assets/custom/bootstrap-toggle_v2.2.2/bootstrap-toggle.min.js')}}" type="text/javascript"></script>
@endsection
