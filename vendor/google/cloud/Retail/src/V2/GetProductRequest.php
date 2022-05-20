<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/retail/v2/product_service.proto

namespace Google\Cloud\Retail\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for [GetProduct][] method.
 *
 * Generated from protobuf message <code>google.cloud.retail.v2.GetProductRequest</code>
 */
class GetProductRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. Full resource name of [Product][google.cloud.retail.v2.Product],
     * such as
     * `projects/&#42;&#47;locations/global/catalogs/default_catalog/branches/default_branch/products/some_product_id`.
     * If the caller does not have permission to access the
     * [Product][google.cloud.retail.v2.Product], regardless of whether or not it
     * exists, a PERMISSION_DENIED error is returned.
     * If the requested [Product][google.cloud.retail.v2.Product] does not exist,
     * a NOT_FOUND error is returned.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $name = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           Required. Full resource name of [Product][google.cloud.retail.v2.Product],
     *           such as
     *           `projects/&#42;&#47;locations/global/catalogs/default_catalog/branches/default_branch/products/some_product_id`.
     *           If the caller does not have permission to access the
     *           [Product][google.cloud.retail.v2.Product], regardless of whether or not it
     *           exists, a PERMISSION_DENIED error is returned.
     *           If the requested [Product][google.cloud.retail.v2.Product] does not exist,
     *           a NOT_FOUND error is returned.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Retail\V2\ProductService::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. Full resource name of [Product][google.cloud.retail.v2.Product],
     * such as
     * `projects/&#42;&#47;locations/global/catalogs/default_catalog/branches/default_branch/products/some_product_id`.
     * If the caller does not have permission to access the
     * [Product][google.cloud.retail.v2.Product], regardless of whether or not it
     * exists, a PERMISSION_DENIED error is returned.
     * If the requested [Product][google.cloud.retail.v2.Product] does not exist,
     * a NOT_FOUND error is returned.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Required. Full resource name of [Product][google.cloud.retail.v2.Product],
     * such as
     * `projects/&#42;&#47;locations/global/catalogs/default_catalog/branches/default_branch/products/some_product_id`.
     * If the caller does not have permission to access the
     * [Product][google.cloud.retail.v2.Product], regardless of whether or not it
     * exists, a PERMISSION_DENIED error is returned.
     * If the requested [Product][google.cloud.retail.v2.Product] does not exist,
     * a NOT_FOUND error is returned.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

}

