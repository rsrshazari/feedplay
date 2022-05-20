<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/analytics/admin/v1alpha/resources.proto

namespace Google\Analytics\Admin\V1alpha;

use UnexpectedValueException;

/**
 * Types of actions that may change a resource.
 *
 * Protobuf type <code>google.analytics.admin.v1alpha.ActionType</code>
 */
class ActionType
{
    /**
     * Action type unknown or not specified.
     *
     * Generated from protobuf enum <code>ACTION_TYPE_UNSPECIFIED = 0;</code>
     */
    const ACTION_TYPE_UNSPECIFIED = 0;
    /**
     * Resource was created in this change.
     *
     * Generated from protobuf enum <code>CREATED = 1;</code>
     */
    const CREATED = 1;
    /**
     * Resource was updated in this change.
     *
     * Generated from protobuf enum <code>UPDATED = 2;</code>
     */
    const UPDATED = 2;
    /**
     * Resource was deleted in this change.
     *
     * Generated from protobuf enum <code>DELETED = 3;</code>
     */
    const DELETED = 3;

    private static $valueToName = [
        self::ACTION_TYPE_UNSPECIFIED => 'ACTION_TYPE_UNSPECIFIED',
        self::CREATED => 'CREATED',
        self::UPDATED => 'UPDATED',
        self::DELETED => 'DELETED',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

