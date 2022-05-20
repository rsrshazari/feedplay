<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/contactcenterinsights/v1/resources.proto

namespace Google\Cloud\ContactCenterInsights\V1\IssueModelLabelStats;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Aggregated statistics about an issue.
 *
 * Generated from protobuf message <code>google.cloud.contactcenterinsights.v1.IssueModelLabelStats.IssueStats</code>
 */
class IssueStats extends \Google\Protobuf\Internal\Message
{
    /**
     * Issue resource.
     * Format:
     * projects/{project}/locations/{location}/issueModels/{issue_model}/issues/{issue}
     *
     * Generated from protobuf field <code>string issue = 1;</code>
     */
    private $issue = '';
    /**
     * Number of conversations attached to the issue at this point in time.
     *
     * Generated from protobuf field <code>int64 labeled_conversations_count = 2;</code>
     */
    private $labeled_conversations_count = 0;
    /**
     * Display name of the issue.
     *
     * Generated from protobuf field <code>string display_name = 3;</code>
     */
    private $display_name = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $issue
     *           Issue resource.
     *           Format:
     *           projects/{project}/locations/{location}/issueModels/{issue_model}/issues/{issue}
     *     @type int|string $labeled_conversations_count
     *           Number of conversations attached to the issue at this point in time.
     *     @type string $display_name
     *           Display name of the issue.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Contactcenterinsights\V1\Resources::initOnce();
        parent::__construct($data);
    }

    /**
     * Issue resource.
     * Format:
     * projects/{project}/locations/{location}/issueModels/{issue_model}/issues/{issue}
     *
     * Generated from protobuf field <code>string issue = 1;</code>
     * @return string
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Issue resource.
     * Format:
     * projects/{project}/locations/{location}/issueModels/{issue_model}/issues/{issue}
     *
     * Generated from protobuf field <code>string issue = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setIssue($var)
    {
        GPBUtil::checkString($var, True);
        $this->issue = $var;

        return $this;
    }

    /**
     * Number of conversations attached to the issue at this point in time.
     *
     * Generated from protobuf field <code>int64 labeled_conversations_count = 2;</code>
     * @return int|string
     */
    public function getLabeledConversationsCount()
    {
        return $this->labeled_conversations_count;
    }

    /**
     * Number of conversations attached to the issue at this point in time.
     *
     * Generated from protobuf field <code>int64 labeled_conversations_count = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setLabeledConversationsCount($var)
    {
        GPBUtil::checkInt64($var);
        $this->labeled_conversations_count = $var;

        return $this;
    }

    /**
     * Display name of the issue.
     *
     * Generated from protobuf field <code>string display_name = 3;</code>
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Display name of the issue.
     *
     * Generated from protobuf field <code>string display_name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setDisplayName($var)
    {
        GPBUtil::checkString($var, True);
        $this->display_name = $var;

        return $this;
    }

}


