<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/devtools/source/v1/source_context.proto

namespace Google\Cloud\DevTools\Source\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * An alias to a repo revision.
 *
 * Generated from protobuf message <code>google.devtools.source.v1.AliasContext</code>
 */
class AliasContext extends \Google\Protobuf\Internal\Message
{
    /**
     * The alias kind.
     *
     * Generated from protobuf field <code>.google.devtools.source.v1.AliasContext.Kind kind = 1;</code>
     */
    protected $kind = 0;
    /**
     * The alias name.
     *
     * Generated from protobuf field <code>string name = 2;</code>
     */
    protected $name = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $kind
     *           The alias kind.
     *     @type string $name
     *           The alias name.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Devtools\Source\V1\SourceContext::initOnce();
        parent::__construct($data);
    }

    /**
     * The alias kind.
     *
     * Generated from protobuf field <code>.google.devtools.source.v1.AliasContext.Kind kind = 1;</code>
     * @return int
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * The alias kind.
     *
     * Generated from protobuf field <code>.google.devtools.source.v1.AliasContext.Kind kind = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setKind($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\DevTools\Source\V1\AliasContext\Kind::class);
        $this->kind = $var;

        return $this;
    }

    /**
     * The alias name.
     *
     * Generated from protobuf field <code>string name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The alias name.
     *
     * Generated from protobuf field <code>string name = 2;</code>
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

