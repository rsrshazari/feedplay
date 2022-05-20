<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/assuredworkloads/v1beta1/assuredworkloads_v1beta1.proto

namespace Google\Cloud\AssuredWorkloads\V1beta1\Workload;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Settings specific to the Key Management Service.
 *
 * Generated from protobuf message <code>google.cloud.assuredworkloads.v1beta1.Workload.KMSSettings</code>
 */
class KMSSettings extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. Input only. Immutable. The time at which the Key Management
     * Service will automatically create a new version of the crypto key and
     * mark it as the primary.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp next_rotation_time = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.field_behavior) = INPUT_ONLY, (.google.api.field_behavior) = IMMUTABLE];</code>
     */
    private $next_rotation_time = null;
    /**
     * Required. Input only. Immutable. [next_rotation_time] will be advanced by
     * this period when the Key Management Service automatically rotates a key.
     * Must be at least 24 hours and at most 876,000 hours.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration rotation_period = 2 [(.google.api.field_behavior) = REQUIRED, (.google.api.field_behavior) = INPUT_ONLY, (.google.api.field_behavior) = IMMUTABLE];</code>
     */
    private $rotation_period = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Timestamp $next_rotation_time
     *           Required. Input only. Immutable. The time at which the Key Management
     *           Service will automatically create a new version of the crypto key and
     *           mark it as the primary.
     *     @type \Google\Protobuf\Duration $rotation_period
     *           Required. Input only. Immutable. [next_rotation_time] will be advanced by
     *           this period when the Key Management Service automatically rotates a key.
     *           Must be at least 24 hours and at most 876,000 hours.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Assuredworkloads\V1Beta1\AssuredworkloadsV1Beta1::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. Input only. Immutable. The time at which the Key Management
     * Service will automatically create a new version of the crypto key and
     * mark it as the primary.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp next_rotation_time = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.field_behavior) = INPUT_ONLY, (.google.api.field_behavior) = IMMUTABLE];</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getNextRotationTime()
    {
        return $this->next_rotation_time;
    }

    public function hasNextRotationTime()
    {
        return isset($this->next_rotation_time);
    }

    public function clearNextRotationTime()
    {
        unset($this->next_rotation_time);
    }

    /**
     * Required. Input only. Immutable. The time at which the Key Management
     * Service will automatically create a new version of the crypto key and
     * mark it as the primary.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp next_rotation_time = 1 [(.google.api.field_behavior) = REQUIRED, (.google.api.field_behavior) = INPUT_ONLY, (.google.api.field_behavior) = IMMUTABLE];</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setNextRotationTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->next_rotation_time = $var;

        return $this;
    }

    /**
     * Required. Input only. Immutable. [next_rotation_time] will be advanced by
     * this period when the Key Management Service automatically rotates a key.
     * Must be at least 24 hours and at most 876,000 hours.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration rotation_period = 2 [(.google.api.field_behavior) = REQUIRED, (.google.api.field_behavior) = INPUT_ONLY, (.google.api.field_behavior) = IMMUTABLE];</code>
     * @return \Google\Protobuf\Duration|null
     */
    public function getRotationPeriod()
    {
        return $this->rotation_period;
    }

    public function hasRotationPeriod()
    {
        return isset($this->rotation_period);
    }

    public function clearRotationPeriod()
    {
        unset($this->rotation_period);
    }

    /**
     * Required. Input only. Immutable. [next_rotation_time] will be advanced by
     * this period when the Key Management Service automatically rotates a key.
     * Must be at least 24 hours and at most 876,000 hours.
     *
     * Generated from protobuf field <code>.google.protobuf.Duration rotation_period = 2 [(.google.api.field_behavior) = REQUIRED, (.google.api.field_behavior) = INPUT_ONLY, (.google.api.field_behavior) = IMMUTABLE];</code>
     * @param \Google\Protobuf\Duration $var
     * @return $this
     */
    public function setRotationPeriod($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Duration::class);
        $this->rotation_period = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(KMSSettings::class, \Google\Cloud\AssuredWorkloads\V1beta1\Workload_KMSSettings::class);

