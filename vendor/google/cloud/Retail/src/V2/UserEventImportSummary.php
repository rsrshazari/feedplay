<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/retail/v2/import_config.proto

namespace Google\Cloud\Retail\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A summary of import result. The UserEventImportSummary summarizes
 * the import status for user events.
 *
 * Generated from protobuf message <code>google.cloud.retail.v2.UserEventImportSummary</code>
 */
class UserEventImportSummary extends \Google\Protobuf\Internal\Message
{
    /**
     * Count of user events imported with complete existing catalog information.
     *
     * Generated from protobuf field <code>int64 joined_events_count = 1;</code>
     */
    private $joined_events_count = 0;
    /**
     * Count of user events imported, but with catalog information not found
     * in the imported catalog.
     *
     * Generated from protobuf field <code>int64 unjoined_events_count = 2;</code>
     */
    private $unjoined_events_count = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $joined_events_count
     *           Count of user events imported with complete existing catalog information.
     *     @type int|string $unjoined_events_count
     *           Count of user events imported, but with catalog information not found
     *           in the imported catalog.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Retail\V2\ImportConfig::initOnce();
        parent::__construct($data);
    }

    /**
     * Count of user events imported with complete existing catalog information.
     *
     * Generated from protobuf field <code>int64 joined_events_count = 1;</code>
     * @return int|string
     */
    public function getJoinedEventsCount()
    {
        return $this->joined_events_count;
    }

    /**
     * Count of user events imported with complete existing catalog information.
     *
     * Generated from protobuf field <code>int64 joined_events_count = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setJoinedEventsCount($var)
    {
        GPBUtil::checkInt64($var);
        $this->joined_events_count = $var;

        return $this;
    }

    /**
     * Count of user events imported, but with catalog information not found
     * in the imported catalog.
     *
     * Generated from protobuf field <code>int64 unjoined_events_count = 2;</code>
     * @return int|string
     */
    public function getUnjoinedEventsCount()
    {
        return $this->unjoined_events_count;
    }

    /**
     * Count of user events imported, but with catalog information not found
     * in the imported catalog.
     *
     * Generated from protobuf field <code>int64 unjoined_events_count = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setUnjoinedEventsCount($var)
    {
        GPBUtil::checkInt64($var);
        $this->unjoined_events_count = $var;

        return $this;
    }

}

