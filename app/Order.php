<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Order
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $commission
 * @property int $installment
 * @property float $subtotal
 * @property float $tax
 * @property float $discount
 * @property float $total
 * @property string $payment_currency
 * @property float $currency_subtotal
 * @property float $currency_tax
 * @property float $currency_total
 * @property float $exchange_rate
 * @property string $exchange_currency
 * @property string $reference_no
 * @property string|null $shipping_tracking_code
 * @property int|null $is_gift
 * @property int $shipping_company_id
 * @property int $shipping_status_id
 * @property int $delivery_country_id
 * @property int $delivery_province_id
 * @property int $delivery_district_id
 * @property string $delivery_name
 * @property string $delivery_address
 * @property string $delivery_telephone
 * @property string $delivery_zip_code
 * @property int $invoice_country_id
 * @property int $invoice_province_id
 * @property int $invoice_district_id
 * @property string $invoice_name
 * @property string $invoice_address
 * @property string $invoice_telephone
 * @property string $invoice_zip_code
 * @property string $invoice_tax_office
 * @property string $invoice_tax_number
 * @property int $payment_type_id
 * @property int $payment_status_id
 * @property int $order_status_id
 * @property int $is_invoiced
 * @property \Illuminate\Support\Carbon|null $shipping_at
 * @property \Illuminate\Support\Carbon|null $delivery_at
 * @property int $payment_status_processed_by
 * @property int $order_status_processed_by
 * @property int|null $invoiced_by
 * @property int|null $shipped_by
 * @property int|null $delivered_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCurrencySubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCurrencyTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCurrencyTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereExchangeCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInstallment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceTaxOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoiceZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereInvoicedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereIsGift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereIsInvoiced($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOrderStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOrderStatusProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePaymentCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePaymentStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePaymentStatusProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePaymentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereReferenceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShippedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShippingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShippingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShippingStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereShippingTrackingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $dates = [
        'shipping_at',
        'delivery_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @param string $value
     */
    public function setDeliveryNameAttribute(string $value): void
    {
        $this->attributes['delivery_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setDeliveryAddressAttribute(string $value): void
    {
        $this->attributes['delivery_address'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setInvoiceNameAttribute(string $value): void
    {
        $this->attributes['invoice_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setInvoiceAddressAttribute(string $value): void
    {
        $this->attributes['invoice_address'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param string $value
     */
    public function setInvoiceTaxOfficeAttribute(string $value): void
    {
        $this->attributes['invoice_tax_office'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
