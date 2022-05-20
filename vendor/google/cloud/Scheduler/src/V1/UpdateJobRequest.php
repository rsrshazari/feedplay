<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/scheduler/v1/cloudscheduler.proto

namespace Google\Cloud\Scheduler\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for [UpdateJob][google.cloud.scheduler.v1.CloudScheduler.UpdateJob].
 *
 * Generated from protobuf message <code>google.cloud.scheduler.v1.UpdateJobRequest</code>
 */
class UpdateJobRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The new job properties. [name][google.cloud.scheduler.v1.Job.name] must be specified.
     * Output only fields cannot be modified using UpdateJob.
     * Any value specified for an output only field will be ignored.
     *
     * Generated from protobuf field <code>.google.cloud.scheduler.v1.Job job = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $job = null;
    /**
     * A  mask used to specify which fields of the job are being updated.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $update_mask = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Scheduler\V1\Job $job
     *           Required. The new job properties. [name][google.cloud.scheduler.v1.Job.name] must be specified.
     *           Output only fields cannot be modified using UpdateJob.
     *           Any value specified for an output only field will be ignored.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           A  mask used to specify which fields of the job are being updated.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Scheduler\V1\Cloudscheduler::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The new job properties. [name][google.cloud.scheduler.v1.Job.name] must be specified.
     * Output only fields cannot be modified using UpdateJob.
     * Any value specified for an output only field will be ignored.
     *
     * Generated from protobuf field <code>.google.cloud.scheduler.v1.Job job = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Scheduler\V1\Job|null
     */
    public function getJob()
    {
        return $this->job;
    }

    public function hasJob()
    {
        return isset($this->job);
    }

    public function clearJob()
    {
        unset($this->job);
    }

    /**
     * Required. The new job properties. [name][google.cloud.scheduler.v1.Job.name] must be specified.
     * Output only fields cannot be modified using UpdateJob.
     * Any value specified for an output only field will be ignored.
     *
     * Generated from protobuf field <code>.google.cloud.scheduler.v1.Job job = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Scheduler\V1\Job $var
     * @return $this
     */
    public function setJob($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Scheduler\V1\Job::class);
        $this->job = $var;

        return $this;
    }

    /**
     * A  mask used to specify which fields of the job are being updated.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Protobuf\FieldMask|null
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }

    public function hasUpdateMask()
    {
        return isset($this->update_mask);
    }

    public function clearUpdateMask()
    {
        unset($this->update_mask);
    }

    /**
     * A  mask used to specify which fields of the job are being updated.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

}

