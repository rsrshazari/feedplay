<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The request message for listing DLP jobs.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.ListDlpJobsRequest</code>
 */
class ListDlpJobsRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. Parent resource name.
     * The format of this value varies depending on whether you have [specified a
     * processing
     * location](https://cloud.google.com/dlp/docs/specifying-location):
     * + Projects scope, location specified:<br/>
     *   `projects/`<var>PROJECT_ID</var>`/locations/`<var>LOCATION_ID</var>
     * + Projects scope, no location specified (defaults to global):<br/>
     *   `projects/`<var>PROJECT_ID</var>
     * The following example `parent` string specifies a parent project with the
     * identifier `example-project`, and specifies the `europe-west3` location
     * for processing data:
     *     parent=projects/example-project/locations/europe-west3
     *
     * Generated from protobuf field <code>string parent = 4 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     */
    private $parent = '';
    /**
     * Allows filtering.
     * Supported syntax:
     * * Filter expressions are made up of one or more restrictions.
     * * Restrictions can be combined by `AND` or `OR` logical operators. A
     * sequence of restrictions implicitly uses `AND`.
     * * A restriction has the form of `{field} {operator} {value}`.
     * * Supported fields/values for inspect jobs:
     *     - `state` - PENDING|RUNNING|CANCELED|FINISHED|FAILED
     *     - `inspected_storage` - DATASTORE|CLOUD_STORAGE|BIGQUERY
     *     - `trigger_name` - The resource name of the trigger that created job.
     *     - 'end_time` - Corresponds to time the job finished.
     *     - 'start_time` - Corresponds to time the job finished.
     * * Supported fields for risk analysis jobs:
     *     - `state` - RUNNING|CANCELED|FINISHED|FAILED
     *     - 'end_time` - Corresponds to time the job finished.
     *     - 'start_time` - Corresponds to time the job finished.
     * * The operator must be `=` or `!=`.
     * Examples:
     * * inspected_storage = cloud_storage AND state = done
     * * inspected_storage = cloud_storage OR inspected_storage = bigquery
     * * inspected_storage = cloud_storage AND (state = done OR state = canceled)
     * * end_time > \"2017-12-12T00:00:00+00:00\"
     * The length of this field should be no more than 500 characters.
     *
     * Generated from protobuf field <code>string filter = 1;</code>
     */
    private $filter = '';
    /**
     * The standard list page size.
     *
     * Generated from protobuf field <code>int32 page_size = 2;</code>
     */
    private $page_size = 0;
    /**
     * The standard list page token.
     *
     * Generated from protobuf field <code>string page_token = 3;</code>
     */
    private $page_token = '';
    /**
     * The type of job. Defaults to `DlpJobType.INSPECT`
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.DlpJobType type = 5;</code>
     */
    private $type = 0;
    /**
     * Comma separated list of fields to order by,
     * followed by `asc` or `desc` postfix. This list is case-insensitive,
     * default sorting order is ascending, redundant space characters are
     * insignificant.
     * Example: `name asc, end_time asc, create_time desc`
     * Supported fields are:
     * - `create_time`: corresponds to time the job was created.
     * - `end_time`: corresponds to time the job ended.
     * - `name`: corresponds to job's name.
     * - `state`: corresponds to `state`
     *
     * Generated from protobuf field <code>string order_by = 6;</code>
     */
    private $order_by = '';
    /**
     * Deprecated. This field has no effect.
     *
     * Generated from protobuf field <code>string location_id = 7;</code>
     */
    private $location_id = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           Required. Parent resource name.
     *           The format of this value varies depending on whether you have [specified a
     *           processing
     *           location](https://cloud.google.com/dlp/docs/specifying-location):
     *           + Projects scope, location specified:<br/>
     *             `projects/`<var>PROJECT_ID</var>`/locations/`<var>LOCATION_ID</var>
     *           + Projects scope, no location specified (defaults to global):<br/>
     *             `projects/`<var>PROJECT_ID</var>
     *           The following example `parent` string specifies a parent project with the
     *           identifier `example-project`, and specifies the `europe-west3` location
     *           for processing data:
     *               parent=projects/example-project/locations/europe-west3
     *     @type string $filter
     *           Allows filtering.
     *           Supported syntax:
     *           * Filter expressions are made up of one or more restrictions.
     *           * Restrictions can be combined by `AND` or `OR` logical operators. A
     *           sequence of restrictions implicitly uses `AND`.
     *           * A restriction has the form of `{field} {operator} {value}`.
     *           * Supported fields/values for inspect jobs:
     *               - `state` - PENDING|RUNNING|CANCELED|FINISHED|FAILED
     *               - `inspected_storage` - DATASTORE|CLOUD_STORAGE|BIGQUERY
     *               - `trigger_name` - The resource name of the trigger that created job.
     *               - 'end_time` - Corresponds to time the job finished.
     *               - 'start_time` - Corresponds to time the job finished.
     *           * Supported fields for risk analysis jobs:
     *               - `state` - RUNNING|CANCELED|FINISHED|FAILED
     *               - 'end_time` - Corresponds to time the job finished.
     *               - 'start_time` - Corresponds to time the job finished.
     *           * The operator must be `=` or `!=`.
     *           Examples:
     *           * inspected_storage = cloud_storage AND state = done
     *           * inspected_storage = cloud_storage OR inspected_storage = bigquery
     *           * inspected_storage = cloud_storage AND (state = done OR state = canceled)
     *           * end_time > \"2017-12-12T00:00:00+00:00\"
     *           The length of this field should be no more than 500 characters.
     *     @type int $page_size
     *           The standard list page size.
     *     @type string $page_token
     *           The standard list page token.
     *     @type int $type
     *           The type of job. Defaults to `DlpJobType.INSPECT`
     *     @type string $order_by
     *           Comma separated list of fields to order by,
     *           followed by `asc` or `desc` postfix. This list is case-insensitive,
     *           default sorting order is ascending, redundant space characters are
     *           insignificant.
     *           Example: `name asc, end_time asc, create_time desc`
     *           Supported fields are:
     *           - `create_time`: corresponds to time the job was created.
     *           - `end_time`: corresponds to time the job ended.
     *           - `name`: corresponds to job's name.
     *           - `state`: corresponds to `state`
     *     @type string $location_id
     *           Deprecated. This field has no effect.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. Parent resource name.
     * The format of this value varies depending on whether you have [specified a
     * processing
     * location](https://cloud.google.com/dlp/docs/specifying-location):
     * + Projects scope, location specified:<br/>
     *   `projects/`<var>PROJECT_ID</var>`/locations/`<var>LOCATION_ID</var>
     * + Projects scope, no location specified (defaults to global):<br/>
     *   `projects/`<var>PROJECT_ID</var>
     * The following example `parent` string specifies a parent project with the
     * identifier `example-project`, and specifies the `europe-west3` location
     * for processing data:
     *     parent=projects/example-project/locations/europe-west3
     *
     * Generated from protobuf field <code>string parent = 4 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Required. Parent resource name.
     * The format of this value varies depending on whether you have [specified a
     * processing
     * location](https://cloud.google.com/dlp/docs/specifying-location):
     * + Projects scope, location specified:<br/>
     *   `projects/`<var>PROJECT_ID</var>`/locations/`<var>LOCATION_ID</var>
     * + Projects scope, no location specified (defaults to global):<br/>
     *   `projects/`<var>PROJECT_ID</var>
     * The following example `parent` string specifies a parent project with the
     * identifier `example-project`, and specifies the `europe-west3` location
     * for processing data:
     *     parent=projects/example-project/locations/europe-west3
     *
     * Generated from protobuf field <code>string parent = 4 [(.google.api.field_behavior) = REQUIRED, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * Allows filtering.
     * Supported syntax:
     * * Filter expressions are made up of one or more restrictions.
     * * Restrictions can be combined by `AND` or `OR` logical operators. A
     * sequence of restrictions implicitly uses `AND`.
     * * A restriction has the form of `{field} {operator} {value}`.
     * * Supported fields/values for inspect jobs:
     *     - `state` - PENDING|RUNNING|CANCELED|FINISHED|FAILED
     *     - `inspected_storage` - DATASTORE|CLOUD_STORAGE|BIGQUERY
     *     - `trigger_name` - The resource name of the trigger that created job.
     *     - 'end_time` - Corresponds to time the job finished.
     *     - 'start_time` - Corresponds to time the job finished.
     * * Supported fields for risk analysis jobs:
     *     - `state` - RUNNING|CANCELED|FINISHED|FAILED
     *     - 'end_time` - Corresponds to time the job finished.
     *     - 'start_time` - Corresponds to time the job finished.
     * * The operator must be `=` or `!=`.
     * Examples:
     * * inspected_storage = cloud_storage AND state = done
     * * inspected_storage = cloud_storage OR inspected_storage = bigquery
     * * inspected_storage = cloud_storage AND (state = done OR state = canceled)
     * * end_time > \"2017-12-12T00:00:00+00:00\"
     * The length of this field should be no more than 500 characters.
     *
     * Generated from protobuf field <code>string filter = 1;</code>
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Allows filtering.
     * Supported syntax:
     * * Filter expressions are made up of one or more restrictions.
     * * Restrictions can be combined by `AND` or `OR` logical operators. A
     * sequence of restrictions implicitly uses `AND`.
     * * A restriction has the form of `{field} {operator} {value}`.
     * * Supported fields/values for inspect jobs:
     *     - `state` - PENDING|RUNNING|CANCELED|FINISHED|FAILED
     *     - `inspected_storage` - DATASTORE|CLOUD_STORAGE|BIGQUERY
     *     - `trigger_name` - The resource name of the trigger that created job.
     *     - 'end_time` - Corresponds to time the job finished.
     *     - 'start_time` - Corresponds to time the job finished.
     * * Supported fields for risk analysis jobs:
     *     - `state` - RUNNING|CANCELED|FINISHED|FAILED
     *     - 'end_time` - Corresponds to time the job finished.
     *     - 'start_time` - Corresponds to time the job finished.
     * * The operator must be `=` or `!=`.
     * Examples:
     * * inspected_storage = cloud_storage AND state = done
     * * inspected_storage = cloud_storage OR inspected_storage = bigquery
     * * inspected_storage = cloud_storage AND (state = done OR state = canceled)
     * * end_time > \"2017-12-12T00:00:00+00:00\"
     * The length of this field should be no more than 500 characters.
     *
     * Generated from protobuf field <code>string filter = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFilter($var)
    {
        GPBUtil::checkString($var, True);
        $this->filter = $var;

        return $this;
    }

    /**
     * The standard list page size.
     *
     * Generated from protobuf field <code>int32 page_size = 2;</code>
     * @return int
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * The standard list page size.
     *
     * Generated from protobuf field <code>int32 page_size = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setPageSize($var)
    {
        GPBUtil::checkInt32($var);
        $this->page_size = $var;

        return $this;
    }

    /**
     * The standard list page token.
     *
     * Generated from protobuf field <code>string page_token = 3;</code>
     * @return string
     */
    public function getPageToken()
    {
        return $this->page_token;
    }

    /**
     * The standard list page token.
     *
     * Generated from protobuf field <code>string page_token = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->page_token = $var;

        return $this;
    }

    /**
     * The type of job. Defaults to `DlpJobType.INSPECT`
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.DlpJobType type = 5;</code>
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The type of job. Defaults to `DlpJobType.INSPECT`
     *
     * Generated from protobuf field <code>.google.privacy.dlp.v2.DlpJobType type = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Dlp\V2\DlpJobType::class);
        $this->type = $var;

        return $this;
    }

    /**
     * Comma separated list of fields to order by,
     * followed by `asc` or `desc` postfix. This list is case-insensitive,
     * default sorting order is ascending, redundant space characters are
     * insignificant.
     * Example: `name asc, end_time asc, create_time desc`
     * Supported fields are:
     * - `create_time`: corresponds to time the job was created.
     * - `end_time`: corresponds to time the job ended.
     * - `name`: corresponds to job's name.
     * - `state`: corresponds to `state`
     *
     * Generated from protobuf field <code>string order_by = 6;</code>
     * @return string
     */
    public function getOrderBy()
    {
        return $this->order_by;
    }

    /**
     * Comma separated list of fields to order by,
     * followed by `asc` or `desc` postfix. This list is case-insensitive,
     * default sorting order is ascending, redundant space characters are
     * insignificant.
     * Example: `name asc, end_time asc, create_time desc`
     * Supported fields are:
     * - `create_time`: corresponds to time the job was created.
     * - `end_time`: corresponds to time the job ended.
     * - `name`: corresponds to job's name.
     * - `state`: corresponds to `state`
     *
     * Generated from protobuf field <code>string order_by = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setOrderBy($var)
    {
        GPBUtil::checkString($var, True);
        $this->order_by = $var;

        return $this;
    }

    /**
     * Deprecated. This field has no effect.
     *
     * Generated from protobuf field <code>string location_id = 7;</code>
     * @return string
     */
    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * Deprecated. This field has no effect.
     *
     * Generated from protobuf field <code>string location_id = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setLocationId($var)
    {
        GPBUtil::checkString($var, True);
        $this->location_id = $var;

        return $this;
    }

}

