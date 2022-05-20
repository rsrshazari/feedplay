<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/sql/v1beta4/cloud_sql_resources.proto

namespace Google\Cloud\Sql\V1beta4;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * An Operation resource.&nbsp;For successful operations that return an
 * Operation resource, only the fields relevant to the operation are populated
 * in the resource.
 *
 * Generated from protobuf message <code>google.cloud.sql.v1beta4.Operation</code>
 */
class Operation extends \Google\Protobuf\Internal\Message
{
    /**
     * This is always <b>sql#operation</b>.
     *
     * Generated from protobuf field <code>string kind = 1;</code>
     */
    private $kind = '';
    /**
     * Generated from protobuf field <code>string target_link = 2;</code>
     */
    private $target_link = '';
    /**
     * The status of an operation. Valid values are:
     * <br><b>PENDING</b>
     * <br><b>RUNNING</b>
     * <br><b>DONE</b>
     * <br><b>SQL_OPERATION_STATUS_UNSPECIFIED</b>
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.Operation.SqlOperationStatus status = 3;</code>
     */
    private $status = 0;
    /**
     * The email address of the user who initiated this operation.
     *
     * Generated from protobuf field <code>string user = 4;</code>
     */
    private $user = '';
    /**
     * The time this operation was enqueued in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp insert_time = 5;</code>
     */
    private $insert_time = null;
    /**
     * The time this operation actually started in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 6;</code>
     */
    private $start_time = null;
    /**
     * The time this operation finished in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 7;</code>
     */
    private $end_time = null;
    /**
     * If errors occurred during processing of this operation, this field will be
     * populated.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.OperationErrors error = 8;</code>
     */
    private $error = null;
    /**
     * The type of the operation. Valid values are:
     * <br><b>CREATE</b>
     * <br><b>DELETE</b>
     * <br><b>UPDATE</b>
     * <br><b>RESTART</b>
     * <br><b>IMPORT</b>
     * <br><b>EXPORT</b>
     * <br><b>BACKUP_VOLUME</b>
     * <br><b>RESTORE_VOLUME</b>
     * <br><b>CREATE_USER</b>
     * <br><b>DELETE_USER</b>
     * <br><b>CREATE_DATABASE</b>
     * <br><b>DELETE_DATABASE</b>
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.Operation.SqlOperationType operation_type = 9;</code>
     */
    private $operation_type = 0;
    /**
     * The context for import operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.ImportContext import_context = 10;</code>
     */
    private $import_context = null;
    /**
     * The context for export operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.ExportContext export_context = 11;</code>
     */
    private $export_context = null;
    /**
     * The context for backup operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.BackupContext backup_context = 17;</code>
     */
    private $backup_context = null;
    /**
     * An identifier that uniquely identifies the operation. You can use this
     * identifier to retrieve the Operations resource that has information about
     * the operation.
     *
     * Generated from protobuf field <code>string name = 12;</code>
     */
    private $name = '';
    /**
     * Name of the database instance related to this operation.
     *
     * Generated from protobuf field <code>string target_id = 13;</code>
     */
    private $target_id = '';
    /**
     * The URI of this resource.
     *
     * Generated from protobuf field <code>string self_link = 14;</code>
     */
    private $self_link = '';
    /**
     * The project ID of the target instance related to this operation.
     *
     * Generated from protobuf field <code>string target_project = 15;</code>
     */
    private $target_project = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $kind
     *           This is always <b>sql#operation</b>.
     *     @type string $target_link
     *     @type int $status
     *           The status of an operation. Valid values are:
     *           <br><b>PENDING</b>
     *           <br><b>RUNNING</b>
     *           <br><b>DONE</b>
     *           <br><b>SQL_OPERATION_STATUS_UNSPECIFIED</b>
     *     @type string $user
     *           The email address of the user who initiated this operation.
     *     @type \Google\Protobuf\Timestamp $insert_time
     *           The time this operation was enqueued in UTC timezone in <a
     *           href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     *           <b>2012-11-15T16:19:00.094Z</b>.
     *     @type \Google\Protobuf\Timestamp $start_time
     *           The time this operation actually started in UTC timezone in <a
     *           href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     *           <b>2012-11-15T16:19:00.094Z</b>.
     *     @type \Google\Protobuf\Timestamp $end_time
     *           The time this operation finished in UTC timezone in <a
     *           href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     *           <b>2012-11-15T16:19:00.094Z</b>.
     *     @type \Google\Cloud\Sql\V1beta4\OperationErrors $error
     *           If errors occurred during processing of this operation, this field will be
     *           populated.
     *     @type int $operation_type
     *           The type of the operation. Valid values are:
     *           <br><b>CREATE</b>
     *           <br><b>DELETE</b>
     *           <br><b>UPDATE</b>
     *           <br><b>RESTART</b>
     *           <br><b>IMPORT</b>
     *           <br><b>EXPORT</b>
     *           <br><b>BACKUP_VOLUME</b>
     *           <br><b>RESTORE_VOLUME</b>
     *           <br><b>CREATE_USER</b>
     *           <br><b>DELETE_USER</b>
     *           <br><b>CREATE_DATABASE</b>
     *           <br><b>DELETE_DATABASE</b>
     *     @type \Google\Cloud\Sql\V1beta4\ImportContext $import_context
     *           The context for import operation, if applicable.
     *     @type \Google\Cloud\Sql\V1beta4\ExportContext $export_context
     *           The context for export operation, if applicable.
     *     @type \Google\Cloud\Sql\V1beta4\BackupContext $backup_context
     *           The context for backup operation, if applicable.
     *     @type string $name
     *           An identifier that uniquely identifies the operation. You can use this
     *           identifier to retrieve the Operations resource that has information about
     *           the operation.
     *     @type string $target_id
     *           Name of the database instance related to this operation.
     *     @type string $self_link
     *           The URI of this resource.
     *     @type string $target_project
     *           The project ID of the target instance related to this operation.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Sql\V1Beta4\CloudSqlResources::initOnce();
        parent::__construct($data);
    }

    /**
     * This is always <b>sql#operation</b>.
     *
     * Generated from protobuf field <code>string kind = 1;</code>
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * This is always <b>sql#operation</b>.
     *
     * Generated from protobuf field <code>string kind = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setKind($var)
    {
        GPBUtil::checkString($var, True);
        $this->kind = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string target_link = 2;</code>
     * @return string
     */
    public function getTargetLink()
    {
        return $this->target_link;
    }

    /**
     * Generated from protobuf field <code>string target_link = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTargetLink($var)
    {
        GPBUtil::checkString($var, True);
        $this->target_link = $var;

        return $this;
    }

    /**
     * The status of an operation. Valid values are:
     * <br><b>PENDING</b>
     * <br><b>RUNNING</b>
     * <br><b>DONE</b>
     * <br><b>SQL_OPERATION_STATUS_UNSPECIFIED</b>
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.Operation.SqlOperationStatus status = 3;</code>
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * The status of an operation. Valid values are:
     * <br><b>PENDING</b>
     * <br><b>RUNNING</b>
     * <br><b>DONE</b>
     * <br><b>SQL_OPERATION_STATUS_UNSPECIFIED</b>
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.Operation.SqlOperationStatus status = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Sql\V1beta4\Operation\SqlOperationStatus::class);
        $this->status = $var;

        return $this;
    }

    /**
     * The email address of the user who initiated this operation.
     *
     * Generated from protobuf field <code>string user = 4;</code>
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * The email address of the user who initiated this operation.
     *
     * Generated from protobuf field <code>string user = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setUser($var)
    {
        GPBUtil::checkString($var, True);
        $this->user = $var;

        return $this;
    }

    /**
     * The time this operation was enqueued in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp insert_time = 5;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getInsertTime()
    {
        return $this->insert_time;
    }

    public function hasInsertTime()
    {
        return isset($this->insert_time);
    }

    public function clearInsertTime()
    {
        unset($this->insert_time);
    }

    /**
     * The time this operation was enqueued in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp insert_time = 5;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setInsertTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->insert_time = $var;

        return $this;
    }

    /**
     * The time this operation actually started in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 6;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    public function hasStartTime()
    {
        return isset($this->start_time);
    }

    public function clearStartTime()
    {
        unset($this->start_time);
    }

    /**
     * The time this operation actually started in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 6;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setStartTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->start_time = $var;

        return $this;
    }

    /**
     * The time this operation finished in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 7;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    public function hasEndTime()
    {
        return isset($this->end_time);
    }

    public function clearEndTime()
    {
        unset($this->end_time);
    }

    /**
     * The time this operation finished in UTC timezone in <a
     * href="https://tools.ietf.org/html/rfc3339">RFC 3339</a> format, for example
     * <b>2012-11-15T16:19:00.094Z</b>.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 7;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setEndTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->end_time = $var;

        return $this;
    }

    /**
     * If errors occurred during processing of this operation, this field will be
     * populated.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.OperationErrors error = 8;</code>
     * @return \Google\Cloud\Sql\V1beta4\OperationErrors|null
     */
    public function getError()
    {
        return $this->error;
    }

    public function hasError()
    {
        return isset($this->error);
    }

    public function clearError()
    {
        unset($this->error);
    }

    /**
     * If errors occurred during processing of this operation, this field will be
     * populated.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.OperationErrors error = 8;</code>
     * @param \Google\Cloud\Sql\V1beta4\OperationErrors $var
     * @return $this
     */
    public function setError($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Sql\V1beta4\OperationErrors::class);
        $this->error = $var;

        return $this;
    }

    /**
     * The type of the operation. Valid values are:
     * <br><b>CREATE</b>
     * <br><b>DELETE</b>
     * <br><b>UPDATE</b>
     * <br><b>RESTART</b>
     * <br><b>IMPORT</b>
     * <br><b>EXPORT</b>
     * <br><b>BACKUP_VOLUME</b>
     * <br><b>RESTORE_VOLUME</b>
     * <br><b>CREATE_USER</b>
     * <br><b>DELETE_USER</b>
     * <br><b>CREATE_DATABASE</b>
     * <br><b>DELETE_DATABASE</b>
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.Operation.SqlOperationType operation_type = 9;</code>
     * @return int
     */
    public function getOperationType()
    {
        return $this->operation_type;
    }

    /**
     * The type of the operation. Valid values are:
     * <br><b>CREATE</b>
     * <br><b>DELETE</b>
     * <br><b>UPDATE</b>
     * <br><b>RESTART</b>
     * <br><b>IMPORT</b>
     * <br><b>EXPORT</b>
     * <br><b>BACKUP_VOLUME</b>
     * <br><b>RESTORE_VOLUME</b>
     * <br><b>CREATE_USER</b>
     * <br><b>DELETE_USER</b>
     * <br><b>CREATE_DATABASE</b>
     * <br><b>DELETE_DATABASE</b>
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.Operation.SqlOperationType operation_type = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setOperationType($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Sql\V1beta4\Operation\SqlOperationType::class);
        $this->operation_type = $var;

        return $this;
    }

    /**
     * The context for import operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.ImportContext import_context = 10;</code>
     * @return \Google\Cloud\Sql\V1beta4\ImportContext|null
     */
    public function getImportContext()
    {
        return $this->import_context;
    }

    public function hasImportContext()
    {
        return isset($this->import_context);
    }

    public function clearImportContext()
    {
        unset($this->import_context);
    }

    /**
     * The context for import operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.ImportContext import_context = 10;</code>
     * @param \Google\Cloud\Sql\V1beta4\ImportContext $var
     * @return $this
     */
    public function setImportContext($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Sql\V1beta4\ImportContext::class);
        $this->import_context = $var;

        return $this;
    }

    /**
     * The context for export operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.ExportContext export_context = 11;</code>
     * @return \Google\Cloud\Sql\V1beta4\ExportContext|null
     */
    public function getExportContext()
    {
        return $this->export_context;
    }

    public function hasExportContext()
    {
        return isset($this->export_context);
    }

    public function clearExportContext()
    {
        unset($this->export_context);
    }

    /**
     * The context for export operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.ExportContext export_context = 11;</code>
     * @param \Google\Cloud\Sql\V1beta4\ExportContext $var
     * @return $this
     */
    public function setExportContext($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Sql\V1beta4\ExportContext::class);
        $this->export_context = $var;

        return $this;
    }

    /**
     * The context for backup operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.BackupContext backup_context = 17;</code>
     * @return \Google\Cloud\Sql\V1beta4\BackupContext|null
     */
    public function getBackupContext()
    {
        return $this->backup_context;
    }

    public function hasBackupContext()
    {
        return isset($this->backup_context);
    }

    public function clearBackupContext()
    {
        unset($this->backup_context);
    }

    /**
     * The context for backup operation, if applicable.
     *
     * Generated from protobuf field <code>.google.cloud.sql.v1beta4.BackupContext backup_context = 17;</code>
     * @param \Google\Cloud\Sql\V1beta4\BackupContext $var
     * @return $this
     */
    public function setBackupContext($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Sql\V1beta4\BackupContext::class);
        $this->backup_context = $var;

        return $this;
    }

    /**
     * An identifier that uniquely identifies the operation. You can use this
     * identifier to retrieve the Operations resource that has information about
     * the operation.
     *
     * Generated from protobuf field <code>string name = 12;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * An identifier that uniquely identifies the operation. You can use this
     * identifier to retrieve the Operations resource that has information about
     * the operation.
     *
     * Generated from protobuf field <code>string name = 12;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Name of the database instance related to this operation.
     *
     * Generated from protobuf field <code>string target_id = 13;</code>
     * @return string
     */
    public function getTargetId()
    {
        return $this->target_id;
    }

    /**
     * Name of the database instance related to this operation.
     *
     * Generated from protobuf field <code>string target_id = 13;</code>
     * @param string $var
     * @return $this
     */
    public function setTargetId($var)
    {
        GPBUtil::checkString($var, True);
        $this->target_id = $var;

        return $this;
    }

    /**
     * The URI of this resource.
     *
     * Generated from protobuf field <code>string self_link = 14;</code>
     * @return string
     */
    public function getSelfLink()
    {
        return $this->self_link;
    }

    /**
     * The URI of this resource.
     *
     * Generated from protobuf field <code>string self_link = 14;</code>
     * @param string $var
     * @return $this
     */
    public function setSelfLink($var)
    {
        GPBUtil::checkString($var, True);
        $this->self_link = $var;

        return $this;
    }

    /**
     * The project ID of the target instance related to this operation.
     *
     * Generated from protobuf field <code>string target_project = 15;</code>
     * @return string
     */
    public function getTargetProject()
    {
        return $this->target_project;
    }

    /**
     * The project ID of the target instance related to this operation.
     *
     * Generated from protobuf field <code>string target_project = 15;</code>
     * @param string $var
     * @return $this
     */
    public function setTargetProject($var)
    {
        GPBUtil::checkString($var, True);
        $this->target_project = $var;

        return $this;
    }

}
